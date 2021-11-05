<?php
	session_start();
	unset($_SESSION['ADMIN_LOGIN']);
	unset($_SESSION['ADMIN_USERNAME']);
	header('location:https://projectpaw.000webhostapp.com//index.php');
	die();
?>