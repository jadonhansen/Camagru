<?php

if (isset($_POST['submit'])) {
	require 'db.php';
	$username = $_POST['login'];
	$new_password = $_POST['new_password'];
	$repeat = $_POST['repeat'];
	if (empty($new_password) || empty($username) || empty($repeat)) {
		echo "<script>alert('Please fill in all fields!')</script>";
		echo "<script>window.open('../pages/forgettery.php?error=emptyfields','_self')</script>";
		exit();
	}
	if ($new_password !== $repeat) {
		echo "<script>alert('Your passwords do not match! Please try again.')</script>";
		echo "<script>window.open('../pages/forgettery.php?error=passwordsdifference','_self')</script>";
		exit();		
	}
	$stmt = $conn->prepare("SELECT username FROM users WHERE username= :search"); 
	$stmt->bindParam(':search', $username);
	if (!$stmt->execute()) {
		echo "<script>alert('SQL ERROR: 1')</script>";
		echo "<script>window.open('../pages/forgettery.php?error=sql','_self')</script>";
		exit();
	}
	$result = $stmt->fetch();
	if (!$result) {
		echo "<script>alert('Username not found! Please make sure you enter your username in correctly.')</script>";
		echo "<script>window.open('../pages/forgettery.php?username=notfound','_self')</script>";
		exit();
	}
	else {
		$new = hash("whirlpool", $new_password);
		$stmt = $conn->prepare("UPDATE users SET passwd = :pass WHERE username = :usrn");
		$stmt->bindParam(':pass', $new);
		$stmt->bindParam(':usrn', $username);
		if (!$stmt->execute()) {
			echo "<script>alert('SQL ERROR: 2')</script>";
			echo "<script>window.open('../pages/forgettery.php?error=sqlerror','_self')</script>";
			exit();
		}
		echo "<script>alert('Saved! Please login with your new details, $username.')</script>";
		echo "<script>window.open('../pages/login.php','_self')</script>";		
	}
	$conn = NULL;
}
else {
    echo "<script>window.open('../pages/forgettery.php','_self')</script>";
    exit();
}

?>