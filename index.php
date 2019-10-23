<?php

session_start();

if (isset($_SESSION['login']))
	echo "<script>window.open('./pages/feed.html','_self')</script>";
else
	echo "<script>window.open('./pages/login.html','_self')</script>";

?>