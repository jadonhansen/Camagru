<?php

require 'db.php';
session_start();

try {
    $logged_on = $_SESSION['username'];
    $stmt = $conn->query("");
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $exception) {
    echo $sql . "<br>" . $exception->getMessage();      //dont need for final?
    echo "<script>alert('SQL ERROR: 1')</script>";
    echo "<script>window.open('./gallery.php','_self')</script>";
}

if (!$posts) {
    echo "<h2>No posts to view here yet!</h2>";
    exit();
}

//infinite scrolling

$conn = NULL;

?>