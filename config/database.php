<?php

function bigbang() {
    $server = "localhost";
    $username = "root";
    $password = "qwerty";
    try {
        $conn = new PDO("mysql:host=$server", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "CREATE DATABASE IF NOT EXISTS icon";
        $stmt = $conn->exec($sql);
        } catch (PDOException $exception) {
            $msg = $exception->getMessage();
            echo "Could not perform operation! (create db) --> " . $msg;
            exit(); 
        }
    $conn = NULL;
}

function conscious_presence() {
    $server = "localhost";
    $username = "root";
    $password = "qwerty";
    try {
        $conn = new PDO("mysql:host=$server;dbname=icon", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "CREATE TABLE users(
                username varchar(15) PRIMARY KEY NOT NULL,
            passwd varchar(4096) NOT NULL,
            name_user varchar(20) NOT NULL,
            surname varchar(20) NOT NULL,
            email varchar(50) NOT NULL,
            verified int(1) NOT NULL,
            verif_key VARCHAR(8000) NOT NULL,
            user_img LONGBLOB)";
        $stmt = $conn->exec($sql);
        } catch (PDOException $exception) {
            $msg = $exception->getMessage();
            echo "Could not perform operation! (user) --> " . $msg;
            exit(); 
        }
    $conn = NULL;    
}

function state_of_delerium() {
    $server = "localhost";
    $username = "root";
    $password = "qwerty";
    try {
        $conn = new PDO("mysql:host=$server;dbname=icon", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "CREATE TABLE feed (
            image_id int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
            img LONGTEXT NOT NULL,
            username varchar(15) NOT NULL,
            upload_date date NOT NULL,
            likes BIGINT)";
        $stmt = $conn->exec($sql);
        } catch (PDOException $exception) {
            $msg = $exception->getMessage();
            echo "Could not perform operation! (feed) --> " . $msg;
            exit(); 
        }
    $conn = NULL;    
}

function judgement() {
    $server = "localhost";
    $username = "root";
    $password = "qwerty";
    try {
        $conn = new PDO("mysql:host=$server;dbname=icon", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "CREATE TABLE comments (
                comm_id int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
                image_id int(11) NOT NULL,
                comment varchar(200) NOT NULL,
                username varchar(15) NOT NULL,
                comm_date date NOT NULL)";
        $stmt = $conn->exec($sql);
        } catch (PDOException $exception) {
            $msg = $exception->getMessage();
            echo "Could not perform operation! (comments) --> " . $msg;
            exit(); 
        }
    $conn = NULL;    
}

bigbang();
conscious_presence();
state_of_delerium();
judgement();
include ("./setup.php");
echo "<script>alert('Database created!')</script>";
echo "<script>window.open('../index.php','_self')</script>";

?>