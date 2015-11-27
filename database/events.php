<?php
  function getEvent() { // Todos eventos públicos
    global $db;   
    $stmt = $db->prepare('SELECT * FROM evento WHERE tipo=0');
    $stmt->execute();  	
    return $stmt->fetchAll();
  }
  
  function getMyEvent($id) { // Os meus eventos **********************************************************************************************
    global $db;    
    //$stmt = $db->prepare('SELECT tema, dataOcorrencia FROM evento JOIN participa ON participa.eid = evento.eid WHERE participa.uid=?');
	$stmt = $db->prepare('SELECT * from evento where uid=?');
	$stmt->execute(array($id));  
    $events = $stmt->fetchAll();
	$result = array();
	foreach ($events as $event) {
		//$result[] = $event['tema'];
		$result[] = $event['dataOcorrencia'];
		}
		echo json_encode($result);
  }
  
  function addEvent($nome, $descricao, $localizacao, $data, $tempo, $tipo, $id){ // Novo evento
	global $db;   
	
	$stmt = $db->prepare('SELECT max(eid) FROM evento');
	$stmt->execute();
	$eid = $stmt->fetch();
	$eid['max(eid)']++;
	$link = 'photo/e'.$eid['max(eid)'].'.jpg';
	
	$stmt = $db->prepare('INSERT INTO evento VALUES (NULL,?,?,?,?,?,?,?,?)');
    if($stmt->execute(array($nome, $descricao, $localizacao, $link, $data, $tempo, $tipo, $id))){
		 return $eid['max(eid)'];
		}
	else {
		return null;
		}
  }
  
  function addParticipant($participante, $evento){ // Novo participante
	global $db;   
    $stmt = $db->prepare('INSERT INTO participante VALUES (?,?)');
    return $stmt->execute(array($participante, $evento));  
  }
  
  function removeParticipant($participante){ // Remover participante
	global $db;   
    $stmt = $db->prepare('UPDATE participante SET estado=0 WHERE uid=?');
    return $stmt->execute(array($participante));  
  }
  
  function addGuest($convidado, $evento){ // Adicionar convidado
	global $db;
    $stmt = $db->prepare('INSERT INTO convidado VALUES (?,?)');
    return $stmt->execute(array($convidado, $evento));  
  }
  
  function removeGuest($convidado){ // Remover convidado
	global $db;  
    $stmt = $db->prepare('UPDATE convidado SET estado=0 WHERE uid=?');
    return $stmt->execute(array($convidado));  
  }
?>