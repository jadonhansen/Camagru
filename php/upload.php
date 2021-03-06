<?php

function uploading() {
    if (!empty($_POST['image_data'])) {
        require 'db.php';
        $username = $_SESSION['username'];
        date_default_timezone_set('Africa/Johannesburg');
        $dt = date("Y-m-d H:i:s", time());
        $image = $_POST['image_data'];
        $prefix = 'data:image/png;base64,';
        if (substr($image, 0, strlen($prefix)) == $prefix) {
            $image = substr($image, strlen($prefix));
        }
        if ($image == "") {
            echo "<script>alret('Please upload an image or take a photo first!')</script>";
            echo "<script>window.open('../pages/upload.php','_self')</script>";
        }
        else {
            try {
                $sql = "INSERT INTO feed (img, username, upload_date, likes) values ('$image', '$username', '$dt', '0')";
                $stmt = $conn->query($sql);
                if ($stmt) {
                    echo "<script>alert('Posted!')</script>";
                    echo "<script>window.open('../pages/feed.php','_self')</script>";
                }
                else {
                    echo "<script>alert('Sorry, we could not post your image!')</script>";
                    echo "<script>window.open('../pages/upload.php','_self')</script>";
                }
            } catch (PDOException $exception) {
                echo "<script>alert('SQL ERROR: Could not upload post!')</script>";
                echo "<script>window.open('../pages/upload.php','_self')</script>";
            }            
        }
    }
    else {
        echo "<script>alert('Please upload an image or take a photo first!')</script>";
        echo "<script>window.open('../pages/upload.php','_self')</script>";
    }
}

session_start();
if (!isset($_SESSION['username'])) {
    echo "<script>alert('Please login first!')</script>";
    echo "<script>window.open('../pages/login.php','_self')</script>";
    exit();
}
else {
    if (isset($_POST['submit']) && isset($_POST['image_data'])) {
        uploading();
    }
    else {
        echo "<script>window.open('../pages/upload.php','_self')</script>";
    }
}

?>