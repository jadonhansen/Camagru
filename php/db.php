<?php

$server = "localhost";
$dbUsername = "root";
$dbPassword = "surfboard";
$dbName = "ICON";

$conn = mysqli_connect($server, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
	die("Connection failed: " . mysql_connect_error());
}