<?php
	require_once('../config.php');
	
	date_default_timezone_set('Asia/Brunei'); //set time zone as UTC+8
  	$date = date('D, M d, Y h:i:s a', time());
	$userid=$_REQUEST["userid"];
?>

<html>
<head>
<title>user management</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="../mystyle.css" />

<script language="javascript" type="text/javascript" src="../css/niceforms.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="../css/niceforms-default.css" />
<link REL="SHORTCUT ICON" HREF="../images/ico/user_info.png">
</head>

<body>
<table  border="0"  align="center">
<tr><td>
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

</td></tr>
</table>
<?php
	if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
		echo '<ul class="err">';
		foreach($_SESSION['ERRMSG_ARR'] as $msg) {
			echo '<li>',$msg,'</li>'; 
		}
		echo '</ul>';
		unset($_SESSION['ERRMSG_ARR']);
	}
	
	$userid=$_REQUEST["userid"];
	$query = "SELECT * FROM users WHERE id=$userid ORDER BY id ASC";
	$result = mysql_query($query) or die('Error, query failed');
	$row = mysql_fetch_array( $result );
// Print out the contents of the entry 
//echo "Name: ".$row['name'];


	
?>
<h1>User Account Edit for : </h1>
<br/><br/>
<div align="center" id="containner">
        <br/>
    <p class="ex">(Fields marked with * must be filled in)</p>
<form id="loginForm" name="loginForm" method="post" class="niceform"  enctype="multipart/form-data"  action="register_process.php">
<fieldset>
<legend>Personal Info</legend>
		<dl>
        	<dt width="40"><lable class="ex">*</lable><label for="matric">Matric:</label></dt><br>
            <dd><input type="text" name="matric" id="matric" size="32" maxlength="128" value="<? echo $row['matric']; ?>"/></dd>
        </dl>
		<dl>
        	<dt><lable class="ex">*</lable><label for="password">Renew Password:</label></dt>
            <dd><input type="password" name="password" id="password" size="32" maxlength="32" /></dd>
        </dl>
        <dl>
        	<dt><lable class="ex">*</lable><label for="cpassword">Confirm Password:</label></dt>
            <dd><input type="password" name="cpassword" id="cpassword" size="32" maxlength="32" /></dd>
        </dl>
        <dl>
        	<dt><lable class="ex">*</lable><label for="fname">First Name:</label></dt>
            <dd><input type="text" name="fname" id="fname" size="32" maxlength="128" value="<? echo $row['fname']; ?>"/></dd>
        </dl>
        <dl>
        	<dt><lable class="ex">*</lable><label for="lname">Last Name:</label></dt>
            <dd><input type="text" name="lname" id="lname" size="32" maxlength="128" value="<? echo $row['lname']; ?>"/></dd>
        </dl>
        <dl>
        	<dt><lable class="ex">*</lable><label for="group">Groups:</label> &nbsp;&nbsp;</dt>  
             <dd><input type="text" name="group" id="group" size="32" maxlength="128" value="<? echo $row['gp']; ?>"/></dd>
			</dd>
		</dl>
		<dl>
        <dl>
        	<dt><lable class="ex">*</lable><label for="lecturer">Lecturers No.:</label>&nbsp;</dt>
          	<dd><input type="text" name="group" id="group" size="32" maxlength="128" value="<? echo $row['lecturer']; ?>"/></dd>
			</dd>
		</dl>
		<dl>
            <dt><lable class="ex">*</lable><label for="semester">Semester</label></dt>
            <dd><input type="text" name="group" id="group" size="32" maxlength="128" value="<? echo $row['semester']; ?>"/></dd>
         </dl>
         <dl>
			<dt><lable class="ex">*</lable><label for="session">Session</label></dt>
			 <dd><input type="text" name="group" id="group" size="32" maxlength="128" value="<? echo $row['session']; ?>"/></dd>
		</dl>
		<dl>
        	<dt><lable class="ex">*</lable><label for="email">Email Address:</label></dt>
            <dd><input type="text" name="email" id="email" size="32" maxlength="128"  value=<? echo $row['email']; ?> /></dd>
        </dl>
        <dl>
			<dt><label for="website">Website:</label></dt>
			<dd><input type="text" name="website" id="website"size="32" maxlength="128"   value=<? echo $row['website']; ?>/></dd>
		</dl>
        
		<dl>
        	<dt><label for="upload">Profile Picture:</label></dt>
            <dd> <input name="pic" id="pic"type="file" /></dd>
        </dl>
       <dl><dd><input type="submit" name="submit" id="submit"  value="Edit" /></dd></dl>
	</fieldset>
</form>
	 
</div>

</body>
</html>