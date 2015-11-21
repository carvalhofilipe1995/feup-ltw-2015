<?php
  session_start();       
  include_once('database/connection.php');
  include_once('database/users.php');
  $id = checkUser($_POST['username'], $_POST['password']);
  if ($id != null) {
    $_SESSION['username'] = $_POST['username'];   
	$_SESSION['id'] = $id['uid'];   
	header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
  else {
	echo('Password errada');
  }
?>
