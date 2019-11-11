<?php

require 'db.php';

session_start();
$username = $_SESSION['username'];
try {
    $stmt = $conn->query("SELECT img FROM feed WHERE username= '$username' ORDER BY upload_date DESC");
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
catch (PDOException $exception) {
    echo "SQL ERROR ";
    echo $sql . "<br>" . $exception->getMessage();
}
if (!$posts) {
    echo "<div>You have no previous posts!</div>";
}
else {
    foreach ($posts as $row) {
        $encoded_image = $row['img'];
        $display = "<img src='data:image/*;base64,{$encoded_image}' width='70%' height='20%' >";
        echo $display;
    }
}
$conn = NULL;

?>