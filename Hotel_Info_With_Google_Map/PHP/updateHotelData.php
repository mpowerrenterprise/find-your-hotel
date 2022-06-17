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




if ($_SERVER["REQUEST_METHOD"] == "POST") {


	$idofupdate = validate_input($_POST["idofupdate"]);
  
  	$hotelName = validate_input($_POST["hotel_name"]);
  	$address = validate_input($_POST["address"]);
  	$district = validate_input($_POST["district"]);
  	$email = validate_input($_POST["email"]);
  	$phone = validate_input($_POST["phone"]);
  	$website = validate_input($_POST["website"]);
  	$lat = validate_input($_POST["latitude"]);
  	$lng = validate_input($_POST["longitude"]);



	$sql = "UPDATE hotel_details SET hotel_name = '$hotelName', address='$address', district = '$district', email = '$email', phone = '$phone', website = '$website', lat = '$lat', lng = '$lng' WHERE id = $idofupdate";
	$result = $conn->query($sql);

	

	    $Communication_protocol = $_SERVER['SERVER_PROTOCOL'];

		$Communication_protocol = explode ("/", $Communication_protocol); 
		$Communication_protocol = strtolower($Communication_protocol[0]);

		$Domain_name = $_SERVER['HTTP_HOST'];
	 	

		header("Location:".$Communication_protocol."://".$Domain_name."/Hotel_Info_With_Google_Map/Dashboard/examples/modifyHotel.php?");



}

function validate_input($data) {

  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;

}

$conn->close();

?>