<?php
	session_start();
	session_destroy();
	include ("includes/menu.php");
	header ("Location: index.php");
?>

