<?php
	session_start();
	include_once('database/connection.php');
	include_once('database/events.php');
	addComment($_SESSION['id'], $_SESSION['eid'], $_POST['comentario']);
	header('Location: ' . $_SERVER['HTTP_REFERER']);
?>