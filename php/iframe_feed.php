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
    $display = "<img src='data:image/jpeg;base64,{$encoded_image}' width='85%' height='60%' >";
    session_start();
    if (isset($_SESSION['username'])) {
        echo "<h4 style='position:relative; padding-left:15%; top:38px;'>@" . $row['username'] . "</h4>";
        echo "<i style='position:relative; float:right; right:70%; top:69%;'>Posted " . $row['upload_date'] . "</i>";
        echo "<div style='position:relative; padding-left:15%;'>" . $display . "</div>";
        echo "<h4 style='padding-left:20.5%'>Likes " . $row['likes'] . "</h4>";
        
        // like button
        echo "  <form action='../php/likes.php' method='post'>
                    <input style='position:relative; top:-40px; float:right; right:80.5%;' type='submit' value='Like'>           
                </form>";
        
                // comments
        echo "<form action='../php/comments.php' method='post'>
                    <input style='position:relative; left:15%; width:40%; type='comment' name='comment'>
                    <input style='position:relative; left:15%;' type='submit' value='Post'>
                </form>";

        echo "<div style='width:100%; height:3%;'>  </div>";
        echo "<hr />";
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