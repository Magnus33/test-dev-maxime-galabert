<?php
	try {
		$con = new PDO('mysql:host=localhost;dbname=testbko', 'root', '');
		$con->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
		$con->exec("SET NAMES 'utf8'");
	} catch (PDOException $e) {
		die('Erreur lors de la connexion: ' . $e->getMessage());
	}
?>
