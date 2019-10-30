<?php

//needs Gabriels magical touch to make this pretty :)

if (isset($_GET['key'])) {
    require 'db.php';
    $key = $_GET['key'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE verif_key= :verifkey");
    $stmt->bindParam(':verifkey', $key);
    if (!$stmt->execute()) {
        echo "<h2>SQL ERROR: 1</h2>";
        exit();
    }
    $result = $stmt->fetch();
    if ($result) {
        $stmt = $conn->prepare("UPDATE users SET verified=1 WHERE verif_key= :verifkey");
        $stmt->bindParam(':verifkey', $key);
        if (!$stmt->execute()) {
            echo "<h2>SQL ERROR: 2</h2>";
            exit();
        }
        echo "<h2>Account has been verified!</h2>";
        echo "<h4>Please login with your details to begin:</h4>";
        echo "<button onclick='window.location.href = '..//pages//login.php';'>Login</button>";
        exit();
    }
    else {
        echo "<h2>Your details were not found! Please try again.<h2>";
    }
    $conn = NULL;
}
else {
    echo "<h1>No verification key detected!</h1>";
    echo "<h2>Please try again:</h2>";
    echo "<button onclick='window.location.href = '..//pages//create.php';'>Create account</button>";
    exit();
}

?>