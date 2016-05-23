<?php
session_start();
include_once 'dbconnect.php';

if(isset($_SESSION['user']))
{
 header("Location: homepage.php");
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>LAPA - Login</title>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css"></style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<div class="fluid-container">
	<section name="content">
		<div class = "login">
			<div class= "row">
				<div class= "col-sm-12 col-md-4 col-lg-5">
					<H1> LAPA</H1>
				</div>
				<div class=" col-sm-12 col-md-8 col-lg-7">
					<div class = "row">
						<div class= "col-xs-12">
							<h4>Log in as Host</h4>
						</div>
					</div>
					<div class="row">
							<div class= "col-xs-12 col-sm-6 col-md-8 col-lg-12">
								<form class="form-inline" action= "btn-login.php" method="post">						
									<div class="form-group">
										<label class="sr-only" for="username">Email</label>
										<input type="text" class="form-control" placeholder="Email" required="" name="email"/>
									</div>
									<div class= "form-group">
										<label class="sr-only" for="password"> Password</label>
										<input type="password" class="form-control" placeholder="Password" required="" name="pass"/>
									</div>
									<button class="btn btn-primary btn-sm" type = "submit" name="btn-login"> Login</button>
									<button class="btn btn-default btn-sm" type = "register" onclick="parent.location='register.php'"> Register</button>
									<button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#resetModal">Reset Password</button>
							</form><!-- form -->
						</div>
					</div>
				</div>	
			</div>
		</div>	
		<form lass="form-horizontal" role="form" action="join.php" method="post" style="padding: 20px">
			<div class = "row">
				<div class= "col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">
					<h3>Join Session - No registration required</h3>
				</div>
			</div>
			<div class = "row">
				<div class= "col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">
					<label class="sr-only" for="sessionID"> Session ID</label>
					<input type="text" class="form-control" placeholder="Session ID" required="" name="sessionID" />
				</div>
			</div>
			<div class = "row">
				<div class= "col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">
					<button class="btn btn-primary" type = "submit" name="join"> Join Session</button>
				</div>	
			</div>
		</form>
	</section><!-- content -->
</div><!-- container -->


<!-- Modal -->
  <div class="modal fade" id="resetModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4>Please provide email to reset password.</h4>
        </div>
        <div class="modal-body">
		<form class ="form-horizontal" role="form" action="btn-reset.php" method="post">
			<label>Email: </label>
			<input type="text" class="form-control" name="usrEmail" placeholder="Enter E-mail"></input>
			<button type="submit" class="btn btn-info" name="btn-reset">Reset Password</button>
		</form>
		</div>
        
      </div>
    </div>
  </div>

</body>
</html>
