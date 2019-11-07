<?php


//OPTIONAL


require 'db.php';

session_start();
if (!isset($_SESSION['username'])) {
    echo "<script>alert('Please login first before using this feature!')</script>";
    echo "<script>window.open('../pages/login.php','_self')</script>";
    exit();
}

if (isset($_POST['search'])) {
    if (empty($_POST['search_param'])) {
        echo "<script>alert('Please enter a search parameter first!')</script>";
        echo "<script>window.open('../pages/feed.php','_self')</script>";
        exit();
    }
    else {
        $param = $_POST['search_param'];
        try {
            $sql = "SELECT from user (username, name_user, surname,  user_img) WHERE username= :usrparam";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':usrparam', $param);
            if (!$stmt->execute()) {
                echo "<script>alert('SQL ERROR: 1')</script>";
                echo "<script>window.open('../pages/login.php?error=sql','_self')</script>";
                exit();
            }
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$result) {
                echo "<h2>No results for the user '$param'</h2>";
                echo "<script>window.open('../pages/login.php','_self')</script>";
                exit();       
            }
            //echo result;
		} catch (PDOException $exception) {
			echo $sql . "<br>" . $exception->getMessage(); //dont need for final?
			echo "<script>alert('SQL ERROR: 2')</script>";
			echo "<script>window.open('../pages/login.php','_self')</script>";
			exit();
        }
    }
    $conn = NULL;
}
else {
    echo "<script>window.open('../pages/feed.php','_self')</script>";
}

?>