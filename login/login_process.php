<?php
	//Start session
	session_start();
	
	//Include database connection details
	require_once('../config.php');
	
	
	
	//Sanitize the POST values
	$matric= clean($_POST['matric']);
	$password = clean($_POST['password']);
	
	//Input Validations
	if($matric == '') {
		$errmsg_arr[] = 'Matric number missing';
		$errflag = true;
	}
	if($password == '') {
		$errmsg_arr[] = 'Password missing';
		$errflag = true;
	}
	
	//If there are input validations, redirect back to the matric form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: ../index.php");
		exit();
	}
	
	//Create query
	$qry="SELECT * FROM users WHERE matric='$matric' AND password='".md5($_POST['password'])."'";
	$result=mysql_query($qry);

	//Check whether the query was successful or not
	if($result) {
		if(mysql_num_rows($result) == 1) {
			//login Successful
			session_regenerate_id();
			$member = mysql_fetch_assoc($result);
			$_SESSION['SESS_MEMBER_ID'] = $member['id'];
			$_SESSION['SESS_GP'] = $member['gp'];
			$_SESSION['SESS_FIRST_NAME'] = $member['fname'];
			$_SESSION['SESS_LAST_NAME'] = $member['lname'];
			$_SESSION['SESS_MATRIC'] = $matric;
			$_SESSION['SESS_EMAIL'] = $member['email'];
			session_write_close();
			$uid=$member['id'];
			header("location: ../modules/site/student_home.php");
			
			exit();
		}else {
			//matric failed
			header("location: login_failed.php");
			exit();
		}
	}else {
		die("Query failed");
	}
	

?>