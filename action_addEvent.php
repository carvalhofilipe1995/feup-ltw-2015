<?php
  include_once('database/connection.php');
  include_once('database/events.php');
  $id = addEvent($_POST['nome'], $_POST['descricao'], $_POST['localizacao'], 'photo/e'.$fileName.'.jpg' ,$_POST['data'], $_POST['tempo'], $_POST['tipo'], $_POST['id']);
  if ($id != null) {
	move_uploaded_file($_FILES['image']["tmp_name"], 'photo/e'.$id['eid'].'.jpg');
	header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
  else {
		echo 'Não faço ideia porque alguma vez virias aqui ter mas se conseguires essa proeza aqui fica esta mensagem de parabéns';
  }
  ?>