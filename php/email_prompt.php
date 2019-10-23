<?php

if (isset($_POST['submit'])) {
    $to = $_POST['email'];
    $subject = "ICON - Password Reset";
    $link = "localhost:8080/Mamp/apache2/htdocs/Camagru/pages/forgettery.html";
    $message = "Use the following link to reset your password: ' $link '";
    $res = mail($to, $subject, $message);
    if ($res == TRUE) {
        echo "<script>alert('Email sent! We have sent you a password reset link.')</script>";
        echo "<script>window.open('login.html','_self')</script>";
    }
    else {
        echo "<script>alert('Failed to send email!')</script>";
        echo "<script>window.open('login.html','_self')</script>";
    }
}
else
    echo "<script>window.open('login.html?','_self')</script>";

?>