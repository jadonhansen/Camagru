<?php

if (isset($_POST['submit'])) {
    if (empty($_POST['email'])) {
        echo "<script>alert('Please fill in your email before submitting!')</script>";
        echo "<script>window.open('../pages/pass_reset.php','_self')</script>";        
    }
    require 'db.php';
    $to = $_POST['email'];
    $stmt = $conn->prepare("SELECT email FROM users WHERE email= :mail");
    $stmt->bindParam(':mail', $to);
	if (!$stmt->execute()) {
		echo "<script>alert('SQL ERROR: 1')</script>";
		echo "<script>window.open('../pages/pass_reset.php?error=sql','_self')</script>";
		exit();
	}
	$result = $stmt->fetch();
	if (!$result) {
		echo "<script>alert('Email not found! Please make sure you enter your email in correctly.')</script>";
		echo "<script>window.open('../pages/pass_reset.php?email=notfound','_self')</script>";
		exit();
    }
    else {
        $subject = "ICON - Password Reset";
        $headers = "From: icon@gmail.com \r\n";
        $headers .= "MINE-Version: 1.0"."\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8"."\r\n";
        $message = "<a href='http://localhost:8888/Camagru/pages/forgettery.php'>Use this link to reset your password</a>";
        $res = mail($to, $subject, $message, $headers);
        if ($res == TRUE) {
            echo "<script>alert('Email sent! We have sent you a password reset link.')</script>";
            echo "<script>window.open('../pages/login.php','_self')</script>";
        }
        else {
            echo "<script>alert('Failed to send email!')</script>";
            echo "<script>window.open('../pages/pass_reset.php','_self')</script>";
        }
    }
    $conn = NULL;
}
else
    echo "<script>window.open('../pages/pass_reset.php?','_self')</script>";

?>