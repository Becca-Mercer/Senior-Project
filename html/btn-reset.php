<?php
session_start();
include_once 'dbconnect.php';
if(isset($_POST['btn-reset']))
{
	 $email = mysql_real_escape_string($_POST['usrEmail']);
	 
	 $res = mysql_query("SELECT * FROM users WHERE email='$email'");
	 echo $res;
	 if(mysql_num_rows($res)==0)
	 {
		 ?>
		 <script> alert('Email not found, please register');</script>
		 <?php
		 
	 }
	 else
	 {
	 $row = mysql_fetch_array($res);
	 $_SESSION['temp'] = $row['email'];
	 header("Location: resetpassword.php");
	 }
}
?>
