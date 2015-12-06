<?php
	session_start();
	include_once('database/connection.php');
	include_once('database/events.php');
	$_GET['month']++;
	//BUG FIX do mais ridiculo que possa existir
	if ($_GET['month'] < 10)
		$month = '0'.$_GET['month'];
	else 
		$month = $_GET['month'];	
	$dataInicio = $_GET['year']."-".$month."-01";
	$dataFim = $_GET['year']."-".$month."-".$_GET['lastDay'];
	getMyEvent($_SESSION['id'], $dataInicio, $dataFim);
?>