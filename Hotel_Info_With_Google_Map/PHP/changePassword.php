<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotels";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$sql = "SELECT password FROM user_account";
$result = $conn->query($sql);

$currentPassword = '';


if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {

       $currentPassword = $row['password'];
    }

}

$userTypedCurrentPassword = $_POST['curPass'];
$userTypedNewPassword = $_POST['newPass'];
$userTypedRetyped = $_POST['comPass'];

if($userTypedCurrentPassword == $currentPassword){

	if($userTypedNewPassword == $userTypedRetyped){

		  $sql2 = "UPDATE user_account SET password = '$userTypedNewPassword'";
	 	  $conn->query($sql2);

	 	  $Communication_protocol = $_SERVER['SERVER_PROTOCOL'];

			$Communication_protocol = explode ("/", $Communication_protocol); 
			$Communication_protocol = strtolower($Communication_protocol[0]);

			$Domain_name = $_SERVER['HTTP_HOST'];

			header("Location:".$Communication_protocol."://".$Domain_name."/Hotel_Info_With_Google_Map/Dashboard/examples/settings.php?status=success");


	}else{

		$Communication_protocol = $_SERVER['SERVER_PROTOCOL'];

		$Communication_protocol = explode ("/", $Communication_protocol); 
		$Communication_protocol = strtolower($Communication_protocol[0]);

		$Domain_name = $_SERVER['HTTP_HOST'];

		header("Location:".$Communication_protocol."://".$Domain_name."/Hotel_Info_With_Google_Map/Dashboard/examples/settings.php?status=retypedPass");

	}

	

}else{

	$Communication_protocol = $_SERVER['SERVER_PROTOCOL'];

	$Communication_protocol = explode ("/", $Communication_protocol); 
	$Communication_protocol = strtolower($Communication_protocol[0]);

	$Domain_name = $_SERVER['HTTP_HOST'];

	header("Location:".$Communication_protocol."://".$Domain_name."/Hotel_Info_With_Google_Map/Dashboard/examples/settings.php?status=curPass");

}

?>