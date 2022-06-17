<?php
	
	session_start();
	session_destroy();

	$Communication_protocol = $_SERVER['SERVER_PROTOCOL'];

	$Communication_protocol = explode ("/", $Communication_protocol); 
	$Communication_protocol = strtolower($Communication_protocol[0]);

	$Domain_name = $_SERVER['HTTP_HOST'];

	 	
	header("Location:".$Communication_protocol."://www.".$Domain_name."/Hotel_Info_With_Google_Map/admin_login.php"); 



?>