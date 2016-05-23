<?php
session_start();
include_once 'dbconnect.php';

if(isset($_POST['session']))
{
	
	$email = mysql_real_escape_string($_SESSION['user']);
	$presName = mysql_real_escape_string($_POST['presentation']);
	$pres = mysql_query("SELECT * FROM presentations WHERE presentation_name='$presName' AND email='$email';");
	$presentation = mysql_fetch_array($pres);
	$presID = $presentation['presentation_id'];
	$slides = mysql_query("SELECT * FROM slides WHERE presentation_id ='$presID';");
	$path ="/".$presentation['path'];
	ob_start(PHP_OUTPUT_HANDLER_CLEANABLE);
	if(mysql_query("INSERT INTO session (presentation_id) VALUES ('$presID');"))
	{
		$result = mysql_query("SELECT MAX(session_id) AS session_id FROM session WHERE presentation_id = '".$presentation['presentation_id']."';");
		$res = mysql_fetch_array($result);
		$session = mysql_real_escape_string($res['session_id']);
/************************************ 
 *setting up the html for the slide *
 ********************************** */
		
		while ($row = mysql_fetch_array($slides,MYSQL_ASSOC))
		{
			echo "<!doctype html> \n"; 
			echo "<html lang = 'en'> \n";
			echo "<HEAD> \n";
			echo "<META charset = 'UTF-8' name='viewport'> \n";
			echo "<link rel='stylesheet' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'> \n";
			echo "<link rel='stylesheet' type='text/css' href='/../../style.css'>";
			echo "<link rel='stylesheet' type='text/css' href='/../../template.css'>";
			echo "<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js'></script> \n";
			echo "<script src='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script> \n";
			echo "</HEAD> \n <BODY> \n";
			echo "<DIV class='row'><!-- Question Header -->	\n";
/**********************************
 *start question section          *
 **********************************/
			echo "<H1>".$row['title']." </H1> \n";
			echo "</DIV><!-- Question Header --> \n";
			echo "<DIV class='row'> <!-- Question Text --> \n";
			if(!isset($row['quest_image'])){
				echo "<DIV class = 'col-xs-12 col-md-12 col-lg-12'> \n";
				echo "<p>".$row['quest_text']."</P> \n";
				echo "</DIV> \n";			
				echo "</DIV><!-- Question Text --> \n";
			}
			elseif(!isset($row['imagePos']))// image without text or they forgot to select a position
			{
				echo "<DIV class='row'> \n <DIV class = 'col-xs-12 col-md-12 col-lg-12'>";
				echo "<img src='".$row['quest_image']."' class='img-responsive'>"; 
				echo "</DIV> \n	</DIV> \n <DIV class='row'> \n 	<DIV class = 'col-xs-12 col-md-12 col-lg-12'>";
				echo "<p>". $row['quest_text']."</P>";
				echo "</DIV>\n </DIV>";
			}
			elseif(strcmp($row['imagePos'],"T")==0)// image on top of text
			{
				echo "<DIV class='row'> \n <DIV class = 'col-xs-12 col-md-12 col-lg-12'>";
				echo "<img src='".$row['quest_image']."' class='img-responsive'>"; 
				echo "</DIV> \n	</DIV> \n <DIV class='row'> \n 	<DIV class = 'col-xs-12 col-md-12 col-lg-12'>";
				echo "<p>". $row['quest_text']."</P>";
				echo "</DIV>\n </DIV>";
			}
			elseif(strcmp($row['imagePos'],"B")==0)// image below text
			{
				echo "<DIV class='row'> \n <DIV class = 'col-xs-12 col-md-12 col-lg-12'>";
				echo "<p> ".$row['quest_text']." </P>";
				echo "</DIV> \n	</DIV> \n <DIV class='row'> \n <DIV class = 'col-xs-12 col-md-12 col-lg-12'>";
				echo "<img src='".$row['quest_image']."' class='img-responsive'>";
				echo "</DIV> \n </DIV>";
			}
			elseif(strcmp($row['imagePos'], "L")==0)// image to the left of text
			{
				echo "<DIV class='row'> \n <DIV class = 'col-xs-6 col-md-6 col-lg-6'>";
				echo "<img src='".$row['quest_image']."' class='img-responsive'>";
				echo "</DIV> \n <DIV class = 'col-xs-6 col-md-6 col-lg-6'>";
				echo "<p>".$row['quest_text']." </P>";
				echo "</DIV> \n </DIV>"; 
			}
			elseif(strcmp($row['imagePos'], "R")==0)// image to the right of text
			{
				echo "<DIV class='row'> \n <DIV class = 'col-xs-6 col-md-6 col-lg-6'>";	
				echo "<p>".$row['quest_text']." </P>";
				echo "</DIV> \n <DIV class = 'col-xs-6 col-md-6 col-lg-6'>";
				echo "<img src='".$row['quest_image']."' class='img-responsive'>";
				echo "</DIV> \n </DIV>"; 
			}
			else// some how we ended up with another letter we will assume they mean center
			{
				echo "<DIV class='row'> \n <DIV class = 'col-xs-12 col-md-12 col-lg-12'>";
				echo "<img src='".$row['quest_image']."' class='img-responsive'>"; 
				echo "</DIV> \n	</DIV> \n <DIV class='row'> \n 	<DIV class = 'col-xs-12 col-md-12 col-lg-12'>";
				echo "<p>". $row['quest_text']."</P>";
				echo "</DIV>\n </DIV>";
			}
			echo "<DIV class='row'><!-- Answers Section --> \n";
			echo "<form class='form-control' role='form' action='/../../answers.php' method='post'>\n";
			echo "<input type='hidden' name= 'session_id' value ='".$session."'></input>";
			echo "<input type='hidden' name= 'slide_order' value='".$row['slide_order']."'></input>";
/*********************************
 * Start Answer array            *
 *********************************/
			$ans = mysql_query("SELECT * FROM answers WHERE answer !='' AND slide_id = '".$row['slide_id'] ."';");
			while ($row2 = mysql_fetch_array($ans,MYSQL_ASSOC))
			{
					mysql_query("UPDATE answers SET count = 0 WHERE answer_id ='".$row2['answer_id']."';");
					echo "<div class ='cols-sm-12 cols-md-6 cols-lg-6'>\n";
					echo "<BUTTON type='submit' class = 'btn btn-primary btn-lg btn-block\' name='".$row2['answer_letter']."' id ='".$row2['answer_letter']."'>".$row2['answer_letter'].". ".$row2['answer']."</BUTTON>\n";
					echo "</div>\n";
			} 
			echo "</form> \n";
			echo "</div> <!-- Answer Section --> \n";
			echo "</div><!-- container --> \n</body>\n</html>";
		
			file_put_contents(".".$path."/slide".$row["slide_order"].".html",ob_get_contents());
			ob_clean();
		}
		

/*******************************
 * A little bit of html to have*
 * to show the html that was   *
 * already generated           *
 *******************************/
			echo "<!doctype html> \n"; 
			echo "<html lang = 'en'> \n";
			echo "<HEAD> \n";
			echo "<META charset = 'UTF-8' name='viewport'> \n";
			echo "<link rel='stylesheet' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'> \n";
			echo "<link rel='stylesheet' type='text/css' href='/../../style.css'>";
			echo "<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js'></script> \n";
			echo "<script src='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script> \n";
			echo "<TITLE>".$presentation['presentation_name']."</TITLE>\n";
			echo "</HEAD> \n <BODY> \n";
			echo "<DIV class='fluid-container side-bar panel'><!-- container -->\n";
			echo "<DIV class='col-sm-3 col-md-2 col-lg-2 side-bar'>\n";
			$slides2 = mysql_query("SELECT * FROM slides WHERE presentation_id ='$presID';");
			while ($row3 = mysql_fetch_array($slides2,MYSQL_ASSOC))
			{
				echo "<p><a href='slide".$row3['slide_order'].".html' target='content'> Question ".$row3['slide_order']."</a></p>\n";
			}
			echo "</DIV>\n";
			echo "<DIV class='col-sm-9 col-md-10 col-lg-10'>\n";
			echo "<iframe id='content' name='content' src='slide1.html'>\n";
			echo "</iframe>\n</DIV>\n</DIV> \n </BODY> \n </HTML>\n";
			file_put_contents(".".$path."/".$session.".html",ob_get_contents());
			ob_clean();
 
 
 
 /********************************
  * Redirection back to the html *
  ********************************/
		header("Location: ".$path."/".$session.".html");
	}
	
	else
	{
		?>
			<script>alert('Your presentation cannot be hosted at this time');</script>
		<?php 
	}
} 
/************************************************************************
 * Results handling is done here										*
 * the session number that was last hosted								*
 * a count for each answer letter 										*
 * a count for correct answers 											*
 * a Ratio correct 													*
 * This is will printed as a simple HTML document but not saved			*
 ************************************************************************/
