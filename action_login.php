<?php
  session_start();       
  include_once('database/connection.php');
  include_once('database/users.php');
  $id = checkUser($_POST['username'], sha1($_POST['password']));
  if ($id != null) {
    $_SESSION['username'] = $_POST['username'];   
	$_SESSION['id'] = $id['uid'];   
	header('Location: templates/eventosPublicos.php');
	}
  else {
	echo '<script language="javascript">';
	echo 'alert("Wrong username or password")';
	echo '</script>';
	//header('Location: ' . $_SERVER['HTTP_REFERER']);

  }
?>
