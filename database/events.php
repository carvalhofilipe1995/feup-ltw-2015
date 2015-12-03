<?php
  function getEvent() { // Todos eventos públicos
    global $db;   
    $stmt = $db->prepare('SELECT * FROM evento WHERE tipo=0');
    $stmt->execute();  	
    return $stmt->fetchAll();
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
  
  function addParticipant($participante, $evento) { // Novo participante
	global $db;   
    $stmt = $db->prepare('INSERT INTO participa VALUES (?,?, 1)');
	
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
  
 function getOrganiza($id) {
	global $db;   
	$query ="SELECT eid, tema FROM evento WHERE uid ='$id' AND dataOcorrencia > date('now') ";
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
    $stmt = $db->prepare('INSERT INTO convidado VALUES (?,?, 1)');
	$username = getUserId($convidado);
    $stmt->execute(array($username['uid'], $evento));  
  }
  
  function removeGuest($convidado, $evento) { // Remover convidado
	global $db;  
    $stmt = $db->prepare('UPDATE convidado SET estado=0 WHERE uid=? AND eid=?');
    $stmt->execute(array($convidado, $evento));  
  }
?>
