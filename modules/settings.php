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
<link REL="SHORTCUT ICON" HREF="../images/ico/settings.png">
<script language="javascript" type="text/javascript" src="../../css/niceforms.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="../../css/niceforms-default.css" />
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
        	<dt width="40"><lable class="ex">*</lable><label for="matric">Matric:</label></dt>
            <dd><input type="text" name="matric" id="matric" size="32" maxlength="128" />(e.g. :A12345)</dd>
        </dl>
		<dl>
        	<dt><lable class="ex">*</lable><label for="password">Password:</label></dt>
            <dd><input type="password" name="password" id="password" size="32" maxlength="32" /></dd>
        </dl>
        <dl>
        	<dt><lable class="ex">*</lable><label for="cpassword">Confirm Password:</label></dt>
            <dd><input type="password" name="cpassword" id="cpassword" size="32" maxlength="32" /></dd>
        </dl>
        <dl>
        	<dt><lable class="ex">*</lable><label for="fname">First Name:</label></dt>
            <dd><input type="text" name="fname" id="fname" size="32" maxlength="128" /></dd>
        </dl>
        <dl>
        	<dt><lable class="ex">*</lable><label for="lname">Last Name:</label></dt>
            <dd><input type="text" name="lname" id="lname" size="32" maxlength="128" /></dd>
        </dl>
        <dl>
        	<dd><lable class="ex">*</lable><label for="group">Groups:</label> &nbsp;&nbsp;  
           	<input type="checkbox" name="group[]" id="Java" value="Java" /><label for="Java" class="opt">Java</label>&nbsp;&nbsp;&nbsp;
            <input type="checkbox" name="group[]" id="C++" value="C++" /><label for="C++" class="opt">C++</label>
			</dd>
		</dl>
		<dl>
        <dl>
        	<dd><lable class="ex">*</lable><label for="lecturer">Lecturers:</label>&nbsp;
          	<input type="checkbox" name="lecturer[]" id="Marini Abu Bakar" value="Marini Abu Bakar" /><label for="Marini Abu Bakar" class="opt">Marini Abu Bakar</label><br/>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="checkbox" name="lecturer[]" id="Dr. Md. Jan Nordin" value="Dr. Md. Jan Nordin" /><label for="CDr. Md. Jan Nordin+" class="opt">Dr. Md. Jan Nordin</label><br/>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="checkbox" name="lecturer[]" id="Dr. Salwani Abdullah" value="Dr. Salwani Abdullah" /><label for="Dr. Salwani Abdullah" class="opt">Dr. Salwani Abdullah</label><br />
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="checkbox" name="lecturer[]" id="Dr. Mohd. Juzaidin" value="Dr. Mohd. Juzaidin" /><label for="Dr. Mohd. Juzaidin" class="opt">Dr. Mohd. Juzaidin</label><br/>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="checkbox" name="lecturer[]" id="Dr. Sufian Idris" value="Dr. Sufian Idris" /><label for="Dr. Sufian Idris" class="opt">Dr. Sufian Idris</label>
			</dd>
		</dl>
		
            <dd colspan =2 align="center"><lable class="ex">*</lable><label for="semester">Semester</label>
            	<select size="1" name="semester" id="semester">
					<option value="">select a semester</option>
                	<option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <lable class="ex">*</lable><label for="session">Session</label>
                <select size="1" name="session" id="session">
				<option size="15" value=""> select a session&nbsp;&nbsp;</option>
                <option value="2010/2011">2010/2011</option>
				<option value="2010/2011">2010/2011</option>
				<option value="2011/2012">2011/2012</option>
				<option value="2012/2013">2012/2013</option>
				<option value="2013/2014">2013/2014</option>
                <option value="2014/2015">2014/2015</option>
                </select>
            </dd>
        </dl>
		<dl>
        	<dt><lable class="ex">*</lable><label for="email">Email Address:</label></dt>
            <dd><input type="text" name="email" id="email" size="32" maxlength="128" /></dd>
        </dl>
        <dl>
			<dt><label for="website">Website:</label></dt>
			<dd><input type="text" name="website" id="website"size="32" maxlength="128" /></dd>
		</dl>
        
		<dl>
        	<dt><label for="upload">Profile Picture:</label></dt>
            <dd> <input name="pic" id="pic"type="file" /></dd>
        </dl>
       <dl><dd><input type="submit" name="submit" id="submit"  value="Join Now!" /></dd></dl>
	</fieldset>
</form>
	 
</div>

</body>
</html>