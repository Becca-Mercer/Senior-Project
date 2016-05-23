<?php
	session_start();
	include_once 'dbconnect.php';
	if(isset($_POST['A']))
	{
		$s_id= $_POST['session_id'];
		$s_order=$_POST['slide_order'];
		$presult = mysql_query("SELECT * FROM presentations WHERE presentation_id ='".p_id."';");
		$sResult = mysql_query("SELECT * FROM session WHERE session_id ='".$s_id."';");
		$sres = mysql_fetch_array($sResult);
		$p_id = $sres['presentation_id'];
		$presult = mysql_query("SELECT * FROM presentations WHERE presentation_id ='".$p_id."';");
		$pres = mysql_fetch_array($presult);
		$slresult = mysql_query("SELECT * FROM slides WHERE presentation_id='".$p_id."' AND slide_order= '".$s_order."';");
		$slres = mysql_fetch_array($slresult);
		$slide = $slres['slide_id'];
		$aResult = mysql_query("SELECT * FROM answers WHERE answer_letter = 'A' AND slide_id ='".$slide."';");
		$ares = mysql_fetch_array($aResult);
		$ans = $ares['answer_id'];
		$count = $ares['count']+1;
		mysql_query("UPDATE answers SET count = '".$count."' WHERE answer_id ='".$ans."';");
		header("Location: ".$pres['path']."/slide".$slres['slide_order'].".html");
	}
	elseif(isset($_POST['B']))
	{
		$s_id= $_POST['session_id'];
		$s_order=$_POST['slide_order'];
		$sResult = mysql_query("SELECT * FROM session WHERE session_id ='".$s_id."';");
		$sres = mysql_fetch_array($sResult);
		$p_id = $sres['presentation_id'];
		$presult = mysql_query("SELECT * FROM presentations WHERE presentation_id ='".$p_id."';");
		$pres = mysql_fetch_array($presult);
		$slresult = mysql_query("SELECT * FROM slides WHERE presentation_id='".$p_id."' AND slide_order= '".$s_order."';");
		$slres = mysql_fetch_array($slresult);
		$slide = $slres['slide_id'];
		$aResult = mysql_query("SELECT * FROM answers WHERE answer_letter = 'B' AND slide_id ='".$slide."';");
		$ares = mysql_fetch_array($aResult);
		$ans = $ares['answer_id'];
		$count = $ares['count']+1;
		mysql_query("UPDATE answers SET count = '".$count."' WHERE answer_id ='".$ans."';");
		header("Location: ".$pres['path']."/slide".$slres['slide_order'].".html");
	}
	elseif(isset($_POST['C']))
	{
		$s_id= $_POST['session_id'];
		$s_order=$_POST['slide_order'];
		$sResult = mysql_query("SELECT * FROM session WHERE session_id ='".$s_id."';");
		$sres = mysql_fetch_array($sResult);
		$p_id = $sres['presentation_id'];
		$presult = mysql_query("SELECT * FROM presentations WHERE presentation_id ='".$p_id."';");
		$pres = mysql_fetch_array($presult);
		$slresult = mysql_query("SELECT * FROM slides WHERE presentation_id='".$p_id."' AND slide_order= '".$s_order."';");
		$slres = mysql_fetch_array($slresult);
		$slide = $slres['slide_id'];
		$aResult = mysql_query("SELECT * FROM answers WHERE answer_letter = 'C' AND slide_id ='".$slide."';");
		$ares = mysql_fetch_array($aResult);
		$ans = $ares['answer_id'];
		$count = $ares['count']+1;
		mysql_query("UPDATE answers SET count = '".$count."' WHERE answer_id ='".$ans."';");
		header("Location: ".$pres['path']."/slide".$slres['slide_order'].".html");
	}
	elseif(isset($_POST['D']))
	{
		$s_id= $_POST['session_id'];
		$s_order=$_POST['slide_order'];
		$sResult = mysql_query("SELECT * FROM session WHERE session_id ='".$s_id."';");
		$sres = mysql_fetch_array($sResult);
		$p_id = $sres['presentation_id'];
		$presult = mysql_query("SELECT * FROM presentations WHERE presentation_id ='".$p_id."';");
		$pres = mysql_fetch_array($presult);
		$slresult = mysql_query("SELECT * FROM slides WHERE presentation_id='".$p_id."' AND slide_order= '".$s_order."';");
		$slres = mysql_fetch_array($slresult);
		$slide = $slres['slide_id'];
		$aResult = mysql_query("SELECT * FROM answers WHERE answer_letter = 'D' AND slide_id ='".$slide."';");
		$ares = mysql_fetch_array($aResult);
		$ans = $ares['answer_id'];
		$count = $ares['count']+1;
		mysql_query("UPDATE answers SET count = '".$count."' WHERE answer_id ='".$ans."';");
		header("Location: ".$pres['path']."/slide".$slres['slide_order'].".html");
	}
	elseif(isset($_POST['E']))
	{
		$s_id= $_POST['session_id'];
		$s_order=$_POST['slide_order'];
		$sResult = mysql_query("SELECT * FROM session WHERE session_id ='".$s_id."';");
		$sres = mysql_fetch_array($sResult);
		$p_id = $sres['presentation_id'];
		$presult = mysql_query("SELECT * FROM presentations WHERE presentation_id ='".$p_id."';");
		$pres = mysql_fetch_array($presult);
		$slresult = mysql_query("SELECT * FROM slides WHERE presentation_id='".$p_id."' AND slide_order= '".$s_order."';");
		$slres = mysql_fetch_array($slresult);
		$slide = $slres['slide_id'];
		$aResult = mysql_query("SELECT * FROM answers WHERE answer_letter = 'E' AND slide_id ='".$slide."';");
		$ares = mysql_fetch_array($aResult);
		$ans = $ares['answer_id'];
		$count = $ares['count']+1;
		mysql_query("UPDATE answers SET count = '".$count."' WHERE answer_id ='".$ans."';");
		header("Location: ".$pres['path']."/slide".$slres['slide_order'].".html");
	}
	elseif(isset($_POST['F']))
	{
		$s_id= $_POST['session_id'];
		$s_order=$_POST['slide_order'];
		$sResult = mysql_query("SELECT * FROM session WHERE session_id ='".$s_id."';");
		$sres = mysql_fetch_array($sResult);
		$p_id = $sres['presentation_id'];
		$presult = mysql_query("SELECT * FROM presentations WHERE presentation_id ='".$p_id."';");
		$pres = mysql_fetch_array($presult);
		$slresult = mysql_query("SELECT * FROM slides WHERE presentation_id='".$p_id."' AND slide_order= '".$s_order."';");
		$slres = mysql_fetch_array($slresult);
		$slide = $slres['slide_id'];
		$aResult = mysql_query("SELECT * FROM answers WHERE answer_letter = 'F' AND slide_id ='".$slide."';");
		$ares = mysql_fetch_array($aResult);
		$ans = $ares['answer_id'];
		$count = $ares['count']+1;
		mysql_query("UPDATE answers SET count = '".$count."' WHERE answer_id ='".$ans."';");
		header("Location: ".$pres['path']."/slide".$slres['slide_order'].".html");
	}
?>