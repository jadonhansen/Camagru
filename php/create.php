<?php
require 'db.php';

if (isset($_POST['submit'])) {

	$username = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email'];

	if (empty($email) || empty($password) || empty($username)) {
		echo "<script>window.open('../pages/create.html?error=emptyfields','_self')</script>";
		exit();
	}
	else {
		$sql = "SELECT username FROM users WHERE username=?";
		$stmt = mysqli_stmt_init($conn);

		if (!mysqli_stmt_prepare($stmt, $sql)) {
			echo "<script>window.open('../pages/create.html?error=sqlerror','_self')</script>";
			exit();
		}
		else {
			mysqli_stmt_bind_param($stmt, "s", $username);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			$result = mysqli_stmt_num_rows($stmt);
			if ($result > 0) {
				echo "<script>alert('Username taken! Please use a different one.')</script>";
				echo "<script>window.open('../pages/create.html?error=usernametaken','_self')</script>";
				exit();
			}
			else {
				$sql = "INSERT INTO users (username, passwd, email) VALUES (?, ?, ?)";
				$stmt = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt, $sql)) {
					echo "<script>window.open('../pages/create.html?error=sqlerror','_self')</script>";
					exit();
				}
				else {
					$hashed = hash("whirlpool", $password);
					mysqli_stmt_bind_param($stmt, "sss", $username, $hashed, $email);
					mysqli_stmt_execute($stmt);
					echo "<script>alert('Welcome $username')</script>";
					echo "<script>window.open('../login.html?signup=success','_self')</script>";
					exit();
				}
			}
		}
	}
	mysqli_stmt_close($stmt);
	mysqli_close($conn);	
}
else {
	echo "<script>window.open('../pages/create.html','_self')</script>";
	exit();	
}

?>