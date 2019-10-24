<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['key'])) {
    require 'db.php';
    $key = $_GET['key'];
    $sql = "SELECT * FROM users WHERE verif_key=?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "<script>window.open('../php/verify_account.php?error=sqlerror','_self')</script>";
        exit();
    }
    else {
        mysqli_stmt_bind_param($stmt, "s", $key);
        mysqli_execute($stmt);
        $result = mysqli_stmt_num_rows($stmt);
        if ($result == 1) {
            $sql = "UPDATE users SET verified=1 WHERE verif_key=?";
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_bind_param($stmt, "s", $key);
            mysqli_stmt_execute($stmt);
            echo "<h2>Account has been verified</h2>";
            echo "<h4>Please login with your details to begin:</h4>";
            echo "<button onclick=window.location.href = '../pages/login.html';'>Login</button>";
            exit();
        }
        else {                          //
            echo "No user data added!"; //for testing
        }                               //
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else {
    echo "<h1>Your verification key is not valid!</h1>";
    echo "<h2>Please try again:</h2>";
    echo "<button onclick=window.location.href = '../pages/create.html';'>Create account</button>";
    exit();
}

?>