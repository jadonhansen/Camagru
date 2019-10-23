<?php

session_start();

if (isset($_SESSION['login'])) {
	$username = $_SESSION['login'];
	echo "<script>window.open('./pages/feed.html?$username,'_self')</script>";
}
else
	echo "<script>window.open('./pages/feed.html','_self')</script>";

?>