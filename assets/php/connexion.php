<?php
	$serveur='localhost';
	$bdd='api_challenge2016';
	$utilisateur='root';
	$mdp= '';
	$options=array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

	try{
		$connexion = new PDO("mysql:host=$serveur;dbname=$bdd", $utilisateur, $mdp, $options);
	}
	catch(Exception $e){ 
		die('Connexion la base de données impossible !');
	}
 ?>
