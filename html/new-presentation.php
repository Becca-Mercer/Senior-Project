<?php
session_start();
include_once 'dbconnect.php';

if(isset($_SESSION['user']))
{
	if(isset($_POST['new-pres']))
	{
		$email =$_SESSION['user'];
		$name = mysql_real_escape_string($_POST['title']);
		$chars = array(".", "com", "@"," ");
		$userDir = str_replace($chars, "",$email);
		$presDir = str_replace($chars, "",$name);
		$path = $userDir."/".$presDir;
		
		chmod ($userDir, 0755);
		if(mkdir($path, 0777))
		{
			//$id = rand(0,9999);
			if(!mysql_query("INSERT INTO presentations (email,presentation_name,path)VALUES ('$email','$name','$path');"))
			{
				$error = error_get_last();
				echo $error['message'];
				rmdir($path);
				?>
				<script> alert('There was a problem creating your presentation');</script>
				<?php
			
			}
			else
			{
				$_SESSION['pres']= mysql_query("select presentation_id from presentations where email='$email' and presentation_name = '$name'");
				header("Location: new-slide.php");
			}
		}
		else
		{
			echo $path;
			?> 
			<script> alert('Error: Presentation name taken'); </script>
			<?php
		}

	}
}
else
{
	header("Location : index.php");
}
?>

<!DOCTYPE html>
<html = lang="en">
<head>
<meta charset="utf-8">
<title>Create presentation</title>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type-="text/css" href="style.css">
	<script src="create.js"></script>
</head>

<body>
 <h1> Create Presentation</h1>
	<form class="form-horizontal" role="form"  action="new-presentation.php" method="post">
		<div class="form-group">
			<label>Presentation Name: </label>
			<input type="text" class="form-control" name="title" id="presentation_title" placeholder="Presentation name" />
		</div>
		<input type="checkbox" name="title" id= "title"> Title Screen</input>
		<button type="submit" class="btn btn-info" name="new-pres">Next ></button>
	</form>
</body>
</html>