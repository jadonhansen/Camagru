<?php

//gabriel is working on this. Remove file when he's done

require 'db.php';
session_start();

try {
    $_SESSION['username'] = "jhansen"; //for testing

    $logged_on = $_SESSION['username'];
    $stmt = $conn->query("SELECT username, name_user, surname, email, user_img FROM users WHERE username = '$logged_on' AND verified=1");
    $info = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $exception) {
    echo $sql . "<br>" . $exception->getMessage();      //dont need for final?
    echo "<script>alert('SQL ERROR: 1')</script>";
    echo "<script>window.open('./profile.php','_self')</script>";
    exit();
}

if (!$info) {
    echo "<h2>Oops! Your information could not be displayed :(</h2>";
}
else {
    if ($info['user_img']) {
        $encoded_image = base64_encode($info['user_img']);
        $display = "<img src='data:image/jpeg;base64,{$encoded_image}' width='25%' height='25%'>";        
    }
    else {
        $display = "<img src='../images/user_img.png' width='6%' height='10%'>";
    }
    echo $display;
    echo "<h2>@" . $info['username'] . "</h2>";
    echo "<h4>" . $info['name_user'] . " " . $info['surname'] . "</h4>";
    echo "<i>" . $info['email'] . "</i>";
}

$conn = NULL;

?>