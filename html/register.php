<?php
session_start();
if(isset($_SESSION['user']))
{
	header("Location: home.php");
}
include_once 'dbconnect.php';

if(isset($_POST['btn-signup']))
{
	$email = mysql_real_escape_string($_POST['email']);
	$fname = mysql_real_escape_string($_POST['fName']);
	$lname = mysql_real_escape_string($_POST['lName']);
	$pwd = md5(mysql_real_escape_string($_POST['pwd']));
	$cpwd = md5(mysql_real_escape_string($_POST['cpwd']));
	$uni = mysql_real_escape_string($_POST['uni']);
	$uni_id = mysql_real_escape_string($_POST['uni_id']);

if($pwd == $cpwd)
{
	if(mysql_query("INSERT INTO users(email, first_name, last_name, password, student_id, university) VALUES('$email','$fname','$lname', '$pwd', '$uni_id', '$uni' )"))
	{ 
		$chars = array(".", "com", "@", " ");
		$dir = str_replace($chars, "",$email);
		if(mkdir($dir, 777))
		{
			//echo $dir;
			?>
				<script>alert('sucessfully registered ');
                  window.location.href = "index.php";
            </script>
			<?php

		}
		else
		{
			//single quotes are intentional becuase mysql failed to read email correctly without them RM
			mysql_query("DELETE FROM users WHERE email ='".$email."';");
			//echo $dir;
			?> 
			<script> alert('Error: username taken'); </script>
			<?php
		}
	}
	else
	{
		?>
			<script>alert('error while registering you...');</script>
			<?php
	}
}
else
{
	?>
		<script>alert('password and comfirm password must match');</script>
		<?php
}
}
?>
<!DOCTYPE html>
<html>
   <head>
      <title>Registration</title>
      <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	  <link rel="stylesheet" type= "text/css" href="style.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
      <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
   </head>

   <script>
      $(document).ready(function(){
         $('[data-toggle="popover"]').popover();   
      });
   </script> 
   <body>
		<h1> New User Registration</h1>
		<form class="form-horizontal" role="form" method="post" >
        <br/>

		<!-- Must have this to make form lined up -->
         <div class="form-group" >

            <!-- this class controls the column grid for the label-->
            <label class="control-label col-xs-12 col-sm-2 col-md-2 col-lg-2" for="email">Email:</label>

            <!-- this class controls the column grid for the input box-->
            <div class="col-xs-12 col-sm-10 col-md-6 col-lg-4">
               <input type="email" required  class="form-control" name="email" placeholder="Enter E-mail">
            </div>
         </div>

         <div class="form-group">
            <label class="control-label col-xs-12 col-sm-2 col-md-2 col-lg-2" for="fName">First Name:</label>
            <div class="col-xs-12 col-sm-10 col-md-6 col-lg-4">
               <input type="text" required  class="form-control" name="fName" placeholder="Enter First Name">
            </div>
         </div>

         <div class="form-group">
            <label class="control-label col-xs-12 col-sm-2 col-md-2 col-lg-2" for="lName">Last Name:</label>
           <div class="col-xs-12 col-sm-10 col-md-6 col-lg-4">
               <input type="text" required  class="form-control" name="lName" placeholder="Enter Last Name">
            </div>
         </div>

         <div class="form-group">
            <label class="control-label col-xs-12 col-sm-2 col-md-2 col-lg-2" for="pwd">Password:</label>
            <div class="col-xs-12 col-sm-10 col-md-6 col-lg-4">
               <input type="password"  required  class="form-control" name="pwd" placeholder="Enter Password">
               <a href="#" data-toggle="popover" class="col-xs-12 col-md-12 col-lg-12" data-trigger="focus" data-content="This password must have some special pattern">Password Requirements</a> 
            </div>
         </div>

         <div class="form-group">
            <label class="control-label col-xs-12 col-sm-2 col-md-2 col-lg-2" for="cpwd">Confirm Password:</label>
            <div class="col-xs-12 col-sm-10 col-md-6 col-lg-4">
               <input type="password" required class="form-control" name="cpwd" placeholder="Confirm Password">
            </div>
         </div>

         <div class="form-group">
            <label class="control-label col-xs-12 col-sm-2 col-md-2 col-lg-2" for="uni">Univeristy:</label>
            <div class="col-xs-12 col-sm-10 col-md-6 col-lg-4">
               <input type="text"  class="form-control" name="uni" placeholder="Enter University">
            </div>
         </div>
		 
		 <div class="form-group">
           <label class="control-label col-xs-12 col-sm-2 col-md-2 col-lg-2" for="uni_id">Student ID:</label>
           <div class="col-xs-12 col-sm-10 col-md-6 col-lg-4">
              <input type="text" class="form-control" name="uni_id" placeholder="Enter Student ID">
           </div>
         </div>

         <div class="form-group" style="margin: auto">
            <div class="col-xs-offset-5 col-sm-offset-5 col-md-offset-5 col-lg-offset-5">
				<button type="button" class="btn btn-default" onclick="parent.location='index.php'"> Back</button>
               <button type="submit" class="btn btn-primary" name = "btn-signup">Submit</button>
            </div>
         </div>
      </form>
   </body>
</html>
