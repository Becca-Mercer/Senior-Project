<?php
session_start();

if(!isset($_SESSION['user']))
{
 header("Location: index.php");
}
else if(isset($_SESSION['user']))
{
 header("Location: homepage.php");
}

if(isset($_POST['logout']))
{
 session_destroy();
 unset($_SESSION['user']);
 header("Location: index.php");
}
?>
