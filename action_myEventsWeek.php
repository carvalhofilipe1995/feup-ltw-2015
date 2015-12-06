<?php
	session_start();
	include_once('database/connection.php');
	include_once('database/events.php');

	$_GET['lastDayMonth']++;
	$_GET['firstDayMonth']++;

	
	//BUG FIX do mais ridiculo que possa existir
 	if ($_GET['lastDayMonth'] < 10)
		$lastDayMonth = '0'.$_GET['lastDayMonth'];
 	else 
 		$lastDayMonth = $_GET['lastDayMonth'];	
		
	if ($_GET['firstDayMonth'] < 10)
		$firstDayMonth = '0'.$_GET['firstDayMonth'];
 	else 
 		$firstDayMonth = $_GET['firstDayMonth'];
		
 	if ($_GET['lastDay'] < 10)
 		$lastDay = '0'.$_GET['lastDay'];
 	else 
 		$lastDay = $_GET['lastDay'];	
	
	 if ($_GET['firstDay'] < 10)
 		$firstDay = '0'.$_GET['firstDay'];
 	else 
 		$firstDay = $_GET['firstDay'];
	
 	$dataInicio =  $_GET['firstDayYear']."-".$firstDayMonth."-".$firstDay;
	$dataFim = $_GET['lastDayYear']."-".$lastDayMonth."-".$lastDay;
	getMyEvent($_SESSION['id'], $dataInicio, $dataFim);
	
	
?>