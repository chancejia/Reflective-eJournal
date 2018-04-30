<?php
	//Start session
	session_start();
	
	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(!isset($_SESSION['SESS_MEMBER_ID']) || (trim($_SESSION['SESS_MEMBER_ID']) == '')) {
		header("location: access_denied.php");
		exit();
	}
	$userhomename = $_SESSION['SESS_FIRST_NAME']." ".$_SESSION['SESS_LAST_NAME'];
	$userhomeid=clean($_SESSION['SESS_MEMBER_ID']);
	$userhomematrics=$_SESSION['SESS_MATRIC'];
	$userhomegroup=$_SESSION['SESS_GP'];
?>