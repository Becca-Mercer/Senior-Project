<?php
	
	session_start();
	include_once 'dbconnect.php';
	echo $_SESSION['user'];
	$presId = mysql_query("select max(presentation_id) as pres_id from presentations where email='".$_SESSION['user']."'");

	$row = mysql_fetch_array($presId);
	echo $row['pres_id'];

	if (isset($_POST['next-slide'])){
		//txt slideTitle - slide title
		//txt questText - question
		//txt questImage - image question
		//rad pos - image position
		//rad answer - correct answer

		//answer table
		//txt ansA-F answer text

		//slide table
		echo $title = $_POST['slideTitle'];
		echo $quest = $_POST['questText'];
		echo $image = $_POST['slideImage'];
		echo $pos   = $_POST['pos'];
		echo $ans   = $_POST['ans'];

		//answer table
		echo $ansA = $_POST['ansA'];
		echo $ansB = $_POST['ansB'];
		echo $ansC = $_POST['ansC'];
		echo $ansD = $_POST['ansD'];
		echo $ansE = $_POST['ansE'];
		echo $ansF = $_POST['ansF'];


		
		$dbSlideOrder = mysql_query("select slide_order from slides where presentation_id =".$row['pres_id'].";");
		$orderRow = mysql_fetch_array($dbSlideOrder);

		//get order from db. if order null, = 1,else increment.
		if (is_null($orderRow["slide_order"]))
			$orderCount = 1;
		else
			$orderCount=$orderRow["slide_order"]+1;

		//----this portion will insert into db
		//$slidesIns = mysql_query("insert into slides(presentation_id,imagePos,slide_order,title,correct,quest_text,quest_image)
		//						  values(".$row['pres_id'].",$pos,$orderCount,$title,$ans,$quest,$image)");	

		//query get slide id

		//$ansIns = mysql_query("insert into answers");



		//handle question text if there is an image for question!!!
	}
	
	$error = error_get_last(); 
	echo $error['message'];
	
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
	<form class="form-horizontal" action="sqltest.php" method="post">
	<b>Instructions:</b> <br/>
		To use images in your slides please host images on an image hosting site of your choice. Then provide the url in the text field.<br/> 
		Once answer options are filled in please select the correct answer.<br/>
		<b>NOTE:</b> Image text box must be selected in order to show images and all answers must be in the same format. 
		
			<!--
			<input type="checkbox" name="imageAns" id="imageAnswers" name="imageAns"> Answers are images</input><br/>
			<input type="checkbox" name="info" id="information" name="infoSlide"> Information Slide</input>-->
		</div>
		<br><br>
		<div class="form-group">
			<label> Slide Title: </label>
			<input type = "text"  name="slideTitle" class= "form-control" id="slide_title" placeholder="Slide Title">
		</div>
		<div class="form-group">
			<input type="checkbox" name="chkQuest" id="imageQuestion" name="imageQuest"
				onchange="document.getElementById('questImage').disabled = !this.checked;
						  document.getElementById('post').disabled = !this.checked;
						  document.getElementById('posl').disabled = !this.checked;
						  document.getElementById('posr').disabled = !this.checked;
						  document.getElementById('posb').disabled = !this.checked;
						  document.getElementById('question').disabled = this.checked;"> Questions is an image</input>
		</div>

		<div class="form-group">
			<label> Question: </label>
			<textarea type="text" name="questText" class="form-control" rows= "5" id= "question" placeholder="Question Text"></textarea>
		</div>

		<div class="form-group">
			<label>Question image:</lable>
			<input type="text" disabled class="form-control" id="questImage" name="questImage" placeholder="Question Image URL">
		</div>
		<div class="form-group">
			<label> Question Image Alignment:</label>
			<div class="radio">
				<label><input disabled type="radio" id="post" name="pos" value="T">Top</label>
				<label><input disabled type="radio" id="posl" name="pos" value="L">Left</label>
				<label><input disabled type="radio" id="posr" name="pos" value="R">Right</label>
				<label><input disabled type="radio" id="posb" name="pos" value="B">Bottom</label>
			</div>
		</div>
		<div class="form-group"> 
		<label> Answers:</label>
			<div class="radio">
				<label><input type="radio" name="ans" value= "A">
					<input type="text" class="form-control" id="ans1" name="ansA" placeholder= "Answer Option">
				</label>
				<label><input type="radio" name="ans" value="B">
					<input type="text" class="form-control" id="ans2" name="ansB"placeholder= "Answer Option">
				</label><br/>
				<label><input type="radio" name="ans" value="C">
					<input type="text" class="form-control" id="ans3" name="ansC" placeholder= "Answer Option">
				</label>
				<label><input type="radio" name="ans" value="D">
					<input type="text" class="form-control" id="ans4" name="ansD"placeholder= "Answer Option">
				</label><br/>
				<label><input type="radio" name="ans" value="E">
					<input type="text" class="form-control" id="ans5" name="ansE"placeholder= "Answer Option">
				</label>
				<label><input type="radio" name="ans" value="F">
					<input type="text" class="form-control" id="ans6" name="ansF"placeholder= "Answer Option">
				</label><br/>
			</div>
		</div>
		<div class="col-sm-6 col-sm-offest-3 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
			<button type="button" class="btn btn-info" id="cancel" name="cancel"> Cancel</button>
			<button type="submit" class="btn btn-info" id="next-slide" name="next-slide">New Slide</button>
			<button type="button" class="btn btn-info" id = "close" name="Finish">Finish & Save</button>
		</div>
	</form>
</body>
</html>