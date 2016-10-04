<?php
session_start();

include("../divers/connexion.php");
include("../divers/balises.php");

if(!isset($_SESSION['id'])) {
	// On n'est pas connecté, il faut retourner à la pgae de login
	header("Location:login.php");
}


// Ecrire un message
if(isset($_POST['statut'])){
    $sql = "INSERT INTO ecrit VALUES(NULL,?,?,?,NULL,?,?)";
    $query =$pdo->prepare($sql);
    $query -> execute(array($_POST['titre'],$_POST['statut'],date("Y-m-d h:i:s  "),$_SESSION['id'],$_POST['id']));
    
    header("Location:../affichage/mur.php?id=".$_POST['id']);
}


?>