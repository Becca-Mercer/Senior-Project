<?php
if(!mysql_connect("localhost","root","Clicker3"))
	{
		die('oops connections problem ! -->' .mysql_error());
	}
	if(!mysql_select_db("clickerdb"))
	{
		die('oops database selection problem! --> '.mysql_error());
	}
?>
	