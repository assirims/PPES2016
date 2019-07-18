<?php
	session_start();
	if (!isset($_SESSION['student_id'])){
		header("Location: std_login.php");
		exit;
	}
?>