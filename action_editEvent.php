<?php
  session_start();
  include_once('database/connection.php');
  include_once('database/events.php');
  // 15 casos distintos caso queira fazer uma unica instrução SQL... Maybe in another life brother!
  // Cada valor not null = query diferente, seems guud
  if ($_POST['action'] == 'EDITAR') {
	  if ($_POST['nome'] != "")
		editEventNome($_POST['eid'], $_POST['nome']);
	  if ($_POST['descricao'] != "")
		editEventDescricao($_POST['eid'], $_POST['descricao']);
	  if ($_POST['localizacao'] != "")
		editEventLocalizacao($_POST['eid'], $_POST['localizacao']);
	  if ($_POST['data'] != "")
		editEventData($_POST['eid'], $_POST['data']);
	  if ($_POST['tempo'] != "")
		editEventTempo($_POST['eid'], $_POST['tempo']);
	  if ($_FILES['image']['size'] != "") {
		$id = $_POST['eid'];
		move_uploaded_file($_FILES['image']["tmp_name"], 'photo/e'.$id.'.jpg');
	  }
	}
  else
	deleteEvent($_POST['eid']);
  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>