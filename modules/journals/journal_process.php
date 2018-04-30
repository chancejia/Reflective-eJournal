<?php

	require_once('../../config.php');
	require_once('../../auth.php');
	//$userhomename 
	//$userhomeid
	//$userhomematrics
	
	//Sanitize the POST values 
	$title = clean($_POST['title']);
	$language = clean($_POST['language']);
	$tag = clean($_POST['tags']);
	$content = clean($_POST['content']);
	$visiable = clean($_POST['visiable']);
	$class = clean($_POST['class']);
	
	date_default_timezone_set('Asia/Brunei'); //set time zone as UTC+8
	$date = date('m/d/Y h:i:s a', time());
	//Input Validations
	if($title == '') {
		$errmsg_arr[] = 'Journal title missing';
		$errflag = true;
	}
	if($class == '') {
		$errmsg_arr[] = 'Journal classification missing';
		$errflag = true;
	}
	if($language == '') {
		$errmsg_arr[] = 'Language missing';
		$errflag = true;
	}
	if($visiable == '') {
		$errmsg_arr[] = ' Visiable missing';
		$errflag = true;
	}
/*
	if($content == '') {
		$errmsg_arr[] = ' Journal content missing';
		$errflag = true;
	}
*/
	//If there are input validations, redirect back to the registration form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: journal_writer.php");
		exit();
	}

	//Create INSERT query
	// without group '$group'
	$qry = "INSERT INTO journals (user_id,author,class,title,language,tag,content,add_time,visiable,matrics) 
			VALUES('$userhomeid','$userhomename','$class','$title','$language','$tag','$content','$date','$visiable','$userhomematrics')";
	$result = @mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result) {
		header("location: journal_writer_success.php");
		exit();
	}else {
		die("Query failed");
	}
	
		//Create query
	
?>


