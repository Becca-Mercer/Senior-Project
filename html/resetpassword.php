<?php 
session_start();
include_once 'dbconnect.php';
if(isset($_SESSION['temp']))
{
	
	$email=mysql_real_escape_string($_SESSION['temp']);
	$res=mysql_query("SELECT * FROM users WHERE email='$email'");
	$userRow=mysql_fetch_array($res);
	if(isset($_POST['btn-newpass']))
	{
		$pass=md5(($_POST['pwd']));
		$cpass=md5(mysql_real_escape_string($_POST['cpwd']));
		if($pass == $cpass)
		{
			if(mysql_query("UPDATE users SET password='$pass' WHERE email='$email'"))
			{
				?>
				<script> alert('Password reset');</script>
				<?php
				header("Location:homepage.php");
			}
			else
			{
				?>
				<script> alert('There was a problem reseting your password.');</script>
				<?php
			}
		}
		else
		{
			?>
			<script> alert('Password and password comfirmation must match');</script>
			<?php
		}
	}
}
?>



<!DOCTYPE html>
<html>
<head>
	<title>Reset Password</title>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>


<h1> Reset Password</h1>
<form class="form-horizontal" role="form" action="resetpassword.php" name="btn-newpass" method="post">
	<div class="form-group">

		<div class="form-group">
			<label class="control-label col-sm-2" for="email">Email: <?php echo $email?></label>
			
		</div>
	<!-- this class controls the column grid for the label-->


		<div class="form-group">
			<label class="control-label col-sm-2" for="pwd">Password:</label>
			<div class="col-sm-2">
				<input type="password" required name="pwd" class="form-control" id="pwd" placeholder="Enter Password">
			</div>
		</div>


		<div class="form-group">
			<label class="control-label col-sm-2" for="cpwd">Confirm Password:</label>
			<div class="col-sm-2">
				<input type="password" required class="form-control" name="cpwd" id="cpwd" placeholder="Confirm Password">
			</div>
		</div>

		<div class="form-group" style="margin: auto">
			 <div class="col-xs-offset-5 col-sm-offset-5 col-md-offset-5 col-lg-offset-5">
				<button type ="submit" class="btn btn-primary" name = "btn-newpass">Submit</button>
			</div>
		</div>
	</div>
</form>



</body>
</html>
