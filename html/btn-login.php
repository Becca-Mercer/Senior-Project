<?php
session_start();
include_once 'dbconnect.php';

if(isset($_POST['btn-login']))
{
 $email = mysql_real_escape_string($_POST['email']);
 $upass = mysql_real_escape_string($_POST['pass']);
 $res=mysql_query("SELECT * FROM users WHERE email='$email'");
 $row=mysql_fetch_array($res);
 if($row['password']==md5($upass))
 {
  $_SESSION['user'] = $row['email'];
  header("Location: homepage.php");
 }
 else
 {
  ?>
        <script>alert('Incorrect login/password \n');
        		window.location.href = "index.php";
        </script>
   <?php
  		      
 }
 
}
?>