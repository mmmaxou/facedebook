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


if(isset($_GET['id']) && isset($_GET['idAuteur']) && isset($_GET['idAmi']) && is_numeric($_GET['id']) && is_numeric($_GET['idAuteur']) && is_numeric($_GET['idAmi']) ){
    if($_GET['idAuteur'] == $_SESSION['id']){// on check si c'est l'utilisateur qui possède le mur
        $sql = "DELETE FROM ecrit WHERE id=?";
        $query = $pdo -> prepare($sql);
        $query->execute(array($_GET['id']));
        
    }
    
    // On check si c'est un utilisateur qui a écrit sur le mur de quelqu'un
    if($_GET['idAmi']== $_SESSION['id']){
        $sql = "DELETE FROM ecrit WHERE idAmi=? AND id=?";
        $query = $pdo -> prepare($sql);
        $query->execute(array($_GET['idAmi'],$_GET['id']));
    }
    
}

// A la fin on retourne d'où on vient
header("Location:".$_SERVER['HTTP_REFERER']);

?>