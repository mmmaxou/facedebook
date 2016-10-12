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
$sql = "SELECT idAmi, idAuteur FROM ecrit WHERE id=?";
$query = $pdo->prepare($sql);
$query -> execute(array($_GET['id']));

$line = $query->fetch();

$ok = false;
if(isset($_GET['id'])  && is_numeric($_GET['id'])){
    if($line['idAuteur'] == $_SESSION['id']){// on check si c'est l'utilisateur qui possède le mur
        $ok = true;
        
    }
    // On check si c'est un utilisateur qui a écrit sur le mur de quelqu'un
    if($line['idAmi'] == $_SESSION['id']){
        $ok = true;
    }
    
}
if ( $ok ) {
    
    $sql = "SELECT * FROM ecrit WHERE id=?";
    $query = $pdo -> prepare($sql);
    $query->execute(array($_GET['id']));
    
    $line = $query -> fetch();
    
    unlink('../uploads/'.$line['image']);
    
    $sql = "DELETE FROM ecrit WHERE id=?";
    $query = $pdo -> prepare($sql);
    $query->execute(array($_GET['id']));
}

// A la fin on retourne d'où on vient
header("Location:".$_SERVER['HTTP_REFERER']);

?>