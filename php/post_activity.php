<?php

function like($img_id) {
    require 'db.php';
    session_start();
    $username = $_SESSION['username'];
    $sql = "UPDATE feed SET likes=likes+1 WHERE image_id='$img_id'";
    $stmt = $conn->query($sql);
    if (!$stmt) {
        echo "<script>alert('Sorry, this action could not be completed!')</script>";
        echo "<script>window.open('../pages/feed.php','_self')</script>";
        exit();
    }
    $conn = NULL;
    echo "<script>window.open('../pages/feed.php','_self')</script>";
     
}

function comment($commt, $img_id) {
    if (strlen($commt) >= 200) {
        echo "<script>alert('Please make sure your comment is 200 characters or less.')</script>";
        echo "<script>window.open('../pages/feed.php','_self')</script>";
        exit();
    }
    require 'db.php';
    date_default_timezone_set('Africa/Johannesburg');
    session_start();
    $username = $_SESSION['username'];
    $dt = date("Y-m-d", time());
    try {
        $stmt = $conn->prepare("INSERT INTO comments (image_id, comment, username, comm_date) values ('$img_id', :comm, '$username', '$dt')");
        $stmt->bindParam(':comm', $commt);
        if (!$stmt->execute()) {
            echo "<script>alert('SQL ERROR: 1')</script>";
            echo "<script>window.open('../pages/feed.php?error=sql','_self')</script>";
            exit();
        }
    } catch (PDOException $exception) {
        echo $sql . "<br>" . $exception->getMessage(); //dont need for final?
        echo "<script>alert('SQL ERROR: 2')</script>";
        exit();
    }
    $conn = NULL;
    echo "<script>alert('Comment posted!')</script>"; //do not need when below is done
    //cool comment posted thingy
    echo "<script>window.open('../pages/feed.php','_self')</script>";
}

function delete($img_id) {
    require 'db.php';
    session_start();
    $username = $_SESSION['username'];

    $num = $conn->exec("DELETE FROM feed WHERE image_id='$img_id' AND username='$username'");
    if (!$num) {
        echo "<script>alert('Could not be deleted!')</script>";
    }
    else {
        $num = $conn->exec("DELETE FROM comments WHERE image_id='$img_id'");
        echo "<script>alert('Deleted!')</script>"; //do not need when below is done
        //cool delete post thingy
    }
    $conn = NULL;
    echo "<script>window.open('../pages/feed.php','_self')</script>";
}

session_start();
if (isset($_SESSION['username'])) {
    if (isset($_POST['like'])){
        like($_POST['id']);
    }
    else if (isset($_POST['comment'])) {
        $commt = $_POST['comment_box'];
        comment($commt, $_POST['id']);
    }
    else if (isset($_POST['delete'])) {
        delete($_POST['id']);
    }
    else {
        echo "<script>window.open('../pages/feed.php','_self')</script>";
    }
}
else {
    echo "<script>alert('Please login first before trying this action.')</script>";
    echo "<script>window.open('../pages/login.php','_self')</script>";
}

?>