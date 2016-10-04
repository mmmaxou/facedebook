<?php
session_start();
include("../divers/connexion.php");
include("../divers/balises.php");

if(!isset($_SESSION['id'])) {
	// On n'est pas connecté, il faut retourner à la pgae de login
	header("Location:login.php");
}

// La requete de suppression d'un écrit (il faut le donner en get : DELETE FROM ecrit where id=?
// Le paramètre est le $_GET['id']
if(isset($_GET['idAuteur'])){
    if($_GET['idAuteur'] == $_SESSION['id']){
        $sql = "DELETE FROM ecrit WHERE idAuteur=?";
        $query = $pdo -> prepare($sql);
        $query->execute(array($_GET['idAuteur']));
    }
    $sql = "SELECT * FROM ecrit WHERE idAmi=?";
    $query = $pdo->prepare($sql);
    $query->execute(array($_GET['idAuteur']));
    $line = $query->fetch();
    
    if($_GET['idAuteur']== $line['idAmi']){
        $sql = "DELETE FROM ecrit WHERE idAuteur=?";
        $query = $pdo -> prepare($sql);
        $query->execute(array($_GET['idAuteur']));
    }
}

// A la fin on retourne d'où on vient
header("Location:".$_SERVER['HTTP_REFERER']);

?>