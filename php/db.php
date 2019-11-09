<?php

$server = "localhost";
$username = "root";
$password = "surfboard";

try {
    $conn = new PDO("mysql:host=$server;dbname=icon", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
}
catch(PDOException $exception) {
    $msg = $exception->getMessage();
    echo "<script>alert('Connection failed: $msg')</script>";
}

?>