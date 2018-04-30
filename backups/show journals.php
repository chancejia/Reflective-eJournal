<?php
// if no id is specified, list the available articles
$cacheDir = dirname(__FILE__) . '/cache/';

if (isset($userid) {
   $cacheFile = $cacheDir . '_' . $_GET[$userid] . '.html';
} else {
   $cacheFile = $cacheDir . 'index.html';
}

if (file_exists($cacheFile))
{
   header("Content-Type: text/html");
   readfile($cacheFile);
   exit;
}
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
      list($title, ,$log_id,$author, $add_time, $language,$content) = $row;
      //$content .= "<li><a href=\"$self?id=$id\">$title</a></li>\r\n";
	  
	  $content .="<table  width=600><tr><td colspan = 3><li><a href=\"$self?id=$log_id\">$title</a></li>\r\n</td></tr>
		  <tr><td>posted by: $author</td><td>at: $add_time</td><td>about: $language</td></tr>
		  <tr><td colspan = 3><hr/>$content</td></tr></table><br/>";
	  
   }

   $content .= '</ol>';

   $title = 'Available Articles';
ob_start();
?>

<html>
<head>
<title>
<?php echo $title; ?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

</head>
<body>
<table width="600" border="0" align="center" cellpadding="10" cellspacing="1" bgcolor="#336699">
<tr> 
<td bgcolor="#FFFFFF">
<h1 align="center"><?php echo $title; ?></h1>
<?php 
echo $content;

// when displaying an article show a link
// to see the article list
if(isset($log_id))
{ 
?>
<p>&nbsp;</p>
<p align="center"><a href="<?php echo $_SERVER['PHP_SELF']; ?>">Article List</a></p>
<?php
}
?> 
</td>
</tr>
</table>
</body>
</html>

<?php

// get the buffer
$buffer = ob_get_contents();

// end output buffering, the buffer content
// is sent to the client
ob_end_flush();

// now we create the cache file
$fp = fopen($cacheFile, "w");
fwrite($fp, $buffer);
fclose($fp);
?>