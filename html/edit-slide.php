<?php
session_start();
include_once 'dbconnect.php';

//if were on the first slide, set the count to 1

if (empty($_SESSION['count']))
    $_SESSION['count'] = 1;

//if the next slide button pressed or finish button
if (isset($_POST['next-slide'])||isset($_POST['Finish'])) {
    
    //get all dom objects
    //slide table 
    $title = $_POST['slideTitle'];
    $quest = $_POST['questText'];
    $image = $_POST['questImage'];
    $pos = $_POST['pos'];
    $ans = $_POST['ans'];
    
    //answer table
    $ansA = $_POST['ansA'];
    $ansB = $_POST['ansB'];
    $ansC = $_POST['ansC'];
    $ansD = $_POST['ansD'];
    $ansE = $_POST['ansE'];
    $ansF = $_POST['ansF'];
    
    //update current slide
    $update = mysql_query("update slides
							    set title   = '$title',
								imagePos    = '$pos',
								correct     = '$ans',
								quest_text  = '$quest',
								quest_image = '$image'
							where slide_id=" . $_SESSION['curSlide'] . " ;");
    
    
    //update answers in current slide
    $updateAns = mysql_query("update answers set answer = '$ansA' where answer_letter='A' and slide_id=" . $_SESSION['curSlide'] . " ;");
    $updateAns = mysql_query("update answers set answer = '$ansB' where answer_letter='B' and slide_id=" . $_SESSION['curSlide'] . " ;");
    $updateAns = mysql_query("update answers set answer = '$ansC' where answer_letter='C' and slide_id=" . $_SESSION['curSlide'] . " ;");
    $updateAns = mysql_query("update answers set answer = '$ansD' where answer_letter='D' and slide_id=" . $_SESSION['curSlide'] . " ;");
    $updateAns = mysql_query("update answers set answer = '$ansE' where answer_letter='E' and slide_id=" . $_SESSION['curSlide'] . " ;");
    $updateAns = mysql_query("update answers set answer = '$ansF' where answer_letter='F' and slide_id=" . $_SESSION['curSlide'] . " ;");
    
    //increase the count to go to next slide in order
    $_SESSION['count']++;
    
}

$order = $_SESSION['count'];

//get selected presentation name
$_SESSION['pres'] = mysql_real_escape_string($_POST['presentation']);

//if were on the first presentation 
//work around to keeping the presentation name that was gotten from homepage
if ($order == 1) {
    $pre = $_SESSION['pres'];
    $_SESSION['final'] = $pre;
}

//get presentation id from selected presentation
$presId = mysql_query("select presentation_id from presentations where presentation_name= '" . $_SESSION['final'] . "'");
$row = mysql_fetch_array($presId);
$currentId = $row['presentation_id'];

//get slide id from slide currently being edited
$sql = mysql_query("select * from slides where slide_order = $order and presentation_id = $currentId");
$currentRow = mysql_fetch_array($sql);

//store the current slide in session to be used for database update.
$_SESSION['curSlide'] = $currentRow['slide_id'];

//get the last slide
$dbSlideOrder = mysql_query("select max(slide_order) slOrd from slides where presentation_id = $currentId;");
$maxorderRow  = mysql_fetch_array($dbSlideOrder);


//get the current answers to populate the input boxes
$sql2 = mysql_query("select * from answers where slide_id=" . $currentRow['slide_id'] . " and answer_letter='A';");
$AnsA = mysql_fetch_array($sql2);

$sql2 = mysql_query("select * from answers where slide_id=" . $currentRow['slide_id'] . " and answer_letter='B';");
$AnsB = mysql_fetch_array($sql2);

$sql2 = mysql_query("select * from answers where slide_id=" . $currentRow['slide_id'] . " and answer_letter='C';");
$AnsC = mysql_fetch_array($sql2);

$sql2 = mysql_query("select * from answers where slide_id=" . $currentRow['slide_id'] . " and answer_letter='D';");
$AnsD = mysql_fetch_array($sql2);

$sql2 = mysql_query("select * from answers where slide_id=" . $currentRow['slide_id'] . " and answer_letter='E';");
$AnsE = mysql_fetch_array($sql2);

$sql2 = mysql_query("select * from answers where slide_id=" . $currentRow['slide_id'] . " and answer_letter='F';");
$AnsF = mysql_fetch_array($sql2);

//when next slide clicked, return to same page
if (isset($_POST['next-slide'])) {
    header("Location: edit-slide.php");
}
//if finished or cancelled, go back to homepage and reset the slide order
if (isset($_POST['Finish'])||isset($_POST['cancel'])) {
    unset($_SESSION['count']);
    header("Location: homepage.php");
}

?>


<!DOCTYPE html>
<html = lang="en">
<head>
<meta charset="utf-8">
<title>Edit presentation</title>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type-="text/css" href="style.css">
	<script src="create.js"></script>
</head>
<body>
<script>
	// check if the database returns an image string when the page loads
	window.onload = function(){
	if (document.getElementById('questImage').value!=''){
		document.getElementById('imageQuestion').checked=true;
		document.getElementById("questImage").removeAttribute("disabled");
		document.getElementById("post").removeAttribute("disabled");
		document.getElementById("posl").removeAttribute("disabled");
		document.getElementById("posr").removeAttribute("disabled");
		document.getElementById("posb").removeAttribute("disabled");
	}

}
</script>
    <h1>Edit Presentation</h1>
	<form class="form-horizontal" action="edit-slide.php" name="next-slide" method="post">
	<b>Instructions:</b> <br/>
		To use images in your slides please host images on an image hosting site of your choice. Then provide the url in the text field.<br/> 
		Once answer options are filled in please select the correct answer.<br/>
		<b>NOTE:</b> Image text box must be selected in order to show images and all answers must be in the same format. 
	
		</div>
		<br><br>
		<div class="form-group">
			<label> Slide Title: </label>
			<input type = "text"  name="slideTitle" class= "form-control" id="slide_title" placeholder="Slide Title" value="<?php echo $currentRow['title'];?>">
		</div>
		<div class="form-group">
			<input type="checkbox" name="chkQuest" id="imageQuestion" name="imageQuest"
				onchange="document.getElementById('questImage').disabled = !this.checked;
						  document.getElementById('post').disabled = !this.checked;
						  document.getElementById('posl').disabled = !this.checked;
						  document.getElementById('posr').disabled = !this.checked;
						  document.getElementById('posb').disabled = !this.checked;"> Questions is an image</input>
		</div>

		<div class="form-group">
			<label> Question: </label>
			<textarea type="text" name="questText" class="form-control" rows= "5" id= "question" placeholder="Question Text"><?php echo $currentRow['quest_text'];?></textarea>
		</div>

		<div class="form-group">
			<label>Question image:</lable>
			<input type="text" disabled class="form-control" id="questImage" name="questImage" value="<?php echo $currentRow['quest_image'];?>" placeholder="Question Image URL">
		</div>
		<div class="form-group">
			<label> Question Image Alignment:</label>
			<div class="radio">
				<label><input disabled type="radio" <?php echo ($currentRow['imagePos'] =='T')?'checked':'' ?> id="post" name="pos" value="T">Top</label>
				<label><input disabled type="radio" <?php echo ($currentRow['imagePos'] =='L')?'checked':'' ?> id="posl" name="pos" value="L">Left</label>
				<label><input disabled type="radio" <?php echo ($currentRow['imagePos'] =='R')?'checked':'' ?> id="posr" name="pos" value="R">Right</label>
				<label><input disabled type="radio" <?php echo ($currentRow['imagePos'] =='B')?'checked':'' ?> id="posb" name="pos" value="B">Bottom</label>
			</div>
		</div>
		<div class="form-group"> 
		<label> Answers:</label>
			<div class="radio">
				<label><input type="radio" <?php echo ($currentRow['correct'] =='A')?'checked':'' ?> name="ans" value= "A">
					<input type="text" class="form-control" id="ans1" name="ansA" value="<?php echo $AnsA['answer'];?>" placeholder= "Answer Option">
				</label>
				<label><input type="radio" <?php echo ($currentRow['correct'] =='B')?'checked':'' ?> name="ans" value="B">
					<input type="text" class="form-control" id="ans2" name="ansB" value="<?php echo $AnsB['answer'];?>" placeholder= "Answer Option">
				</label><br/>
				<label><input type="radio" <?php echo ($currentRow['correct'] =='C')?'checked':'' ?> name="ans" value="C">
					<input type="text" class="form-control" id="ans3" name="ansC" value="<?php echo $AnsC['answer'];?>" placeholder= "Answer Option">
				</label>
				<label><input type="radio" <?php echo ($currentRow['correct'] =='D')?'checked':'' ?> name="ans" value="D">
					<input type="text" class="form-control" id="ans4" name="ansD" value="<?php echo $AnsD['answer'];?>" placeholder= "Answer Option">
				</label><br/>
				<label><input type="radio" <?php echo ($currentRow['correct'] =='E')?'checked':'' ?> name="ans" value="E">
					<input type="text" class="form-control" id="ans5" name="ansE" value="<?php echo $AnsE['answer'];?>" placeholder= "Answer Option">
				</label>
				<label><input type="radio" <?php echo ($currentRow['correct'] =='F')?'checked':'' ?> name="ans" value="F">
					<input type="text" class="form-control" id="ans6" name="ansF" value="<?php echo $AnsF['answer'];?>" placeholder= "Answer Option">
				</label><br/>
			</div>
		</div>

		<div class="col-sm-6 col-sm-offest-3 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
			<button type="submit" class="btn btn-info" id="cancel" name="cancel"> Cancel</button>
			<button type="submit" class="btn btn-info" id="next-slide" name="next-slide">Next Slide</button>
			<button type="submit" class="btn btn-info" id = "close" name="Finish">Finish & Save</button>
		</div>
	</form>

	<?php
	//if were at the last slide, hide the next slide button
	if ($order == $maxorderRow["slOrd"]){
    ?>
    	<script>document.getElementById('next-slide').style.display = 'none';</script>
    <?php
    }
	?>
</body>
</html>