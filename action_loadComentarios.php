<?php
	session_start();
	include_once('database/connection.php');
	include_once('database/events.php');
	getComments($_SESSION['id'], $_GET['eid']);
	
?>