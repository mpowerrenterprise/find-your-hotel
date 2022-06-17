<?php

  session_start();

  if(isset($_SESSION['session_name'])==false && $_SESSION['session_name'] !="access_granted"){

    redirection();

  }


function redirection(){

    $Communication_protocol = $_SERVER['SERVER_PROTOCOL'];

    $Communication_protocol = explode ("/", $Communication_protocol); 
    $Communication_protocol = strtolower($Communication_protocol[0]);

    $Domain_name = $_SERVER['HTTP_HOST'];

    header("Location:".$Communication_protocol."://".$Domain_name."/Hotel_Info_With_Google_Map/admin_login.php"); 
}
?>
