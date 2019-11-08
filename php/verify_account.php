<?php

//needs to be given css - Gabriel

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
        echo "<form action='../pages/login.php' method='post'><input type='submit' value='Login page'></input></form>";
        exit();
    }
    else {
        echo "<h2>Your details were not found! Please try again.<h2>";
        echo "<form action='../pages/create.php' method='post'><input type='submit' value='Create account'></input></form>";
    }
    $conn = NULL;
}
else {
    echo "<h2>No verification key found! Please try again.<h2>";
    echo "<form action='../pages/create.php' method='post'><input type='submit' value='Create account'></input></form>";
    exit();
}

?>