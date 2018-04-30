<?php
	require_once('../config.php');
	
	date_default_timezone_set('Asia/Brunei'); //set time zone as UTC+8
  	$date = date('D, M d, Y h:i:s a', time());
	if(isset($_GET['del']))
	{
   $query = "DELETE FROM journals WHERE log_id = '{$_GET['del']}'";
   mysql_query($query) or die('Error : ' . mysql_error());


   // then remove the cached file
   $cacheDir = dirname(__FILE__) . '/cache/';
   $cacheFile = $cacheDir . '_' . $_GET['logid'] . '.html';

   @unlink($cacheFile);

   // and remove the index.html too because the file list
   // is changed
   @unlink($cacheDir . '../modules/site/student_home.php');

   // redirect to current page so when the user refresh this page
   // after deleting an article we won't go back to this code block
   header('Location: ' . $_SERVER['PHP_SELF']);
   exit;
	}

// ... more code here
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" 
"http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Admin Page For Reflective eJournal</title>
<meta http-equiv="Content-Type" content="text/html" />
<link rel="stylesheet" type="text/css" href="../mystyle.css" />
<script language="JavaScript">
function delArticle(logid, title)
{
   if (confirm("Are you sure you want to delete '" + title + "'"))
   {
      window.location.href = 'admin.php?del=' + logid;
   }
}
</script>
</head>

<body>
<div id="navigation">
<ul>
				<li><a href="admin.php">Home</a></li>
   				<li><a href="admin.php">Journals Management</a></li>
    			<li><a href="user_management.php">Users Management</a></li>
    			</ul>
</div>
<br/>
<?php
// with delete journls function
$query= "SELECT log_id, title,author,user_id,add_time  FROM journals ORDER BY log_id DESC";
$result= mysql_query($query) or die('Error : ' . mysql_error());
$total_items = mysql_num_rows($result);
echo "<br/><h3 align='center'>There are ".$total_items." Reflective <i>e</i>Journals totally until <small>".$date."</small></h3>";
?>
<br/>
<table width="800" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#999999">
<tr align="center" bgcolor="#CCCCCC"> 
<td width="80"><strong>Journal ID</strong></td>
<td width="300"><strong>Title</strong></td>
<td width="200"><strong>Author</strong></td>
<td width="170"><strong>Publish Date</strong></td>
<td width="150"><strong>Action</strong></td>
</tr>
<?php
while(list($logid, $title,$author,$userid,$time) = mysql_fetch_array($result, MYSQL_NUM))
{

?>
<tr bgcolor="#FFFFFF">
<td width="80" align="center"><?php echo $logid;?></td> 
<td ><b><?php echo $title; ?></b></td> 
<td align="center"><i><?php echo $author; ?></i></td>
<td align="center"><small><?php echo $time; ?></small></td>
<td width="150" align="center">
<a href="../modules/journals/journal_content.php?logid=<?php echo $logid;?>&userid=<?php echo $userid;?>" target="_blank">view</a> | <a href="javascript:delArticle('<?php echo $logid;?>', '<?php echo $title;?>');">delete</a></td>
</tr>
<?php
}
?>
</table>

</body>
</html>