<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotels";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT username, password FROM user_account";
$result = $conn->query($sql);

$username = "";
$pass = "";

if ($result->num_rows > 0) {
   
    while($row = $result->fetch_assoc()) {
        
        $username = $row["username"];
        $pass = $row["password"];
	
	}

}


$conn->close();


session_start();

if(isset($_POST['sub'])){

	$typed_username = $_POST['username'];
	$typed_password = $_POST['pass'];

	if($typed_username == $username && $typed_password == $pass){

	$_SESSION['session_name'] = "access_granted";

	$Communication_protocol = $_SERVER['SERVER_PROTOCOL'];

	$Communication_protocol = explode ("/", $Communication_protocol); 
	$Communication_protocol = strtolower($Communication_protocol[0]);

	$Domain_name = $_SERVER['HTTP_HOST'];

	if($_SESSION['session_name']=="access_granted"){

	 	
	     header("Location:".$Communication_protocol."://".$Domain_name."/Hotel_Info_With_Google_Map/Dashboard/examples/Dashboard.php"); 	

	}else{

		redirection_to_login_page();
	}

	}else{

		redirection_to_login_page();

	}
	
}else{

	redirection_to_login_page();

}
	
function redirection_to_login_page(){

	$Communication_protocol = $_SERVER['SERVER_PROTOCOL'];

	$Communication_protocol = explode ("/", $Communication_protocol); 
	$Communication_protocol = strtolower($Communication_protocol[0]);

	$Domain_name = $_SERVER['HTTP_HOST'];

	 	
	header("Location:".$Communication_protocol."://www.".$Domain_name."/Hotel_Info_With_Google_Map/admin_login.php"); 

}

?>