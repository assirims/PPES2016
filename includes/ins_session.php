<?php
	session_start();
	if (!isset($_SESSION["instructor_id"])){
		header("Location: ins_login.php");
		exit;
	}
?>