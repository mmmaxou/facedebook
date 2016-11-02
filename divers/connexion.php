<?php
// Script connexion.php utilisé pour la connexion à la BD


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('Europe/Paris');
// MAXIMILIEN - IUT
/*
$host="ipabdd"; // le chemin vers le serveur (localhost dans 99% des cas)
$db="maximilienpluchard";
$user="maximilien.pluch";
$passwd="h7IopQ9V";
*/


//connexion en local 
$host="localhost"; 
$db="facebook"; 
$user="root";
$passwd=""; 


try {
	// On essaie de créer une instance de PDO.
	$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $passwd,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}  
catch(Exception $e) {
	echo "Erreur : ".$e->getMessage()."<br />";
}
?>