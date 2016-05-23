<?php
session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['user']))
{
 header("Location: index.php");
}
$res=mysql_query("SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=mysql_fetch_array($res);
?>


<!DOCTYPE html>
<html = lang="en">
<head>
<meta charset="utf-8">
<title>Welcome - <?php echo $userRow['email']; ?></title>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type-="text/css" href="style.css">
	<script src="create.js"></script>
</head>

<body>
<h1>Homepage</h1>
<form class="form-inline" action= "logout.php" name="logout-form" method="post">
<button class="btn btn-sm" name="logout"> Logout</button>
</form>
<div class= "col-xs-12 col-sm-4 col-md-4 col-lg-4">
<form>
    <h3>Class List</h3>
	<select id="classList" size="6" >
	<option selected disabled> Select Class</option>
	</select>
	<div>
    	<button class="btn btn-default" type="button" onclick="alert('This button does nothing!')">View</button>
		<button class="btn btn-default" type="button" onclick="alert('This button does nothing!')">Join Session</button>
  	</div>
</form>
</div>

<div class= "col-xs-12 col-sm-6 col-md-4 col-lg-4">
<form>
    <h3>Presentations</h3>
    <select id="presentationList" size="6">
	<option selected disabled> Select Presentation</option>
	</select>
	<div>
    	<button class="btn btn-default" type="button" onclick="alert('This button does nothing!')">Edit</button>
		<button class="btn btn-default" type="button" onclick="alert('This button does nothing!')">Host</button>
    	<button type="button" class="btn btn-info" onclick="parent.location='new-presentation.php'">Create Presentation</button>
	</div>  
</form> 
</div>
  
  <!-- Modal-->
  <div class="modal fade" role="dialog" id ="slide">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4> Create Presentation</h4>
        </div>
        <div class="modal-body">
			<label> Slide Title: </label>
			<input type = "text"  name="slideTitle" class= "form-control" id="slide_title" placeholder="Slide Title"></input>
			<label> Number of Answers: </label> 
			<div class="dropdown open">
				<button class ="btn btn-secondary dropdown-toggle" id="dropdown" data-toggle="dropdown">
				  number of answers </button>
					<ul class="dropdown-menu" id="numSlides" name="numSlides">
						<li><a href="#" class="btn btn-secondary btn-block dropdown-item" type="button" id="2">2</a></li>
						<li><a href="#" class="btn btn-secondary btn-block dropdown-item" type="button" id="3">3</a></li>
						<li><a href="#" class="btn btn-secondary btn-block dropdown-item" type="button" id="4">4</a></li>
						<li><a href="#" class="btn btn-secondary btn-block dropdown-item" type="button" id="5">5</a></li>
						<li><a href="#" class="btn btn-secondary btn-block dropdown-item" type="button" id="6">6</a></li>
					</ul>
			</div>	
			
			<input type="checkbox" name="information" id="information"> Information Slide</input>
		</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" id="slide_content">Next ></button>
        </div>
      </div>
    </div>
  </div>

	<!-- modal-->
	<div class="modal fade" role="dialog" id ="content">
		<div class="modal-dialog">
		
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4> Create Presentation</h4>
			</div>
			<div class="modal-body">
			<b>Instructions:</b> <br/>
			To use images in your slides please host images on an image hosting site of your choice. Then provide the url in the text field.<br/> 
			<b>NOTE:</b> Image text box must be selected in order to show images and all answers must be in the same format. 
				<form class="form-horizontal">
					<div class="form-group">
						<input type="checkbox" name="imageQuest" id="imageQuestion"> Questions is an image</input></br>
						<input type="checkbox" name="imageAns" id="imageAnswers"> Answers are images</input>
						<textarea type="text" name="questText" class="form-control" rows= "5" id= "question" placeholder="Question Text"></textarea>
					</div>
					<div class="form-group">
					</div>
					<div class="form-group"> 
						<div class="radio">
							<label><input type="radio" name="ans">
								<input type="text" class="form-control" id="ans1" placeholder= "Answer Option">
							</label>
							<label><input type="radio" name="ans">
								<input type="text" class="form-control" id="ans2" placeholder= "Answer Option">
							</label>
							<label><input type="radio" name="ans">
								<input type="text" class="form-control" id="ans3" placeholder= "Answer Option">
							</label>
							<label><input type="radio" name="ans">
								<input type="text" class="form-control" id="ans4" placeholder= "Answer Option">
							</label>
							<label><input type="radio" name="ans">
								<input type="text" class="form-control" id="ans5" placeholder= "Answer Option">
							</label>
							<label><input type="radio" name="ans">
								<input type="text" class="form-control" id="ans6" placeholder= "Answer Option">
							</label>
						</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-info" id="cancel"> Cancel</button>
				<button type="button" class="btn btn-info" id="next_slide">New Slide</button>
				<button type="button" class="btn btn-info" id = "close">Finish</button>
			</div>
		  </div>
		</div>
	  </div>

</body>    
</html>

