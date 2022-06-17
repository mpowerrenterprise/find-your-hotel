<?php

session_start();
$_SESSION['session_name'] = "access_granted";

$hotelName = "";
$address = "";
$district = "";
$email = "";
$phone = "";
$website = "";
$lat = "";
$lng = "";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotels";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 



	$sql = "DELETE FROM hotel_details WHERE id =".$_GET['status']."";
	$result = $conn->query($sql);

	$Communication_protocol = $_SERVER['SERVER_PROTOCOL'];

    $Communication_protocol = explode ("/", $Communication_protocol); 
    $Communication_protocol = strtolower($Communication_protocol[0]);

    $Domain_name = $_SERVER['HTTP_HOST'];

	header("Location:".$Communication_protocol."://".$Domain_name."/Hotel_Info_With_Google_Map/Dashboard/examples/modifyHotel.php?");


$conn->close();

?>