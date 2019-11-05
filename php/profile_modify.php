<?php

function complex_check($pass) {
	if (strlen($pass) < 8) {
		echo "<script>alert('Please make sure your password is 8 characters or longer.')</script>";
		echo "<script>window.open('../pages/profile.php','_self')</script>";
		exit();
	}
	$containsLower = preg_match('/[a-z]/', $pass);
	$containsUpper = preg_match('/[A-Z]/', $pass);
	$containsDigit = preg_match('/[0-9]/', $pass);
	$containsSpecial = preg_match('/[\W]+/', $pass);
	if (!$containsUpper || !$containsLower || !$containsDigit || !$containsSpecial) {
		echo "<script>alert('Please make sure your password has an array of lowercase letters, uppercase letters, at least one digit and at least one special character.')</script>";
		echo "<script>window.open('../pages/profile.php','_self')</script>";
		exit();
	}
}

function pass_modi() {
    if (empty($_POST['new_pass']) || empty($_POST['rep_pass'])) {
        echo "<script>alert('Please fill in all fields correctly.')</script>";
        echo "<script>window.open('../pages/profile.php','_self')</script>";
        exit();
    }
    if ($_POST['new_pass'] !== $_POST['rep_pass']) {
        echo "<script>alert('Your answers do not match!')</script>";
        echo "<script>window.open('../pages/profile.php','_self')</script>";
        exit();
    }
    complex_check($_POST['new_pass']);
    require 'db.php';
    session_start();
    $usrnam = $_SESSION['username'];
    $passwd = $_POST['new_pass'];
    $new = hash("whirlpool", $passwd);
    $stmt = $conn->prepare("UPDATE users SET passwd = :pass WHERE username = :usrn");
    $stmt->bindParam(':pass', $new);
    $stmt->bindParam(':usrn', $usrnam);
    if (!$stmt->execute()) {
        echo "<script>alert('SQL ERROR: 1')</script>";
        echo "<script>window.open('../pages/profile.php?error=sqlerror','_self')</script>";
        exit();
    }
    echo "<script>alert('Saved! Please login with your new details, $usrnam.')</script>";
    require_once 'logout.php';
}

function nam_modi() {
    if (empty($_POST['new_nam']) || empty($_POST['new_surnam'])) {
        echo "<script>alert('Please fill in all fields correctly.')</script>";
        echo "<script>window.open('../pages/profile.php','_self')</script>";
        exit();
    }
    $nam = $_POST['new_nam'];
    $srnam = $_POST['new_surnam'];
	if (!preg_match("/^[a-zA-Z]*$/", $nam) || strlen($nam) >= 20 || strlen($nam) <= 1) {
        echo "<script>alert('Please make sure the name field only consists of uppercase or lowercase letters and that it is bigger than 1 character and smaller than 20 characters.')</script>";
        echo "<script>window.open('../pages/profile.php','_self')</script>";
        exit();
    }
	if (!preg_match("/^[a-zA-Z]*$/", $srnam) || strlen($srnam) >= 20 || strlen($srnam) <= 1) {
		echo "<script>alert('Please make sure the surname field only consists of uppercase or lowercase letters and that it is bigger than 1 character and smaller than 20 characters.')</script>";
        echo "<script>window.open('../pages/profile.php','_self')</script>";
        exit();
    }
    require 'db.php';
    session_start();
    $usernam = $_SESSION['username'];
    $stmt = $conn->prepare("UPDATE users SET name_user= :name_s, surname= :surname_s WHERE username = :usrn");
    $stmt->bindParam(':name_s', $nam);
    $stmt->bindParam(':surname_s', $srnam);
    $stmt->bindParam(':usrn', $usernam);
    if (!$stmt->execute()) {
        echo "<script>alert('SQL ERROR: 1')</script>";
        echo "<script>window.open('../pages/profile.php?error=sqlerror','_self')</script>";
        exit();
    }
    echo "<script>alert('Details saved!')</script>";
    echo "<script>window.open('../pages/profile.php','_self')</script>";
}

