<?php
  function checkUser($username, $password) { // Verifica password, retorna id, se NULL = falso
    global $db;
    $stmt = $db->prepare('SELECT uid FROM utilizador WHERE nome = ? AND password = ?');
    $stmt->execute(array($username, $password));  
    return $stmt->fetch();
  }
  
   function addUser($username, $password, $link, $bday, $email) { // Novo utilizador
    var_dump($username, $password, $link, $bday, $email);
    global $db;
    $stmt = $db->prepare('INSERT INTO utilizador VALUES (NULL,?,?,?,?,?)');
    if($stmt->execute(array($username, $password, $link, $bday, $email))){
		$stmt = $db->prepare('SELECT uid FROM utilizador WHERE nome= ? and password = ?');
		 $stmt->execute(array($username, $password));  
		 return $stmt->fetch();
	}	
    else
		return null;
  }
  
?>