<?php
	
	$userids=$_SESSION['SESS_MEMBER_ID'];
	//$userid=$_REQUEST["userid"];
	$query  = "SELECT fname,lname FROM users WHERE id=$userids";
	$result = mysql_query($query);

	while(list($fname,$lname)= mysql_fetch_row($result))
{
   $name= $fname." ".$lname;
} 
?>