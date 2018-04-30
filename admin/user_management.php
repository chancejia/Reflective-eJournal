<?php
	require_once('../config.php');
	
	date_default_timezone_set('Asia/Brunei'); //set time zone as UTC+8
  	$date = date('D, M d, Y h:i:s a', time());
	if(isset($_GET['del']))
	{
   $query = "DELETE FROM users WHERE id = '{$_GET['del']}'";
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

<html>
<head>
<title>user management</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="../mystyle.css" />
<script language="JavaScript">
function delUser(user_id, user_name)
{
   if (confirm("Are you sure you want to delete '" + user_name + "'"))
   {
      window.location.href = 'user_management.php?del=' + user_id;
   }
}
</script>
</head>

<body>
<div id="navigation">
<ul>
				<li><a href="admin.php">Home</a></li>
   				<li><a href="admin.php">Journals Management</a></li>
    			<li><a href="user_management.php">Users Management</a></li> <!--here submenu-->
                	<li><a href="user_management.php">Lectures</a></li> <!-- add new a lecture button at top-->
                	<li><a href="user_management.php">students</a></li><!--here submenu-->
                		<li><a href="user_management.php">Java Group</a></li>
                		<li><a href="user_management.php">C++ Group</a></li>
    			</ul>
</div>
<br/>
<?php
// with delete journls function
$query= "SELECT id,matric,CONCAT(fname,'',lname) AS name,CONCAT(semester,'| ',session) AS year  FROM users where gp='Java' ORDER BY id ASC";
$result= mysql_query($query) or die('Error : ' . mysql_error());
$total_items = mysql_num_rows($result);
echo "<br/><h3 align='center'>There are ".$total_items." Java Group users totally until <small>".$date."</small><br/><br/> Student<br/><br/>Java Group</h3>";
?>
<br/>
<table  border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#999999">
<tr align="center" bgcolor="#CCCCCC"> 
<td width="80"><strong>User ID</strong></td>
<td width="150"><strong>Matric NO.</strong></td>
<td width="300"><strong>Name</strong></td>
<td width="200"><strong>Semester | Session</strong></td>
<td width="170"><strong>Register Time</strong></td>
<td width="200"><strong>Action</strong></td>
</tr>
<?php
// without register time yet
while(list($id, $matric,$name,$year) = mysql_fetch_array($result, MYSQL_NUM))
{

?>
<tr bgcolor="#FFFFFF">
<td  align="center"><?php echo $id;?></td> 
<td align="center" ><i><?php echo $matric; ?></i></td> 
<td align="center" ><b><?php echo $name; ?></b></td>
<td align="center"><small><?php echo $year; ?></small></td>
<td align="center">&nbsp;</td>
<td align="center">
<a href="user_info.php?userid=<?php echo $id;?>" target="_blank">view&edit</a> | <a href="javascript:delUser('<?php echo $id;?>', '<?php echo $name;?>');">delete</a></td>
</tr>
<?php
}
?>
</table>

</body>
</html>