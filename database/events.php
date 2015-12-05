<?php

  function getEventDetails($eid) { // Detalhes evento público
    global $db;   
	$query = "SELECT * FROM evento  WHERE eid= '$eid'";
    $stmt = $db->prepare($query);
    $stmt->execute();  	
    $events =  $stmt->fetchAll();
	header("Content-Type: application/json");
	echo json_encode($events);
  }
  function getComments($eid) { // Retorna comentários de um determinado evento
	global $db;    
	$query = "SELECT utilizador.nome, comentario.mensagem, utilizador.fotografia FROM comentario JOIN utilizador ON comentario.uid = utilizador.uid WHERE comentario.eid= $eid";
	$stmt = $db->prepare($query);
	$stmt->execute();  
    $events = $stmt->fetchAll();	
	header("Content-Type: application/json");
	echo json_encode($events);	  
  }
  
  function addComment($uid, $eid, $comentario){ // Inserir comentário
  	global $db;   
	$query = "INSERT INTO comentario VALUES ($uid, $eid, '$comentario')";
    $stmt = $db->prepare($query);
    return $stmt->execute();  
  }
  function deleteEvent($eid){
    global $db;   
	deleteParticipa($eid);	
	deleteConvidado($eid);
	deleteComentario($eid);
	$query ="DELETE FROM evento WHERE eid=$eid";
	$stmt = $db->prepare($query);
	$stmt->execute();  
  }
  
  function deleteParticipa($eid){
    global $db;   
  	$query ="DELETE FROM participa WHERE eid='$eid'";
	$stmt = $db->prepare($query);
	$stmt->execute();  
  }
  
  function deleteConvidado($eid){
	global $db;
	$query ="DELETE FROM convidado WHERE eid='$eid'";
	$stmt = $db->prepare($query);
	$stmt->execute();  
  }
  
  function deleteComentario($eid){
	global $db;
	$query ="DELETE FROM comentario WHERE eid=$eid";
	$stmt = $db->prepare($query);
	$stmt->execute();  
  }
  
  function getEventPhoto() { // Fotografia eventos publicos
    global $db;   
    $stmt = $db->prepare("SELECT eid, fotografia FROM evento WHERE tipo=0 AND dataOcorrencia > date('now')");
    $stmt->execute();  	
    $events = $stmt->fetchAll();
	header("Content-Type: application/json");
	echo json_encode($events);
  } 
  
  function getMyEvent($id, $dataInicio, $dataFim) {
    global $db;    
	$query = "SELECT tema, dataOcorrencia FROM evento JOIN participa ON participa.eid = evento.eid WHERE participa.uid= '$id' AND evento.dataOcorrencia BETWEEN '$dataInicio' AND '$dataFim'";
	$stmt = $db->prepare($query);
	$stmt->execute();  
    $events = $stmt->fetchAll();	
	header("Content-Type: application/json");
	echo json_encode($events);
  }
  
  function addEvent($nome, $descricao, $localizacao, $data, $tempo, $tipo, $id) { // Novo evento
	global $db;   
	$stmt = $db->prepare('SELECT max(eid) FROM evento');
	$stmt->execute();
	$eid = $stmt->fetch();
	$eid['max(eid)']++;
	$link = 'photo/e'.$eid['max(eid)'].'.jpg';
	$stmt = $db->prepare('INSERT INTO evento VALUES (NULL,?,?,?,?,?,?,?,?)');
    if($stmt->execute(array($nome, $descricao, $localizacao, $link, $data, $tipo, $tempo, $id))) {
		addParticipant($id, $eid['max(eid)']); // Fix para o facto de não conseguir funcionar com triggers --"
		return $eid['max(eid)'];
		}
		
	else {
		return null;
		}
  }
  
  function editEventNome($eid, $data) {
    global $db;   
	$query = "UPDATE evento SET tema='$data' WHERE eid=$eid";
	var_dump($query);
	$stmt = $db->prepare($query);
	$stmt->execute();  
  }
  
  function editEventData($eid, $data) {
    global $db;   
	$query = "UPDATE evento SET dataOcorrencia='$data' WHERE eid=$eid";
	$stmt = $db->prepare($query);
	$stmt->execute();  
  }
  
  function editEventLocalizacao($eid, $data) {
    global $db;   
	$query = "UPDATE evento SET localizacao='$data' WHERE eid=$eid";
	$stmt = $db->prepare($query);
	$stmt->execute();  
  }
  
  function editEventDescricao($eid, $data) {
    global $db;   
	$query = "UPDATE evento SET descricao='$data' WHERE eid=$eid";
	$stmt = $db->prepare($query);
	$stmt->execute();  
  }
  
  function editEventFotografia($eid, $data) {
    global $db;   
	$query = "UPDATE evento SET fotografia='$data' WHERE eid=$eid";
	$stmt = $db->prepare($query);
	$stmt->execute();  
  }
  
  function editEventTempo($eid, $data) {
    global $db;   
	$query = "UPDATE evento SET tempo='$data' WHERE eid=$eid";
	$stmt = $db->prepare($query);
	$stmt->execute();  
  }
  
  

  function addParticipant($participante, $evento) { // Novo participante
	global $db;   
    $stmt = $db->prepare('INSERT INTO participa VALUES (?,?, 1)');
	
	if (checkParticipa($participante, $evento) != null) {
		return 0;
	}
	
	if (checkInvited($participante, $evento) != null) {
		removeGuest($participante, $evento);
	}
	
    return $stmt->execute(array($participante, $evento));  
  }
  
  function removeParticipant($participante) { // Remover participante
	global $db;   
    $stmt = $db->prepare('UPDATE participa SET estado=0 WHERE uid=?');
    return $stmt->execute(array($participante));  
  }
  
 function getOrganiza($id) { // Eventos organizados pelo id
	global $db;   
	$query ="SELECT * FROM evento WHERE uid ='$id' AND dataOcorrencia > date('now') ";
    $stmt = $db->prepare($query);
	$stmt->execute();
	$result = $stmt->fetchAll();	
	header("Content-Type: application/json");
	echo json_encode($result);
  }
  
  function getUserId($name) {
	global $db;   
	$query ="SELECT uid FROM utilizador WHERE nome ='$name'";
    $stmt = $db->prepare($query);
	$stmt->execute();
	return $stmt->fetch();  
  }
  
  function checkInvited($uid, $eid) {
  	global $db;   
	$query ="SELECT * FROM convidado WHERE uid ='$uid' AND eid='$eid' AND estado='1'";
    $stmt = $db->prepare($query);
	$stmt->execute();
	return $stmt->fetch();
  }

  function checkParticipa($uid, $eid) {
  	global $db;   
	$query ="SELECT * FROM participa WHERE uid ='$uid' AND eid='$eid' AND estado='1'";
    $stmt = $db->prepare($query);
	$stmt->execute();
	return $stmt->fetch();
  }
  
  function getInvites($uid) {
	global $db;   
	$query ="SELECT evento.tema, convidado.eid, evento.dataOcorrencia FROM evento JOIN convidado ON convidado.eid = evento.eid WHERE convidado.uid ='$uid' AND convidado.estado = '1'";
    $stmt = $db->prepare($query);
	$stmt->execute();
	$result = $stmt->fetchAll();	
	header("Content-Type: application/json");
	echo json_encode($result);
	  
  }
  
  function addGuest($convidado, $evento) { // Adicionar convidado
	global $db;
	$username = getUserId($convidado);
	if (checkParticipa($username['uid'], $evento) != null) // Verifica se convidado já participa
		return 0;
	if (checkInvited($username['uid'], $evento) != null)
		return 0;
    $stmt = $db->prepare('INSERT INTO convidado VALUES (?,?, 1)');
    $stmt->execute(array($username['uid'], $evento));
	return 1;
  }
  
  function removeGuest($convidado, $evento) { // Remover convidado
	global $db;  
    $stmt = $db->prepare('UPDATE convidado SET estado=0 WHERE uid=? AND eid=?');
    $stmt->execute(array($convidado, $evento));  
  }
?>
