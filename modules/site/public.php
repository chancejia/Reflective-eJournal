<?php
	require_once('../../config.php');
	//Start session
	require_once('../../auth.php');


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" 
"http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html" />
<title>Public Page</title>
<!--external style sheet-->
<link rel="stylesheet" type="text/css" href="../../mystyle.css" />
<link REL="SHORTCUT ICON" HREF="../../images/ico/public.ico">
</head>

<body>

<?php
//user.php

	$userid=$_REQUEST["userid"];
	
	$query  = "SELECT fname,lname FROM users WHERE id=$userid";
	$result = mysql_query($query);
	
	while(list($fname,$lname)= mysql_fetch_row($result))
{
   $name= $fname." ".$lname;

?>
<div id="container">
	<div id="header">
		<h1 color="blue">
			Welcome to Reflective <i>e</i>Journal!
		</h1>
       
	</div>
    <!-- his friends @ <a href="../friends.php?userid= echo $userid; ">Friends</a>-->
	<div id="navigation">
 		<table width="800" border=0 align="center">
 		 <tr>
    		<td><ul>
				<li><a href="public.php?userid=<?php echo $userid; ?>"> <?php echo $fname; ?></a></li>
    			<li><a href="../friends.php"><?php echo $fname; ?>'s Friends</a></li>
    			<li><a href="../message/index.php?userid=<?php echo $userid; ?>">Leave a Message</a></li>
    			</ul></td>
        	<td width="150">&nbsp;</td>
    		<td align="right"><ul class="a">
    			<li><a href="student_home.php">My Home</a></li>
   			 	<li><a href="../settings.php">My Settings</a></li>
    			<li><a href="../../logout.php">Logout</a></li>
    			</ul></td>
  				</tr>           
		</table>
     
	</div>
   <?php } ?>
    <br><br>
       <h1><?php echo  $name; ?>'s Page</h1>
       
    <table  width=800 border=2 align="center">
    <tr ><td width=550 height="300">
	<div id="content-container">
		<div id="content">
             
			<h2>
				 List of <?php echo  $name; ?>'s  journals
			</h2>
<?php
	
//$userid=clean($_SESSION['SESS_MEMBER_ID']);
// how many rows to show per page
$rowsPerPage = 50;

// by default we show first page
$pageNum = 1;

// if $_GET['page'] defined, use it as page number
if(isset($_GET['page']))
{
$pageNum = $_GET['page'];
}

// counting the offset
$offset = ($pageNum - 1) * $rowsPerPage;


$query1 = "SELECT log_id,title,author,add_time,language,content
          FROM journals 
		  where user_id=$userid 
		  ORDER BY log_id DESC
          LIMIT $offset, $rowsPerPage";
		  
$result1 = mysql_query($query1) or die('Error, query failed');

$total_items  = mysql_num_rows($result1); 

echo "<br/><p align='center'>Totle number of journals is ".$total_items."!</p>";
// print the journals info in table
	
		while(list($log_id,$title, $author, $add_time, $language,$content) = mysql_fetch_array($result1))
		{
		?>
        <table width=400 height="10">
        	<tr><td colspan = 3 ><h3><li><a href="../journals/journal_content.php?logid=<?php echo $log_id; ?>&userid=<?php echo $userid; ?>"  target="_parent"/><?php echo $title; ?></a></li></h3></td></tr>
		  	<tr><td>posted by: <?php echo $author;?></td><td>| at: <?php echo $add_time;?></td><td>| about: <?php echo $language;?></td></tr>
          </table>
          
		
		<?php 
		};
		echo '<br>';



// how many rows we have in database
$query = "SELECT COUNT(log_id) AS numrows FROM journals";
$result = mysql_query($query) or die('Error, query failed');
$row = mysql_fetch_array($result, MYSQL_ASSOC);
$numrows = $row['numrows'];

// ... just the same code that prints the prev & next link
?>

		</div>
        
       </td><td align="justify">
		<table border=3 width=250 height="200" >
        <tr width=250 height="200">
        <td height="200">
        <div id="aside">
			<h3>
				<?php echo  $name; ?>'s Profile
			</h3>
			<br/>
            <?php
			$query2 = "SELECT matric,semester,session,gp,email,website
          FROM users where id=$userid";
			$result2 = mysql_query($query2) or die('Error, query failed');
			while(list($matric,$semester,$session,$gp,$email,$website)= mysql_fetch_row($result2))
{
    echo "-id is ".$userid."<br/>-Matric Number is ".$matric."<br/>-Semester $semester Session $session<br>" .
         "-$gp Group<br>" . 
         "-email: $email<br>".
		 "-website: <a href=".$website. ">$website</a><br>";
} 
  ?></div></td></tr>
  
	<br><br><br>
    <tr><td height="300" align="center">
 <?php
  $pathToShoutBox = '../shoutbox/';
  include("$pathToShoutBox/shoutbox.inc.php");
  date_default_timezone_set('Asia/Brunei'); //set time zone as UTC+8
?>
</td></tr></table></td></tr></table>

       
		<div id="footer">
			copyright &copy; Universiti Kebangsaan Malaysia
		</div>


 </body>
 </html>
