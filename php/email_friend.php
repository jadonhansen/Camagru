<?php

if (isset($_POST['email_friend'])) {
    if (empty($_POST['message'])) {
        echo "<script>window.open('../pages/user_search.php','_self')</script>";        
    }
    session_start();
    $from =  $_SESSION['username'];
    require 'db.php';
    $stmt = $conn->prepare("SELECT email FROM users WHERE username='$from'");
	if (!$stmt->execute()) {
		echo "<script>alert('SQL ERROR: 1')</script>";
		echo "<script>window.open('../pages/user_search.php?error=sql','_self')</script>";
		exit();
	}
	$result = $stmt->fetch();
	if (!$result) {
		echo "<script>alert('Message not sent: Your email address could not be found!')</script>";
		echo "<script>window.open('../pages/user_search.php?email=notfound','_self')</script>";
		exit();
    }
    else {
        $to = $_POST['email'];
        $from_email = $result['email'];
        $message = $_POST['message'];
        $subject = "ICON - @$from started a conversation with you!";
        $headers = "From: $from_email \r\n";
        $headers .= "MINE-Version: 1.0"."\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8"."\r\n";
        $res = mail($to, $subject, $message, $headers);
        if ($res == TRUE) {
            echo "<script>alert('Email sent!')</script>";
            echo "<script>window.open('../pages/user_search.php','_self')</script>";
            exit();
        }
        else {
            echo "<script>alert('Failed to send email!')</script>";
            echo "<script>window.open('../pages/user_search.php','_self')</script>";
            exit();
        }
    }
}
else
    echo "<script>window.open('../pages/user_search.php?','_self')</script>";

?>