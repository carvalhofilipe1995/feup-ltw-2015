<?php
  function checkUser($username, $password) { // Verifica password, retorna id, se NULL = falso
    global $db;
    $stmt = $db->prepare('SELECT uid FROM utilizador WHERE nome = ? AND password = ?');
    $stmt->execute(array($username, $password));  
    return $stmt->fetch();
  }
  
   function addUser($username, $password, $bday, $email) { // Novo utilizador
    global $db;
	
	$stmt = $db->prepare('SELECT max(uid) FROM utilizador');
	$stmt->execute();
	$uid = $stmt->fetch();
	$uid['max(uid)']++;
	$link = 'photo/u'.$uid['max(uid)'].'.jpg';
	
    $stmt = $db->prepare('INSERT INTO utilizador VALUES (NULL,?,?,?,?,?)');
    if($stmt->execute(array($username, $password, $link, $bday, $email))){
		 return $uid['max(uid)'];
	}	
    else
		return null;
  }
  
?>