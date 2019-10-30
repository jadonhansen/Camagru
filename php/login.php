<?php

if (isset($_POST['submit'])) {
	require 'db.php';

	session_start();
	if (isset($_SESSION['username'])) {
		echo "<script>alert('Please go logout first!!')</script>";
		echo "<script>window.open('../pages/login.php','_self')</script>";
	}

	$password = hash("whirlpool", $_POST['password']);
	$username = $_POST['username'];

	if (empty($password) || empty($username)) {
		echo "<script>alert('Please fill in all fields!')</script>";
		echo "<script>window.open('../pages/login.php?error=emptyfields','_self')</script>";
		exit();
	}
	else {
		$stmt = $conn->prepare("SELECT * FROM users WHERE passwd= :pass AND username= :usr");
		$stmt->bindParam(':pass', $password);
		$stmt->bindParam(':usr', $username);
		if (!$stmt->execute()) {
			echo "<script>alert('SQL ERROR: 1')</script>";
			echo "<script>window.open('../pages/login.php?error=sqlerror','_self')</script>";
			exit();
		}
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($result && ($result['verified'])) {
			session_start();
			$_SESSION['username'] = $username;
			echo "<script>alert('Welcome $username!')</script>";
			echo "<script>window.open('../pages/feed.php?home=$username','_self')</script>";
			exit();
		}
		else {
			echo "<script>alert('Details entered have not been found! Consider creating an account.')</script>";
			echo "<script>window.open('../pages/login.php?login=failure','_self')</script>";
		}
	}
	$conn = NULL;
}
else {
	echo "<script>window.open('../pages/login.php','_self')</script>";
	exit();
}

?>