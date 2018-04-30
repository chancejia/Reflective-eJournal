<?php
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

?>


