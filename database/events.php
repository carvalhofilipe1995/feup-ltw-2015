<?php
  function getEvent() { // Todos eventos públicos
    global $db;   
    $stmt = $db->prepare('SELECT * FROM evento WHERE tipo=0');
    $stmt->execute();  	
    return $stmt->fetchAll();
  }
  
  function getMyEvent($id) { // Os meus eventos
    global $db;    
    $stmt = $db->prepare('(SELECT * FROM participa WHERE id = ?) AB NATURAL JOIN (SELECT * FROM evento) CD');
    $stmt->execute(array($id));  
    return $stmt->fetchAll();
  }
  
  function addEvent($nome, $descricao, $localizacao, $link, $data, $tempo, $tipo, $id){ // Novo evento
	global $db;   
	$stmt = $db->prepare('INSERT INTO evento VALUES (NULL,?,?,?,?,?,?,?,?)');
    if($stmt->execute(array($nome, $descricao, $localizacao, $link, $data, $tempo, $tipo, $id))){
		$stmt = $db->prepare('SELECT eid FROM evento WHERE nome= ? AND localizcao= ? AND data=? AND uid = ?');
		 $stmt->execute(array($nome, $localizacao, $data, $id));  
		 return $stmt->fetch();
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
