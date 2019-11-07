<?php

require 'db.php';

CREATE DATABASE IF NOT EXISTS icon;

CREATE TABLE users(
 	username varchar(15) PRIMARY KEY NOT NULL,
    passwd varchar(4096) NOT NULL,
    name_user varchar(20) NOT NULL,
    surname varchar(20) NOT NULL,
    email varchar(50) NOT NULL,
    verified int(1) NOT NULL,
    verif_key VARCHAR(8000) NOT NULL,
    user_img LONGBLOB
);

CREATE TABLE feed (
    image_id int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    img LONGTEXT NOT NULL,
    username varchar(15) NOT NULL,
    upload_date date NOT NULL,
    likes BIGINT
);

CREATE TABLE comments (
    comm_id int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    image_id int(11) NOT NULL,
    comment varchar(200) NOT NULL,
    username varchar(15) NOT NULL,
    comm_date date NOT NULL
);

$conn = NULL;

?>