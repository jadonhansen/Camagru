<?php

$server = "localhost";
$dbUsername = "root";
$dbPassword = "surfboard";
$dbName = "icon";

$conn = mysqli_connect($server, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
	die("Connection failed: " . mysql_connect_error());
}