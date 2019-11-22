<?php

//Setup database connection variables
$servername = "localhost";
$username = "aaumiller66";
$password = "southhills#";
$dbname = "aaumiller66";

//Create the connection
$conn = new mysqli($servername,$username,$password,$dbname);

if($conn->connect_error) {

    die("Ok, my teacher did not know what he was doing");
}

?>