function usrnam_modi() {
    if (empty($_POST['new_usr']) || empty($_POST['rep_usr'])) {
        echo "<script>alert('Please fill in all fields correctly.')</script>";
        echo "<script>window.open('../pages/profile.php','_self')</script>";
        exit();
    }
    if ($_POST['new_usr'] !== $_POST['rep_usr']) {
        echo "<script>alert('Your answers do not match!')</script>";
        echo "<script>window.open('../pages/profile.php','_self')</script>";
        exit();
    }
    $usrnam = $_POST['new_usr'];
    if (!preg_match("/^[a-zA-Z0-9]*$/", $usrnam) || strlen($usrnam) >= 15 || strlen($usrnam) <= 1) {
        echo "<script>alert('Please make sure your username only consists of either uppercase letters, lowercase letters or number characters and that it is bigger than 1 character and smaller than 15 characters.')</script>";
        echo "<script>window.open('../pages/profile.php','_self')</script>";
        exit();
    }
    require 'db.php';
    session_start();
    $old_username = $_SESSION['username'];
    $stmt = $conn->prepare("SELECT username FROM users WHERE username= :search");
	$stmt->bindParam(':search', $usrnam);
	if (!$stmt->execute()) {
		echo "<script>alert('SQL ERROR: 1')</script>";
		echo "<script>window.open('../pages/profile.php?error=sql','_self')</script>";
		exit();
	}
	$result = $stmt->fetch();
	if ($result) {
		echo "<script>alert('Username taken! Please use a different one.')</script>";
		echo "<script>window.open('../pages/profile.php?error=usernametaken','_self')</script>";
		exit();
	}
	else {
        $stmt = $conn->prepare("UPDATE users SET username = :new WHERE username = :old");
        $stmt->bindParam(':new', $usrnam);
        $stmt->bindParam(':old', $old_username);
        if (!$stmt->execute()) {
            echo "<script>alert('SQL ERROR: 1')</script>";
            echo "<script>window.open('../pages/profile.php?error=sqlerror','_self')</script>";
            exit();
        }
        echo "<script>alert('Saved! Please login with your new details, $usrnam.')</script>";
        require_once 'logout.php';
    }
}

function eml_modi() {
    if (empty($_POST['new_eml']) || empty($_POST['rep_eml'])) {
        echo "<script>alert('Please fill in all fields correctly.')</script>";
        echo "<script>window.open('../pages/profile.php','_self')</script>";
        exit();
    }
    if ($_POST['new_eml'] !== $_POST['rep_eml']) {
        echo "<script>alert('Your answers do not match!')</script>";
        echo "<script>window.open('../pages/profile.php','_self')</script>";
        exit();
    }
    $email = $_POST['new_eml'];
    require 'db.php';
    session_start();
    $usrnam = $_SESSION['username'];
    $stmt = $conn->prepare("UPDATE users SET email = :eml WHERE username = :usrn");
    $stmt->bindParam(':eml', $email);
    $stmt->bindParam(':usrn', $usrnam);
    if (!$stmt->execute()) {
        echo "<script>alert('SQL ERROR: 1')</script>";
        echo "<script>window.open('../pages/profile.php?error=sqlerror','_self')</script>";
        exit();
    }
    echo "<script>alert('Details saved!')</script>";
    echo "<script>window.open('../pages/profile.php','_self')</script>";
}

function pic_modi() {
    
}

session_start();

if (isset($_SESSION['username'])) {
    if (isset($_POST['pass_mod'])) {
        pass_modi();
    }
    else if (isset($_POST['nam_mod'])) {
        nam_modi();
    }
    else if (isset($_POST['usrnam_mod'])) {
        usrnam_modi();
    }
    else if (isset($_POST['eml_mod'])) {
        eml_modi();
    }
    else if (isset($_POST['pic_mod'])) {
        pic_modi();
    }
    else {
        echo "<script>window.open('../pages/profile.php','_self')</script>";
    }
    $conn = NULL;
}
else {
    echo "<script>alert('Please login first!')</script>";
    echo "<script>window.open('../pages/login.php','_self')</script>";
}

?>