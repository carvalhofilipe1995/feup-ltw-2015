<?php
    $db;
    if ($db = new PDO('sqlite:ltw.db')){
	}
	else {
		echo "Connection failed<br>";
	}
?>