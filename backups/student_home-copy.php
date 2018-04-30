<?php

		//Start session
	session_start();
	
	//Include database connection details
	require_once('../../config.php');

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" 
"http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html" />
<title>Student's Home</title>
<!--external style sheet-->
<link rel="stylesheet" type="text/css" href="../../mystyle.css" />
</head>

<body>
<div id="container">
	<div id="header">
		<h1>
			Welcome to Reflective eJournal!
		</h1>
        <h3><?php echo  $_SESSION['SESS_FIRST_NAME']." ".$_SESSION['SESS_LAST_NAME'] ?>'s Page</h3>
	</div>
	<div id="navigation">
 		<table width="1000" border="0" align="center">
 		 <tr>
    		<td><ul>
				<li><a href="">Home</a></li>
   				<li><a href="../journal_writer.php">Journals</a></li>
    			<li><a href="">Friends</a></li>
    			<li><a href="../../member_index.php">Message</a></li>
    			</ul></td>
                <td width="545"> </td>
    		<td align="right"><ul class="a">
    			<li><a href="">Public</a></li>
   			 	<li><a href="">Settings</a></li>
    			<li><a href="../../logout.php">Logout</a></li>
    			</ul></td>
  				</tr>
		</table>
	</div>
	<div id="content-container">
		<div id="content">
			<h2>
				 List of your journals
			</h2>
    <?php
	$userid=clean($_SESSION['SESS_MEMBER_ID']);
	?>

    <?php
	//show journals

// if no id is specified, list the available articles
// how many rows to show per page
$rowsPerPage = 5;

// by default we show first page
$pageNum = 1;

// if $_GET['page'] defined, use it as page number
if(isset($_GET['page']))
{
$pageNum = $_GET['page'];
}

// counting the offset
$offset = ($pageNum - 1) * $rowsPerPage;

   $self = $_SERVER['PHP_SELF'];

   //$query = "SELECT id, title FROM news ORDER BY id";
   $query = "SELECT title,log_id,author,add_time,language,content
          FROM journals 
		  where user_id=$userid 
		  ORDER BY  `log_id` DESC
		  LIMIT $offset, $rowsPerPage";
   $result = mysql_query($query) or die('Error : ' . mysql_error()); 

   // create the article list 
   $content = '<ol>';
   while($row = mysql_fetch_array($result, MYSQL_NUM))
   {
      list($title, $log_id,$author, $add_time, $language,$content) = $row;
      //$content .= "<li><a href=\"$self?id=$id\">$title</a></li>\r\n";
	  
	  $content .="<table  width=600><tr><td colspan = 3><li><a href=\"$self?id=$log_id\">$title</a></li>\r\n</td></tr>
		  <tr><td>posted by: $author</td><td>at: $add_time</td><td>about: $language</td></tr>
		  <tr><td colspan = 3><hr/>$content</td></tr></table><br/>";
	  
   }

   $content .= '</ol>';

   $title = 'Available Articles';
 // how many rows we have in database
$query = "SELECT COUNT(log_id) AS numrows FROM journals";
$result = mysql_query($query) or die('Error, query failed');
$row = mysql_fetch_array($result, MYSQL_ASSOC);
$numrows = $row['numrows'];



	echo $content;
?>
	<p align="center"><a href="<?php echo $_SERVER['PHP_SELF']; ?>">Article List</a></p>
	

		</div>
		<div id="aside">
			<h3>
				<?php echo  $_SESSION['SESS_FIRST_NAME']." ".$_SESSION['SESS_LAST_NAME'] ?>'s Profiel
			</h3>
            <?php
			$query = "SELECT semester,session,gp,email,website
          FROM users where id=$userid";
			$result = mysql_query($query) or die('Error, query failed');
			while(list($semester,$session,$gp,$email,$website)= mysql_fetch_row($result))
{
    echo "-Semester $semester Session $session<br>" .
         "-$gp Group<br>" . 
         "-email: $email<br>".
		 "-website: <a href=‘http://$website/’>$website</a><br>";
} 

		?>
<br/>
        
        </div>
		<div id="footer">
			copyright &copy; Universiti Kebangsaan Malaysia
		</div>
	</div>
</div>


 </body>
 </html>