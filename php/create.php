<?php

if (isset($_POST['submit'])) {
	require 'db.php';
	$name = $_POST['name'];
	$surname = $_POST['surname'];
	$username = $_POST['username'];
	$password = $_POST['password']; //check password for complexity 
	$email = $_POST['email'];
	$verified = 0;

	if (empty($email) || empty($password) || empty($username) || empty($name) || empty($surname)) {
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
				$sql = "INSERT INTO users (name_user, surname, username, passwd, email, verified, verif_key) VALUES (?, ?, ?, ?, ?, ?, ?)";
				$stmt = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt, $sql)) {
					echo "<script>window.open('../pages/create.html?error=sqlerror','_self')</script>";
					exit();
				}
				else {
					$key = hash("whirlpool", $username);
					$hashed = hash("whirlpool", $password);
					mysqli_stmt_bind_param($stmt, "sssssis", $name, $surname, $username, $hashed, $email, $verified, $key);
					mysqli_stmt_execute($stmt);

					$subject = "ICON - Activate Account";
					$headers = "From: icon@gmail.com \r\n";
					$headers .= "MINE-Version: 1.0"."\r\n";
					$headers .= "Content-type:text/html;charset=UTF-8"."\r\n";
					$message = "<a href='http://localhost:8080/Camagru/php/verify_account.php?key=$key'>Use this link to activate your account</a>";
					$res = mail($email, $subject, $message, $headers);
					if ($res == TRUE) {
						echo "<script>alert('Please activate your account with the verification link we have sent to your email address.')</script>";
						echo "<script>window.open('../pages/create.html','_self')</script>";
					}
					else {
						echo "<script>alert('Failed to send email!')</script>";
						echo "<script>window.open('../pages/create.html','_self')</script>";
					}

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