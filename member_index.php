<?php
	require_once('auth.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" 
"http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html" />
<title>Member Index</title>
<link href="login/loginmodule.css" rel="stylesheet" type="text/css" />
</head>
<body>
<h1>Welcome <?php echo  $_SESSION['SESS_FIRST_NAME']." ".$_SESSION['SESS_LAST_NAME']." ".$_SESSION['SESS_MATRIC'] ?> </h1>
<a href="modules/journal_writer.php">Home</a> | <a href="logout.php">Logout</a>


</body>
</html>
