<?php

session_start();

if (isset($_SESSION['username'])) {
	$username = $_SESSION['username'];
	echo "<script>window.open('./pages/feed.php?$username,'_self')</script>";	//not working
}
else
	echo "<script>window.open('./pages/login.php','_self')</script>";

?>