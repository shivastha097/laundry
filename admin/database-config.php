<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "merowash";


$mysqli = new mysqli($servername, $username, $password, $database);
 
// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}



?>