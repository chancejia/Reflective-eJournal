<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> <!--content="text/html; charset=utf-8"-->
<script language="javascript" type="text/javascript" src="css/niceforms.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="css/niceforms-default.css" />
<link REL="SHORTCUT ICON" HREF="images/ico/ukm.ico">
<link rel="stylesheet" type="text/css" href="mystyle.css" />
</head>

<body>
	<div align="center">
		<div class="background" >
		<div class="transbox"  >
		<h1 class="over" align="center">Welcome to Reflective <i>e</i>Journal! </h1>
		</div>
		</div>
<br/>
<?php
  require_once('config.php');
  date_default_timezone_set('Asia/Brunei'); //set time zone as UTC+8
  $date = date('D, M d, Y h:i a', time());
$query = "SELECT id FROM users";
$result = mysql_query($query) or die('Error, query failed');
$total_items = mysql_num_rows($result);
echo "<br/><blockquote align='center'>There have been ".$total_items." users stay in Reflective <i>e</i>Journals until <i>".$date."</i></blockquote>";
?>
<br/><br/>
      <fieldset>

        <h2 align="center"> Haven't you registered yet? </h2><br>

        
        <form id="form1" name="form1" class="niceform"  method="post" action="register/register.php">
            <input type="submit" name="button" id="button" value="Register Now!" />
        </form>
  


       <form id="loginForm" name="loginForm" class="niceform"  method="post" action="login/login_process.php">


        <h2 align="center" >&nbsp;Sign in your <em>e</em>Journal!</h2>
 
   
            <dl>
            <dt><label for="matric">&nbsp;&nbsp;Matric No.</label></dt>
			<dd><input name="matric" type="text" id="matric" size="45"/></dd>
            </dl>
            <dl>
			<dt><label for="password">&nbsp;&nbsp;Password</label>&nbsp;</dt>
  			<dd><input name="password" type="password" size="45" /><br/> </dd>
            </dl>

    	<dl><input type="submit"  name="button" id="button"   value="login" /></dl>

    </form>
  </fieldset>

<br/>
<br/>
	<div id="footer">
			copyright &copy; Universiti Kebangsaan Malaysia
		</div>

</body>
</html>
