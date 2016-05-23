<?php
session_start();
include_once 'dbconnect.php';
if(!isset($_SESSION['user']))
{
 header("Location: index.php");
}
?>

<!DOCTYPE html>
<html = lang="en">
<head>
<meta charset="utf-8">
<title>Welcome</title>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type-="text/css" href="style.css">
</head>

<body>
<div class="fluid-container">
<div class= "login col-sm-12 col-md-12 col-lg-12">
<div class= "col-sm-9 col-md-9 col-lg-9">
<h2>Homepage</h2>
</div>
<div class="col-sm-2 col-md-2 col-lg-2">
<form class="form-inline" action= "logout.php" name="logout-form" method="post">
<button class="btn btn-primary" name="logout" style="margin-top:15px;"> Logout</button>
</form>
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<form action= "join.php" method="post">
	<div class= "col-xs-5  col-sm-5 col-md-4  col-md-offset-2 col-lg-3 col-lg-offset-2">
		<input type="text" class="form-control" placeholder="Session ID" required="" name="sessionID" />
	</div>
	<div class= "col-xs-4 col-sm-6 col-md-6 col-lg-6">	
		<button class="btn btn-primary" type="submit" name="join">Join Session</button>
  	</div>
</form>
</div>

<div class= "col-xs-12 col-sm-12 col-md-8 col-md-offset-2 col-lg -8 col-lg-offset-2">
<form id="selectForm" class="form-inline" action="session.php" name="session" method="post">
    <h3>Presentations</h3>
    <?php 
    $sList=mysql_query("select presentation_name from presentations where email='".$_SESSION['user']."'");
    echo "<select id='presentationList' size='8' style='width: 300px' name='presentation'>"; 
    echo "<option selected disabled> Select Presentation</option>";
    while ($row = mysql_fetch_array($sList,MYSQL_ASSOC)){
    	echo "<option value='{$row['presentation_name']}'> {$row['presentation_name']}</option>";
    }
    ?>
	</select>
    <!--change the action attribute if editing a slide-->
    
    
	<div>
    	<button class="btn btn-default" type="submit" id="edit" name="edit" onclick="parent.location='edit-slide.php'">Edit</button>
		<button id="host" class="btn btn-default" type="submit" name="session">Host</button>
    	<button type="button" class="btn btn-primary" onclick="parent.location='new-presentation.php'">Create Presentation</button>
		<button type="submit" class="btn btn-default" name="results">View Results</button>
	</div>  
</form> 
</div>
</div>
  <script>
        $('#edit').click(function(){
            $('#selectForm').attr('action', 'edit-slide.php');
            $('#selectForm').submit();
        });

    </script>
</body>    
</html>