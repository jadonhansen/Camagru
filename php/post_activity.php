<?php

function email_notif($from, $message, $img_id) {
    require 'db.php';
    $stmt = $conn->query("SELECT username FROM feed WHERE image_id='$imd_id'");
    $profile = $stmt->fetch(PDO::FETCH_ASSOC);
    $usr = $profile['username'];
    $stmt = $conn->query("SELECT notifications, email FROM users WHERE username='$usr'");
    $results = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($results['email'] && $results['notifications'] === '1') {
        $to = $results['email'];
        $subject = "ICON - @$from commented on your post!";
        $msg = "@$from commented on your post and said: " . $message;
        $headers = "From: $from_email \r\n";
        $headers .= "MINE-Version: 1.0"."\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8"."\r\n";
        $res = mail($to, $subject, $msg, $headers);
    }
    $conn = NULL;
}

function like($img_id) {
    require 'db.php';
    session_start();
    $username = $_SESSION['username'];
    $sql = "UPDATE feed SET likes=likes+1 WHERE image_id='$img_id'";
    $stmt = $conn->query($sql);
    if (!$stmt) {
        echo "False";
        exit();
	}
	$stmt = $conn->query("SELECT likes FROM feed WHERE image_id='$img_id'");
	$post = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$post) {
        echo "False";
	}
	else {
		echo $post['likes'];
	}
	$conn = NULL;
}

function comment($commt, $img_id) {
    if (strlen($commt) >= 200 || strlen($commt) <=0) {
        echo "False1";
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
            echo "False";
            exit();
        }
    } catch (PDOException $exception) {
        echo "False";
        exit();
    }
	$conn = NULL;
    email_notif($username, $dt, $commt, $img_id);
	echo "True";
}


function delete($img_id) {
    require 'db.php';
    session_start();
    $username = $_SESSION['username'];
    $num = $conn->exec("DELETE FROM feed WHERE image_id='$img_id' AND username='$username'");
    if (!$num) {
        echo "<script>alert('Your post could not be deleted!')</script>";
    }
    else {
        $num = $conn->exec("DELETE FROM comments WHERE image_id='$img_id'");
        echo "<script>alert('Deleted!')</script>";
    }
    $conn = NULL;
    echo "<script>window.open('../pages/feed.php','_self')</script>";
}

function playFetch($id) {
	require 'db.php';
	$stmt = $conn->prepare("SELECT comment, comm_date, username FROM comments WHERE image_id='$id' ORDER BY comm_date DESC");
	$stmt->execute();
	$rows = $stmt->fetchAll();
    if (!$rows) {
        echo "There are no comments for this post!";
    }
    else {
        echo"<div class='feed-comment'>";
		foreach ($rows as $row) {
			echo $row['comment'] . " --> Posted by " . $row['username'] . " on " . $row['comm_date'];
			echo "<br />";
        }
        echo"</div>";
    }
    $conn = NULL;
	exit();
}

session_start();
if (isset($_SESSION['username'])) {
	if (isset($_POST['details'])) {
		playFetch($_POST['details']);
	}
    else if (isset($_POST['like'])){
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