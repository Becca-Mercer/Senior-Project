<?php
session_start();
include_once 'dbconnect.php';
if(isset($_POST['join']))
{
	$id = mysql_real_escape_string($_POST['sessionID']);
	$sResult = mysql_query("SELECT * FROM session WHERE session_id ='".$id."';");
	$sres = mysql_fetch_array($sResult);
	$presId = $sres['presentation_id'];
	$pResult = mysql_query("SELECT * FROM presentations WHERE presentation_id ='".$presId."';");
	$pres= mysql_fetch_array($pResult);
	$path = "/".$pres['path'];
	header("Location: ".$path."/".$id.".html");
}
	?>
