<?php

//needs to be given css - Gabriel

require 'db.php';

try {
    $stmt = $conn->query("SELECT * FROM feed ORDER BY upload_date DESC");
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $exception) {
    echo $sql . "<br>" . $exception->getMessage();      //dont need for final?
    echo "<script>alert('SQL ERROR: 1')</script>";
    exit();
}

if (!$posts) {
    echo "<h2>No posts to view here yet!</h2>";
    exit();
}

foreach ($posts as $row) {
    $encoded_image = base64_encode($row['img']);
    $display = "<img src='data:image/jpeg;base64,{$encoded_image}' width='40%' height='40%' >";
    session_start();
    if (isset($_SESSION['username'])) {
        echo "<h4>@" . $row['username'] . "</h4>";
        echo $display;
        echo "<h4>Likes " . $row['likes'] . "</h4>";    //add button to like the picture. Only available for logged in users
        echo "<i>Posted " . $row['upload_date'] . "</i>";
        echo '<hr />';
    }
    else {
        echo "<h4>@" . $row['username'] . "</h4>";
        echo $display;
        echo "<h4>Likes " . $row['likes'] . "</h4>";
        echo "<i>Posted " . $row['upload_date'] . "</i>";
        echo '<hr />';
    }
}

$conn = NULL;

?>