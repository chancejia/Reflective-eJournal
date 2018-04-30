<?php
	require_once('../../config.php');
	//Start session
	require_once('../../auth.php');
	//$userhomename 
	//$userhomeid

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" 
"http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html" />
<title>Student's Home</title>
<!--external style sheet-->
<link rel="stylesheet" type="text/css" href="../../mystyle.css" />
<link REL="SHORTCUT ICON" HREF="../../images/ico/shome.ico">
</head>

<body>

<div id="container">
	<div id="header">
		<h1 color="blue">
			Welcome to Reflective <i>e</i>Journal!
		</h1>
       
	</div>
	<div id="navigation">
 		<table width="800" border=0 align="center">
 		 <tr>
    		<td><ul>
				<li><a href="">Home</a></li>
   				<li><a href="../journals/journal_writer.php">Journals</a></li>
    			<li><a href="../friends.php?userid=<?php echo $userid; ?>">Friends</a></li>
    			<li><a href="../message/index.php">Message</a></li>
    			</ul></td>
                <td width=400>&nbsp; </td>
    		<td align="right"><ul class="a">
	 	<li><a href="../settings.php?userid=<?php echo $userid; ?>">Settings</a></li>
    			<li><a href="../../logout.php">Logout</a></li>
    			</ul></td>
  				</tr>
                
		</table>
     
	</div>
    <br><br>
       <h1><?php echo  $userhomename; ?>'s Page</h1>
       <form name="search_cat_bar" method="get" action="">
 <table width="400" border="0" cellpadding="0" align="right">
   <tr>
     <td>
       <input type="hidden" name="dff_view" value="grid">
       Search:<input type="text" name="dff_keyword" size="10" maxlength="20"> in 
       <select name="dff_cat1num" size="1">
         <option value="-1">All Tags
         <option value="-2">--------------
         <option value="101">data type
         <option value="193">loop
       </select>
       <input type="submit" value="Find">
     </td>
   </tr>
 </table>
</form>

    <table  width=800 border=0 align="center">
    <tr ><td width=550 height=60>
						
			<h2 >
				 List of your journals
			</h2>
			</td>
            <td width="250">  <td> 
            </td></tr>
            <tr><td>
            <div id="content-container">
		<div id="content">
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


$query = "SELECT log_id,class,title,author,add_time,language,content
          FROM journals 
		  where user_id=$userhomeid 
		  ORDER BY log_id DESC
          LIMIT $offset, $rowsPerPage";
		  
$result = mysql_query($query) or die('Error, query failed');

  $total_items  = mysql_num_rows($result); 
   echo "<br/><p align='center'>Totle number of journals is ".$total_items."!</p>";
// print the journals info in table
	
		while(list($log_id,$class,$title, $author, $add_time, $language,$content) = mysql_fetch_array($result))
		{
		?>
        <table width=400 height="10">
        	<tr><td colspan = 3 ><h3>
			<?php if($class=="question"){
			echo "<img src='../../images/question.png' alt='question' width=28 height=28>";
		}else echo "<img src='../../images/journal.png' alt='journal' width=28 height=28>"; ?>
		<a href="../journals/journal_content.php?logid=<?php echo $log_id; ?>"  target="_parent"/>
		<?php echo '"'.$title.'"'; ?></a></h3></td></tr>
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
       </td>
       <td >
       <div id="aside">
			<h3>
				<?php echo  $userhomename; ?>'s Profile
			</h3>
			<br/>
            <?php
			$query = "SELECT semester,session,gp,email,website
          FROM users where id=$userhomeid";
			$result = mysql_query($query) or die('Error, query failed');
			while(list($semester,$session,$gp,$email,$website)= mysql_fetch_row($result))
{
    echo 
			"-id is ".$userhomeid."<br/>-Matric Number is ".$userhomematrics."<br/>-Semester $semester Session $session<br>" .
         "-$gp Group<br>" . 
         "-email: $email<br>".
		 "-website: <a href=".$website. ">$website</a><br>";
} 
  ?></div>
 <?php
  $pathToShoutBox = '../shoutbox/';
  include("$pathToShoutBox/shoutbox.inc.php");
  date_default_timezone_set('Asia/Brunei'); //set time zone as UTC+8
?>
</td></tr></table>

       
		<div id="footer">
			copyright &copy; Universiti Kebangsaan Malaysia
		</div>


 </body>
 </html>
