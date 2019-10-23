<?php

if (isset($_POST['submit'])) {
    $username = $_POST['login'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repeat = $_POST['repeat'];

	if (empty($password) || empty($username) || empty($email)) {
		echo "<script>window.open('../pages/forgettery.html?error=emptyfields','_self')</script>";
		exit();
	}
	else {
        $sql = "UPDATE users SET passwd=? WHERE email=? AND username=?";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			echo "<script>window.open('../pages/forgettery.html?error=sqlerror','_self')</script>";
			exit();
		}
		else {
            $hashed = $password;
			mysqli_stmt_bind_param($stmt, "sss", $hashed, $email, $username);
			mysqli_stmt_execute($stmt);
			echo "<script>alert('Welcome $username! Please login with your new details.')</script>";
			echo "<script>window.open('login.html?','_self')</script>";
				exit();
		}
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
	}
}
else {
    echo "<script>window.open('../pages/forgettery.html','_self')</script>";
    exit();
}

?>