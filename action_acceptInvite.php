<?php
	session_start();
	include_once('database/connection.php');
	include_once('database/events.php');
	addParticipant($_SESSION['id'], $_POST['eid']);
	header('Location: templates/convites.php');
?>