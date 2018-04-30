<?php
	require_once('../../config.php');
	require_once('../../auth.php');
	//$userhomename 
	//$userhomeid
	

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" 
"http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html" /> 

<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
						

<link href="../../login/loginmodule.css" rel="stylesheet" type="text/css" />
<link REL="SHORTCUT ICON" HREF="../../images/ico/write.png">
</head>

<body>
<h1>Welcome</h1>
<a href="../site/student_home.php">My Profile</a> | <a href="../../logout.php">Logout</a>
<br/>
<br/>
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

<table> 
<form id="publishForm" name="publishForm" method="post" action="journal_process.php">
    			<tr>
                <td>Classification:</td>
                <td>
                	<input type="radio" name="class" value="question" /><img src="../../images/question.png" alt="question" width="32" height="32" />&nbsp;&nbsp;&nbsp;
					<input type="radio" name="class" value="journal" /><img src="../../images/journal.png" alt="journal" width="32" height="32" />
					
				</td>
                </tr>
                <tr>
				<td width="70">title:</td>
				<td><input type="text" name="title" class="input" id="title" size=73 /></td>
			</tr>
			<tr>
				<td>language:</td>
				<td>
					<input type="radio" name="language" value="C++" />C++
					<input type="radio" name="language" value="Java" />Java
				</td>
			</tr>
			<tr>
				<td valign="top">content:</td>
                <td><textarea style="width: 460px; height: 300px;" name="content" id="content" ></textarea></td>
			</tr>
            <tr>
				<td width="70">tags:</td>
				<td><input type="text" class="input" name="tags" id="tags" size=73 /> </td>
			</tr>
            <tr>
				<td>visiable to:</td>
				<td>
					<input type="radio" name="visiable" value="1" />Myslef only
					<input type="radio" name="visiable" value="2" />Lecturer & me
                    <input type="radio" name="visiable" value="3" />All
				</td>
			</tr>
			<tr>
				<td></td>
           	  	<td><input type="submit" name="submit" value="Publish" />
				 </form>
				 <form id="cancel" name="cancel" method="post" action="../site/student_home.php" >
              	  	<button type="submit" name="cancel">Cancel</button>
                   </form>
              	</td>
			</tr>
</table>
</body>
</html>
