<?php
	//on ce connecte en PDO as la base
	$user='root';
	$mdp='';
	$chemin='mysql:host=localhost;dbname=facturem2l';
	try{
		$dbh= new PDO($chemin,$user,$mdp);
	}catch (PDOException $e){
		print "Erreur! :".$e->getMessage()."</br>";
		die();
	}
?>