elseif(isset($_POST['results']))
	{
	$email = mysql_real_escape_string($_SESSION['user']);
	$presName = mysql_real_escape_string($_POST['presentation']);
	$pres = mysql_query("SELECT * FROM presentations WHERE presentation_name='$presName' AND email='$email';");
	$presentation = mysql_fetch_array($pres);
	$presID = $presentation['presentation_id'];
	$name = $presentation['presentation_name'];
	$slides = mysql_query("SELECT * FROM slides WHERE presentation_id ='$presID';");
	
	$result = mysql_query("SELECT MAX(session_id) AS session_id FROM session WHERE presentation_id = '".$presID."';");
	$res = mysql_fetch_array($result);
	$session = mysql_real_escape_string($res['session_id']);		
	}
	?>		
	<!DOCTYPE html>
	<html = lang="en">
	<head>
	<meta charset="utf-8">
	<title>Results</title>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type-="text/css" href="answers.css">
	</head>

	<body>
	<H1> 
	<?php 
	echo " ".$presName."- ".$session." ";
	?>
	</H1>
	<?php
		while ($row = mysql_fetch_array($slides,MYSQL_ASSOC))
		{
			$sTitle = $row['title'];
			$quest = $row['quest_text'];
			$correct = $row['correct']; 
			?>
			<H3> 
			<?php echo $sTitle;?>
			</H3>
			<p> <?php echo $quest ?></p>
			<?php
			$ans = mysql_query("SELECT * FROM answers WHERE answer !='' AND slide_id = '".$row['slide_id'] ."';");
			while ($row2 = mysql_fetch_array($ans,MYSQL_ASSOC))
			{
				$letter = $row2['answer_letter'];
				switch($letter){
					case "A":
					$textA = $row2['answer'];
					$countA = $row2['count'];
					?>
					<p class = "answer"> A. <?php echo $textA;?></p>
					<p class = "count">count: <?php echo $countA;?></P>
					<p/>
					<?php
					break;
					case "B":
					$textB = $row2['answer'];
					$countB = $row2['count'];
					?>
					<p class = "answer"> B. <?php echo $textB;?></p>
					<p class = "count"> count: <?php echo $countB;?></P>
					<p/>
					<?php
					break;
					case "C":
					$textC = $row2['answer'];
					$countC = $row2['count'];
					?>
					<p class = "answer"> C. <?php echo $textC;?></p>
					<p class = "count"> count: <?php echo $countC;?></P>
					<p/>
					<?php
					break;
					case "D":
					$textD = $row2['answer'];
					$countD = $row2['count'];
					?>
					<p class = "answer"> D. <?php echo $textD;?></p>
					<p class = "count"> count: <?php echo $countD;?></P>
					<p/>
					<?php
					break;
					case "E":
					$textE = $row2['answer'];
					$countE = $row2['count'];
					?>
					<p class = "answer"> E. <?php echo $textE;?></p>
					<p class = "count"> count: <?php echo $countE;?></P>
					<p/>
					<?php
					break;
					case "F":
					$textF = $row2['answer'];
					$countF = $row2['count'];
					?>
					<p class = "answer"> F. <?php echo $textF;?></p>
					<p class = "count">count: <?php echo $countF;?></P>
					<p/>
					<?php
				}
			}
			$totCount = ($countA + $countB + $countC + $countD + $countE + $countF);
			switch($correct){
				case "A":
				?>
				<p><strong> Correct Answer: A </strong></p>
				<p> Number of correct answers: <?php echo $countA;?></p>
				<p> Ratio correct: <?php echo $countA."/".$totCount;?></p>
				<p/>
				<hr>
				<?php
				break;
				case "B":
				?>
				<p><strong> Correct Answer: B </strong></p>
				<p> Number of correct answers: <?php echo $countB;?></p>
				<p> Ratio correct: <?php echo $countB."/".$totCount;?></p>
				<p/>
				<hr>
				<?php
				break;
				case "C":
				?>
				<p><strong> Correct Answer: C </strong></p>
				<p> Number of correct answers: <?php echo $countC;?></p>
				<p> Ratio correct: <?php echo $countC."/".$totCount;?></p>
				<p/>
				<hr>
				<?php
				break;
				case "D":
				?>
				<p><strong> Correct Answer: D </strong></p>
				<p> Number of correct answers: <?php echo $countD;?></p>
				<p> Ratio correct: <?php echo $countA."/".$totCount;?></p>
				<p/>
				<hr>
				<?php
				break;
				case "E":
				?>
				<p><strong> Correct Answer: E </strong></p>
				<p> Number of correct answers: <?php echo $countE;?></p>
				<p> Ratio correct: <?php echo $countA."/".$totCount;?></p>
				<p/>
				<hr>
				<?php
				break;
				case "F":
				$ratio = $countB/$totCount;
				?>
				<p><strong> Correct Answer: F </strong></p>
				<p> Number of correct answers: <?php echo $countF;?></p>
				<p> Ratio correct: <?php echo $ratio;?></p>
				<p/>
				<hr>
				<?php
				break;
				$textA = "";
				$textB = "";
				$textC = "";
				$textD = "";
				$textE = "";
				$textF = "";
				$countA = 0;
				$countB = 0;
				$countC = 0;
				$countD = 0;
				$countE = 0; 
				$countF = 0;
			}
		}
	
	
	?>
	
	
	
	
	
	
	
	
	
	</body>
	</html>
