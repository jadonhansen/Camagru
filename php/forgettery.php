<?php

if (isset($_POST['submit'])) {
	require 'db.php';
    $username = $_POST['login'];
    $email = $_POST['email'];
    $new_password = $_POST['new_password'];
    $repeat = $_POST['repeat'];

	if ($new_password !== $repeat) {
		echo "<script>alert('Your passwords do not match! Please try again.')</script>";
		echo "<script>window.open('../pages/forgettery.php?error=passwordsdifference','_self')</script>";
		exit();		
	}
	if (empty($new_password) || empty($username) || empty($email)) {
		echo "<script>window.open('../pages/forgettery.php?error=emptyfields','_self')</script>";
		exit();
	}
	else {
        $sql = "UPDATE users SET passwd=? WHERE email=? AND username=?";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			echo "<script>window.open('../pages/forgettery.php?error=sqlerror','_self')</script>";
			exit();
		}
		else {
            $hashed = $new_password;
			mysqli_stmt_bind_param($stmt, "sss", $hashed, $email, $username);
			mysqli_stmt_execute($stmt);
			echo "<script>alert('Welcome $username! Please login with your new details.')</script>";
			echo "<script>window.open('../pages/login.php','_self')</script>";
				exit();
		}
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
	}
}
else {
    echo "<script>window.open('../pages/forgettery.php','_self')</script>";
    exit();
}

?>