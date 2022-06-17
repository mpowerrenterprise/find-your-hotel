<?php

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "hotels";

	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) {

    	die("Connection failed: " . $conn->connect_error);
	
	}

	$district = $_POST['district'];

	$sql = "SELECT hotel_name FROM hotel_details where district = '$district' AND gallery = 'false'";
	$result = $conn->query($sql);

	$data = array(); 

	if ($result->num_rows > 0) {
   
	    while($row = $result->fetch_assoc()) {

	        array_push($data,$row['hotel_name']);
	        
	    }

	    $myJSON = json_encode($data);
	    echo $myJSON;
	} 
	
	

?>