<?php

function like($img_id) {    //logged in user have access
    require 'db.php';
    session_start();
    $username = $_SESSION['username'];
    //get count of likes for image_id in feed. Increment by one and add it
}

function comment($commt, $img_id) {     //logged in users have access
    if (strlen($commt) >= 200) {
        echo "<script>alert('Please make sure your comment is 200 characters or less.')</script>";
        echo "<script>window.open('../pages/feed.php','_self')</script>";       //needs to return to where request came from
        exit();
    }
    require 'db.php';
    date_default_timezone_set('Africa/Johannesburg');
    session_start();
    $username = $_SESSION['username'];
    $dt = date("Y-m-d", time());
    //insert into comments (image_id, username, comm_date, comment) values ($img_id, $username, dt, $commt)
}

function delete($img_id) {      //only users who own this post will have access to this button (done in html file)
    require 'db.php';
    session_start();
    $username = $_SESSION['username'];

    //delete * from feed where image_id == img_id
    //delete * from comments where image_id == img_id
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