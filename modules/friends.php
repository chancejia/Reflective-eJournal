<?php

	require_once('../config.php');
	//Start session
	require_once('../auth.php');
	date_default_timezone_set('Asia/Brunei'); //set time zone as UTC+8
	//$date = date('m/d/Y h:i:s a', time());
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" 
"http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html" />
<title> My Friends </title>
<link href="../login/loginmodule.css" rel="stylesheet" type="text/css" />
<link REL="SHORTCUT ICON" HREF="../images/ico/friends.png">
</head>

<body>
<h1>Welcome</h1>
<a href="site/student_home.php">My Profile</a> | <a href="../logout.php">Logout</a>
<br/>
<br/>
<h2><? echo $userhomegroup; ?> Group</h2>

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
// Java_C++_ 
//Java_ 
//C++_
//$rest = substr($userhomegroup,-4);  //maybe is C++
//$first = substr($userhomegroup,0,-5); //maybe is Java
//$length = strlen($userhomegroup);

if($userhomegroup=="Java "){
	$choice="Java%";
}else{
if($userhomegroup=="C++ ")
	 $choice="%++ ";	 
else $choice="% %";
}
// counting the offset
$offset = ($pageNum - 1) * $rowsPerPage;


$query = "SELECT id,fname,lname,matric,gp
          FROM users 
		  WHERE gp LIKE '$choice' ";
		  
$result = mysql_query($query) or die('Error, query failed');

$total_items  = mysql_num_rows($result); 

echo "<br/><p align='center'>Totle number of your group members is ".$total_items."!</p>";
// print the journals info in table
		
		while(list($id,$fname,$lname,$matric,$gp) = mysql_fetch_array($result))
		{
		?>
		<li><a href="/ejournal/modules/site/public.php?userid=<?php echo $id; ?>"  target="_parent"/><?php echo $matric; ?> - <?php echo $fname; ?> <?php echo $lname; ?>-<?php echo $gp; ?> Group</a></li>
		<?php 
		};
		echo '<br>';

?>


</body>
</html>