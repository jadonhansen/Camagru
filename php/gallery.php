<?php

//needs to be given html - Gabriel

require 'db.php';
session_start();

try {
    $logged_on = $_SESSION['username'];
    $stmt = $conn->query("SELECT * FROM feed WHERE username= '$logged_on'");
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $exception) {
    echo $sql . "<br>" . $exception->getMessage();      //dont need for final?
    echo "<script>alert('SQL ERROR: 1')</script>";
}
if (!$posts) {
    echo "<h2>No posts to view here yet!</h2>";
    exit();
}

//infinite scrolling

$conn = NULL;

?>