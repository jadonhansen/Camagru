<?php

if (isset($_POST['submit'])) {
    $to = $_POST['email'];
    $subject = "ICON - Password Reset";
    $link = "";
    $message = "Use the following link to reset your password: ' $link '";
    $res = mail($to, $subject, $message);
    if ($res == TRUE) {
        echo "<script>alert('Email sent!')</script>";
        echo "<script>window.open('forgettery.html','_self')</script>";
    }
    else {
        echo "<script>alert('Failed to send email!')</script>";
        echo "<script>window.open('forgettery.html','_self')</script>";
    }
}
else {
    echo "<script>alert('Welcome $username! Please login with your new details.')</script>";
    echo "<script>window.open('login.html?','_self')</script>";
}

?>