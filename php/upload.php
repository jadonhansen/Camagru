<?php

//needs to be given css - Gabriel

//update feed table when a picture is posted

session_start();
if (!isset($_SESSION['username'])) {
    echo "<script>alert('Please login first!')</script>";
    echo "<script>window.open('../pages/login.php','_self')</script>";
    exit();
}

if (isset($_POST['uploadBtn'])) {
    require 'db.php';
    $username = $_SESSION['username'];

    if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK) {
        $fTempPath = $_FILES['uploadedFile']['tmp_name'];
        $fName = $_FILES['uploadedFile']['name'];

        
        echo "<script>alert('$fname, $fTempPath')</script>";
        // $likes = 0;
        // $dt = date("Y-m-d", time());
        
        $image = base64_encode(file_get_contents($_FILES['file']['tmp_name']));

        try {
            $sql = "INSERT INTO feed (img, username, upload_date, likes) VALUES ('".$image."', $username, $dt, $likes)";
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
            echo $sql . "<br>" . $exception->getMessage(); //dont need for final?
            echo "<script>alert('SQL ERROR: 1')</script>";
            echo "<script>window.open('../pages/upload.php','_self')</script>";
            exit();
        }
        
        
        // $fNameCmps = explode(".", $fName);
        // $fExtension = strtolower(end($fNameCmps));
        // $extensions_arr = array('jpg', 'jpeg', 'png', 'gif');
        // if (in_array($fType, $extensions_arr)) {

        // }
        // else {
        //     echo "<script>alert('Your file does not match the filetype requirements.')</script>";
        //     echo "<script>window.open('../pages/upload.php','_self')</script>";
        // }
        $conn = NULL;
    }
    else {
        echo "<script>alert('Please select an image to upload first!')</script>";
        echo "<script>window.open('../pages/upload.php','_self')</script>";
        exit();
    }
}
else {
    echo "<script>window.open('../pages/upload.php','_self')</script>";
}

?>