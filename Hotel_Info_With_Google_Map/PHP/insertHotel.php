<?php

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

session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  	
  	$hotelName = validate_input($_POST["hotel_name"]);
  	$address = validate_input($_POST["address"]);
  	$district = validate_input($_POST["district"]);
  	$email = validate_input($_POST["email"]);
  	$phone = validate_input($_POST["phone"]);
  	$website = validate_input($_POST["website"]);
  	$lat = validate_input($_POST["latitude"]);
  	$lng = validate_input($_POST["longitude"]);
  	$description = validate_input($_POST["description"]);



	$sql = "INSERT INTO hotel_details VALUES('','$hotelName','$address','$district','$email','$phone','$website','$lat','$lng','false','$description')";

	$result = $conn->query($sql);

	if ($result === TRUE && isset($_SESSION['session_name'])==true && $_SESSION['session_name'] =="access_granted") {

	    $Communication_protocol = $_SERVER['SERVER_PROTOCOL'];

		$Communication_protocol = explode ("/", $Communication_protocol); 
		$Communication_protocol = strtolower($Communication_protocol[0]);

		$Domain_name = $_SERVER['HTTP_HOST'];
	 	

		header("Location:".$Communication_protocol."://".$Domain_name."/Hotel_Info_With_Google_Map/Dashboard/examples/RegisterHotel.php?status=success");


	} else {

	    $Communication_protocol = $_SERVER['SERVER_PROTOCOL'];

	    $Communication_protocol = explode ("/", $Communication_protocol); 
	    $Communication_protocol = strtolower($Communication_protocol[0]);

	    $Domain_name = $_SERVER['HTTP_HOST'];

	    #header("Location:".$Communication_protocol."://".$Domain_name."/Hotel_Info_With_Google_Map/admin_login.php"); 

	}



}

function validate_input($data) {

  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;

}

$conn->close();

?>