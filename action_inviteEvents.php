<?php
	session_start();
	include_once('database/connection.php');
	include_once('database/events.php');
	addGuest($_POST['convidado'], $_POST['eid']);
	header('Location: templates/convidarEvento.php');
?>