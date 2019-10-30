<?php

function email_send($email, $key) {
	$subject = "ICON - Activate Account";
	$message = "<a href='http://localhost:8080/Camagru/php/verify_account.php?key=$key'>Use this link to activate your account</a>";
	$headers = "From: icon@gmail.com \r\n";
	$headers .= "MINE-Version: 1.0"."\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8"."\r\n";
	$res = mail($email, $subject, $message, $headers);
	if ($res) {
		echo "<script>alert('Please activate your account with the verification link we have sent to your email address.')</script>";
		echo "<script>window.open('../pages/create.php','_self')</script>";
	}
	else {
		echo "<script>alert('Failed to send email!')</script>";
		echo "<script>window.open('../pages/create.php','_self')</script>";
	}
}

// function complex_check($pass) {
// 	if (strlen($pass) < 8) {
// 		echo "<script>alert('Please make sure your password is 8 characters or longer.')</script>";
// 		echo "<script>window.open('../pages/create.php?error=emptyfields','_self')</script>";
// 		return (false);
// 	}
// 	//must consist of 0-9 && A-Z && a-z && special chars
// }

// function char_check($nam, $srnam, $usrnam) {

// }

if (isset($_POST['submit'])) {
	require 'db.php';
	$name = $_POST['name'];
	$surname = $_POST['surname'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	$verified = 0;

	// if (!complex_check($password) && !char_check($name, $surname, $username)){
	// 	exit();
	// }
	if (empty($email) || empty($password) || empty($username) || empty($name) || empty($surname)) {
		echo "<script>alert('Please fill in all fields!')</script>";
		echo "<script>window.open('../pages/create.php?error=emptyfields','_self')</script>";
		exit();
	}
	else {
		$stmt = $conn->prepare("SELECT username FROM users WHERE username= :search");
		$stmt->bindParam(':search', $username);
		if (!$stmt->execute()) {
			echo "<script>alert('SQL ERROR: 1')</script>";
			echo "<script>window.open('../pages/create.php?error=usernametaken','_self')</script>";
			exit();
		}
		$result = $stmt->fetch();
		if ($result) {
			echo "<script>alert('Username taken! Please use a different one.')</script>";
			echo "<script>window.open('../pages/create.php?error=usernametaken','_self')</script>";
			exit();
		}
		else {
			try {
				$stmt = $conn->prepare("INSERT INTO users (name_user, surname, username, passwd, email, verified, verif_key) VALUES (:name_user, :surname, :username, :passwd, :email, :verified, :verif_key)");
				$key = hash("whirlpool", $username);
				$hashed = hash("whirlpool", $password);
				$stmt->bindParam(':name_user', $name);
				$stmt->bindParam(':surname', $surname);
				$stmt->bindParam(':username', $username);
				$stmt->bindParam(':passwd', $hashed);
				$stmt->bindParam(':email', $email);
				$stmt->bindParam(':verified', $verified);
				$stmt->bindParam(':verif_key', $key);
				if (!$stmt->execute()) {
					echo "<script>alert('SQL ERROR: 2')</script>";
					echo "<script>window.open('../pages/create.php?error=usernametaken','_self')</script>";
					exit();
				}
			} catch (PDOException $exception) {
				echo $sql . "<br>" . $exception->getMessage(); //dont need for final?
                echo "<script>alert('SQL ERROR: 3')</script>";
                echo "<script>window.open('../pages/create.php','_self')</script>";
				exit();
			}
			email_send($email, $key);
		}
		$conn = NULL;
	}
}
else {
	echo "<script>window.open('../pages/create.php','_self')</script>";
	exit();	
}
?>