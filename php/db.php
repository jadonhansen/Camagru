<?php

$server = "localhost";
$username = "root";
$password = "qwerty";

try {
    $conn = new PDO("mysql:host=$server;dbname=icon", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "<script>alert('Connected successfully')</script>";
} 
catch(PDOException $exception) {
    echo "Connection failed: " . $exception->getMessage(); //get this to echo an alert
}

?>