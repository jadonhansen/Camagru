<?php

function photoUpload() {
    if (!empty($_POST['image_data'])) {
        require 'db.php';
        date_default_timezone_set('Africa/Johannesburg');
        $username = $_SESSION['username'];
        $final = $_POST['image_data'];
        $dt = date("Y-m-d", time());
        try {
            $sql = "INSERT INTO feed (img, username, upload_date, likes) values ('$final', '$username', '$dt', '0')";
            $stmt = $conn->query($sql);
            if ($stmt) {
                echo "<script>alert('Posted!')</script>"; //special notification thing
                echo "<script>window.open('../pages/feed.php','_self')</script>";
            }
            else {
                echo "<script>alert('Sorry, we could not post your image!')</script>"; //special notification thing
                echo "<script>window.open('../pages/upload.php','_self')</script>";
            }
        } catch (PDOException $exception) {
            echo $sql . "<br>" . $exception->getMessage(); //dont need for final?
            echo "<script>alert('SQL ERROR: 1')</script>";
            // echo "<script>window.open('../pages/upload.php','_self')</script>";
        }
    }
    else {
        echo "<script>alert('Please upload an image or take a photo first!')</script>"; //special notification thing
        echo "<script>window.open('../pages/upload.php','_self')</script>";
    }
}

function fileUpload() {
    require 'db.php';
    date_default_timezone_set('Africa/Johannesburg');
    $username = $_SESSION['username'];
    $fileName = $_FILES['uploadedFile']['name'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
    
    if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK) {
        if ($fileExtension !== "jpg" && $fileExtension !== "jpeg" && $fileExtension !== "png" && $fileExtension !== "gif") {
            echo "<script>alert('Please select an image with a valid file type!')</script>"; //special notification thing
            echo "<script>window.open('../pages/upload.php','_self')</script>";
            exit();
        }
        $dt = date("Y-m-d", time());
        $image = base64_encode(file_get_contents($_FILES['uploadedFile']['tmp_name']));
        try {
            $sql = "INSERT INTO feed (img, username, upload_date, likes) VALUES ('$image', '$username', '$dt', '0')";
            $stmt = $conn->query($sql);
            if ($stmt) {
                echo "<script>alert('Posted!')</script>"; //special notification thing
                echo "<script>window.open('../pages/feed.php','_self')</script>";
            }
            else {
                echo "<script>alert('Sorry, we could not post your image!')</script>"; //special notification thing
                echo "<script>window.open('../pages/upload.php','_self')</script>";
            }
        } catch (PDOException $exception) {
            echo $sql . "<br>" . $exception->getMessage(); //dont need for final?
            echo "<script>alert('SQL ERROR: 1')</script>";
            echo "<script>window.open('../pages/upload.php','_self')</script>";
        }
    }
    else {
        echo "<script>alert('Please select an image to upload first!')</script>"; //special notification thing
        echo "<script>window.open('../pages/upload.php','_self')</script>";
    }
    $conn = NULL;
}

session_start();
if (!isset($_SESSION['username'])) {
    echo "<script>alert('Please login first!')</script>";
    echo "<script>window.open('../pages/login.php','_self')</script>";
    exit();
}
else {
    if (isset($_POST['uploadBtn'])) {
        fileUpload();
    }
    else if (isset($_POST['submit'])) {
        photoUpload();
    }
    else {
        echo "<script>window.open('../pages/upload.php','_self')</script>";
    }
}

?>