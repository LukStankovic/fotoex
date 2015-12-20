<?php
	session_start();
	if(!isset($_SESSION['id_uzivatel']) || (trim($_SESSION['id_uzivatel']) == '')) {
		header("location: index.php");
		exit();
	}
?>