<?php
	session_start();
	include_once('database/connection.php');
	include_once('database/events.php');
	$_GET['month']++;
	$dataInicio = $_GET['year']."-".$_GET['month']."-1";
	$dataFim = $_GET['year']."-".$_GET['month']."-".$_GET['lastDay'];
	getMyEvent($_SESSION['id'], $dataInicio, $dataFim);
?>