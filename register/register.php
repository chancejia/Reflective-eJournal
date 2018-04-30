<?php
	session_start();
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> <!--content="text/html; charset=utf-8"-->
<script language="javascript" type="text/javascript" src="../css/niceforms.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="../css/niceforms-default.css" />
<link rel="stylesheet" type="text/css" href="../css/mystyle.css" />
<link REL="SHORTCUT ICON" HREF="../images/ico/register.png">
<script type="text/javascript">
function checkType(){   
  var fileName=document.getElementById("pic").value;   
     
  var seat=fileName.lastIndexOf(".");   
    
  var extension=fileName.substring(seat).toLowerCase();   
  var allowed=[".jpg",".gif",".png",".bmp",".jpeg"];   
  for(var i=0;i<allowed.length;i++){   
      if(!(allowed[i]!=extension)){   
          return true;   
      }   
  }   
  alert("not supported"+extension+"format");   
  return false;   
}  
</script>
<title>Regester Form</title>

<!--external style sheet
<link rel="stylesheet" type="text/css" href="../mystyle.css" />-->
</head>

<body>
	<div align="center">
		<div class="background">
		<div class="transbox"  align="center">
		<h1 class="over" align="center" >Welcome to Reflective eJournal! </h1>
		</div>
		</div>
	<br/>

    </div>
	<br/>
   	<ul class="a">
	<li class="a" ><a class="a" href="../index.php">HOME</a></li>
	</ul>
	

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
          	<input type="checkbox" name="lecturer[]" id="Marini Abu Bakar" value="1" /><label for="Marini Abu Bakar" class="opt">Marini Abu Bakar</label><br/>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="checkbox" name="lecturer[]" id="Dr. Md. Jan Nordin" value="2" /><label for="CDr. Md. Jan Nordin+" class="opt">Dr. Md. Jan Nordin</label><br/>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="checkbox" name="lecturer[]" id="Dr. Salwani Abdullah" value="3" /><label for="Dr. Salwani Abdullah" class="opt">Dr. Salwani Abdullah</label><br />
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="checkbox" name="lecturer[]" id="Dr. Mohd. Juzaidin" value="4" /><label for="Dr. Mohd. Juzaidin" class="opt">Dr. Mohd. Juzaidin</label><br/>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="checkbox" name="lecturer[]" id="Dr. Sufian Idris" value="5" /><label for="Dr. Sufian Idris" class="opt">Dr. Sufian Idris</label>
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