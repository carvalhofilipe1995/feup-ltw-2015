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
	
	//BUG FIX do mais ridiculo que possa existir
 	if ($_GET['day'] < 10)
 		$day = '0'.$_GET['day'];
 	else 
 		$day = $_GET['day'];	
	
 	$data =  $_GET['year']."-".$month."-".$_GET['day'];
	
	getDayEventPhoto($_SESSION['id'], $data);
	
	
?>