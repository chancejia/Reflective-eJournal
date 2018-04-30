<?php

	require_once('../../config.php');
	//Start session
	require_once('../../auth.php');
	$name = $_SESSION['SESS_FIRST_NAME']." ".$_SESSION['SESS_LAST_NAME'];

	//log id
	$log_id=$_REQUEST["logid"];
	//user email
	$email=$_SESSION['SESS_EMAIL'] ;
	date_default_timezone_set('Asia/Brunei'); //set time zone as UTC+8
	//$date = date('m/d/Y h:i:s a', time());
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" 
"http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html" />
<title> the content of ...</title>
<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
<link href="../../login/loginmodule.css" rel="stylesheet" type="text/css" />
<link REL="SHORTCUT ICON" HREF="../../images/ico/read.png">
</head>

<body>
<h1>Welcome</h1>
<a href="../site/student_home.php">My Profile</a> | <a href="../../logout.php">Logout</a>
<br/>
<br/>

<?php
$addr='../site/public.php?userid='.$userhomeid;
	//to got the journal unique id from stident_home.php

	//the user's id (key element)
	
	$query = "SELECT class,title,author,add_time,language,content
          FROM journals 
		  where log_id=$log_id";
	$result = mysql_query($query) or die('Error, query failed');

	while(list(  $class,$title, $author, $add_time, $language,$content)= mysql_fetch_row($result))
	{
		
?>
		<table width=600>
        	<tr><td colspan = 3><?php if($class=="question"){
			echo "<img src='../../images/question.png' alt='question'>";
		}else echo "<img src='../../images/journal.png' alt='journal'>"; ?><h2><?php echo $title;?></h2><hr/></td></tr>
		  	<tr><td>posted by: <?php echo $author;?></td><td>at: <?php echo $add_time;?></td><td>about: <?php echo $language;?></td></tr>
		  <tr><td colspan = 3><hr/><?php echo $content;?></td></tr>
          <tr></tr>
          </table><br/>          
<?php	
    } 
?>
<?php echo $title;?>

<?php 

//query comments for this page of this article
//'REQUEST_URI' The URI which was given in order to access this page; for instance, '/index.html'.
/*Example:

For url http://www.somesite.com/display.php?id=345, using $_SERVER['REQUEST_URI'] will return:

display.php?id=345 
*/
   	echo '<br/><h2>Comments:</h2><br/>';
	
$inf = "SELECT * FROM `comments` WHERE page = '".stripslashes($_SERVER['REQUEST_URI'])."' ORDER BY time ASC";
$info = mysql_query($inf);
	if(!$info) die(mysql_error());
   		$info_rows = mysql_num_rows($info);
	if($info_rows > 0) {
   		echo '<table width=600>';
 
//Displaying Comments  

 while($info2 = mysql_fetch_object($info)) {	
echo '<tr>';
echo '<td>"'.htmlspecialchars(stripslashes($info2->subject)).'" by: <a href="'.$addr.'">'.htmlspecialchars(stripslashes($userhomename)).'</a></td> <td><div align="right"> @ '.date('h:i:s a', $info2->time).' on '.$info2->date.'</div></td>';
echo '</tr><tr>';
//$info2->comment = str_replace('<br>', '\n', $info2->comment);
echo '<td colspan="2"> '.$info2->comment.' </td>';
echo '</tr>';

}//end while

echo '</table>';

echo '<hr width=600 align="left"/>';
} else echo 'No comments for this page. Feel free to be the first~ <br><br>';

//isset — Determine if a variable is set and is not NULL
if(isset($_POST['submit'])) {
  if(!addslashes($_POST['subject']))  die('<u>ERROR:</u> enter a subject to your comment.');
  if(!addslashes($_POST['comment']))  die('<u>ERROR:</u> cannot add comment if you do not enter one!?');


//add comment
$q ="INSERT INTO `comments` (article_id, page, date, time, username, ip, contact, subject, comment) VALUES ('".$_GET['id']."', '".$_POST['page']."', '".$_POST['date']."', '".$_POST['time']."', '".addslashes($name)."', '".$_SERVER['REMOTE_ADDR']."', '".addslashes($email)."', '".addslashes($_POST['subject'])."', '".addslashes($_POST['comment'])."')";

$q2 = mysql_query($q);
  if(!$q2) die(mysql_error());

//refresh page so they can see new comment
header('Location: http://' . $_SERVER['HTTP_HOST'] . $_POST['page'] . "#commentsrn");


} else {  //display form

?>
	<form name="comments" action="<? $_SERVER['PHP_SELF']; ?>" method="post">
		<input type="hidden" name="page" value="<? echo($_SERVER['REQUEST_URI']); ?>">
		<input type="hidden" name="date" value="<? echo(date("F j, Y.")); ?>">
		<input type="hidden" name="time" value="<? echo(time()); ?>">
<table width=600 border="0" cellspacing="0" cellpadding="0">
   <tr> 
      <td><div align="right">Name: </div></td> 
       <td><p><font size=3 color="#228B22"><u><i><?php echo $name;?></i></u></font></p></td>
   </tr>
    <td><div align="right">Subject: </div></td>
    <td><input type="text" name="subject" size=54 value='Re: this article~ '>(* optional)</td>
    </tr>
    <tr>
      <td><div align="right">Comment: </div></td>
      <td> <textarea name="comment" style="width: 350px; height: 100px;" ></textarea></td>
    </tr>
    <tr> 
      <td></td>
      <td colspan="2"><input type="reset" value="Reset Fields">
      <input type="submit" name="submit" value="Add Comment"></td>
    </tr>
  </table>
</form>
<?
} // end else
?> 



 </body>
 </html>