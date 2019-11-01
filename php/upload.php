<?php

//needs to be given css - Gabriel

//update feed table when a picture is posted

session_start();
if (isset($_SESSION['username'])) {
    if (isset($_POST['upload'])) {
        require 'db.php';
        $username = $_SESSION['username'];


        $img = //;
        $filter = //;
        //superimpose both

        $likes = 0;
        $dt = date("Y-m-d", time());
        //upload all details as new post to feed
    }
}

?>