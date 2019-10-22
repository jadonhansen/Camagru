<?php
require 'db.php';

if (isset($_POST['submit'])) {

	$username = $_POST['password'];
	$password = $_POST['username'];

	if (empty($password) || empty($username)) {
		echo "<script>window.open('../pages/login.html?error=emptyfields','_self')</script>";
		exit();
	}
	else {
		$sql = "SELECT * FROM users WHERE passwd=? AND username=?";
		$stmt = mysqli_stmt_init($conn);

		if (!mysqli_stmt_prepare($stmt, $sql)) {
			echo "<script>window.open('../pages/login.html?error=sqlerror','_self')</script>";
			exit();
		}
		else {
			mysqli_stmt_bind_param($stmt, "ss", $password, $username);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			$result = mysqli_stmt_num_rows($stmt);
			if ($result == 1) {
				session_start();
				$_SESSION['username'] = $username;
				echo "<script>alert('Welcome $username! Please login with your new details.')</script>";
				echo "<script>window.open('feed.html?home=$username','_self')</script>";
				exit();
			}
			else {
				echo "<script>alert('Details entered have not been found! Consider creating an account.')</script>";
				echo "<script>window.open('../pages/login.html?login=failure','_self')</script>";
			}
		}
		mysqli_stmt_close($stmt);
		mysqli_close($conn);
	}
}
else {
	echo "<script>window.open('../pages/login.html','_self')</script>";
	exit();
}

?>