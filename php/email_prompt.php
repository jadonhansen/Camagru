<?php

//check that this email exists in the DB

if (isset($_POST['submit'])) {
    $to = $_POST['email'];
    $subject = "ICON - Password Reset";
    $headers = "From: icon@gmail.com \r\n";
    $headers .= "MINE-Version: 1.0"."\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8"."\r\n";
    $message = "<a href='http://localhost:8080/Camagru/pages/forgettery.php'>Use this link to reset your password</a>";
    $res = mail($to, $subject, $message, $headers);
    if ($res == TRUE) {
        echo "<script>alert('Email sent! We have sent you a password reset link.')</script>";
        echo "<script>window.open('../pages/login.php','_self')</script>";
    }
    else {
        echo "<script>alert('Failed to send email!')</script>";
        echo "<script>window.open('../pages/login.php','_self')</script>";
    }
}
else
    echo "<script>window.open('../pages/login.php?','_self')</script>";

?>