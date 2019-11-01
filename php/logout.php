<?php

function logout() {
    session_start();
    $_SESSION['username'] = "";
    session_destroy();
    echo "<script>window.open('../pages/login.php','_self')</script>";
}

logout();

?>