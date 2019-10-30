<?php

$server = "localhost";
$username = "root";
$password = "surfboard";

try {
    $conn = new PDO("mysql:host=$server;dbname=icon", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
	} 
catch(PDOException $exception) {
    echo "Connection failed: " . $exception->getMessage();
}

?>