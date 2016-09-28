<?php
// Script connexion.php utilisé pour la connexion à la BD

ini_set('display_errors', 1);ini_set('display_startup_errors', 1);error_reporting(E_ALL);

$host="ipabdd"; // le chemin vers le serveur (localhost dans 99% des cas)

$db="maximilienpluchard"; // le nom de votre base de données.
            // A l IUT, 3 possibilité prenomnom prenomnom1... 

$user="maximilien.pluch"; // nom d utilisateur pour se connecter
              // A l iut prenom.nom	

$passwd="h7IopQ9V"; // mot de passe de l utilisateur pour se connecter
            // A l iut, généré automatiquement

try {
	// On essaie de créer une instance de PDO.
	$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $passwd,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}  
catch(Exception $e) {
	echo "Erreur : ".$e->getMessage()."<br />";
}

?>