<?php
  include_once('database/connection.php');
  include_once('database/users.php');
  var_dump($_POST);
  $id = addUser($_POST['username'], $_POST['password'],$_POST['bday'], $_POST['email']);
  if ($id != null) {
	move_uploaded_file($_FILES['image']["tmp_name"], 'photo/u'.$id.'.jpg');
	header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
  else {
	echo('Utilizador/Email repetido');
  }
?>