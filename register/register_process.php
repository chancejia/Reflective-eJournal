<?php
	//Include database connection details
	require_once('../config.php');
	
	//Sanitize the POST values 
	// group not work yet... $group = clean($_POST['group']);
	$matric = clean($_POST['matric']);
	$fname = clean($_POST['fname']);
	$lname = clean($_POST['lname']);
	$lecturer = clean($_POST['lecturer']);
	$pic=clean($_POST['pic']);
	$semester = clean($_POST['semester']);
	$session = clean($_POST['session']);
	$email = clean($_POST['email']);
	$website = clean($_POST['website']);
	$password = clean($_POST['password']);
	$cpassword = clean($_POST['cpassword']);
	
	//checkbox multi entities
	$group_array = $_POST['group'];
	foreach ($group_array as $one_group) {
		$source .= $one_group." ";
	}
	$group = substr($source, 0, -1);
	
	//checkbox multi entities for lecturers
	$lecturer_array = $_POST['lecturer'];
	foreach ($lecturer_array as $one_lecturer) {
		$sources .= $one_lecturer.",";
	}
	$lecturer = substr($sources, 0, -4);


	
	date_default_timezone_set('Asia/Brunei'); //set time zone as UTC+8
	$date = date('m/d/Y h:i:s a', time());
	
	//Input Validations
	if($matric == '') {
		$errmsg_arr[] = 'Matric number missing';
		$errflag = true;
	}
	if($fname == '') {
		$errmsg_arr[] = 'First name missing';
		$errflag = true;
	}
	if($lname == '') {
		$errmsg_arr[] = 'Last name missing';
		$errflag = true;
	}
	if($lecturer == '') {
		$errmsg_arr[] = 'Lecturer name missing';
		$errflag = true;
	}
	/* Spruce up username, check length */
    $password  = stripslashes($password );
    if(strlen($password) < 5){
       	$errmsg_arr[] = 'Password length should not less 5 character';
	 	$errflag = true;
     }
	if($group == '') {
		$errmsg_arr[] = 'Group name missing';
		$errflag = true;
	}
	if($semester == '') {
		$errmsg_arr[] = 'Semester missing';
		$errflag = true;
	}
	if($session == '') {
		$errmsg_arr[] = 'Session missing';
		$errflag = true;
	}

	if($email == '') {
		$errmsg_arr[] = 'Email address missing';
		$errflag = true;
	}
	if($password == '') {
		$errmsg_arr[] = 'Password missing';
		$errflag = true;
	}
	if($cpassword == '') {
		$errmsg_arr[] = 'Confirm password missing';
		$errflag = true;
	}
	if( strcmp($password, $cpassword) != 0 ) {
		$errmsg_arr[] = 'Passwords do not match';
		$errflag = true;
	}
	
	 // check if a pic was submitted
   
		
	//Check for duplicate login ID
	if($matric != '') {
		$qry = "SELECT * FROM users WHERE matric='$matric'";
		$result = mysql_query($qry);
		if($result) {
			if(mysql_num_rows($result) > 0) {
				$errmsg_arr[] = 'Matric number already in use';
				$errflag = true;
			}
			@mysql_free_result($result);
		}
		else {
			die("Query failed");
		}
	}
	
	//If there are input validations, redirect back to the registration form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: register.php");
		exit();
	}
	
	
	//Create INSERT query
	// without group '$group'
	$qry = "INSERT INTO users (matric,fname,lname,password,email,website,gp,semester,session,lecturer,register_time,pic) VALUES('$matric','$fname','$lname','".md5($_POST['password'])."','$email','$website','$group','$semester','$session','$lecturer','$date','$pic')";
	$result = @mysql_query($qry);
  
		
	//Check whether the query was successful or not
	if($result) {
		header("location: register_success.php");
		exit();
	}
	else{
		die("Query failed");
	}

	
	
    
?>