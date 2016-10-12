<?php
session_start();

include("../divers/connexion.php");
include("../divers/balises.php");
include("../divers/Security.php");
include("../divers/Upload.php");

if(!isset($_SESSION['id'])) {
	// On n'est pas connecté, il faut retourner à la pgae de login
	header("Location:login.php");
}


renderArray($_POST);

// Ecrire un message
if(isset($_POST['statut'])){
    $sql = "UPDATE ecrit
    SET titre = ?
    , contenu = ?
    WHERE id = ?";
    $query =$pdo->prepare($sql);
    $query -> execute(array($_POST['titre'], $_POST['statut'], $_POST['id-well']));
}

if(isset($_POST['del'])){
    $sql = "UPDATE ecrit
    SET image = NULL
    WHERE id = ?";
    $query =$pdo->prepare($sql);
    $query -> execute(array($_POST['id-well']));
}

header('Location:'.$_SERVER['HTTP_REFERER']);
?>