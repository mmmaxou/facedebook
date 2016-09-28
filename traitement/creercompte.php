<?php
session_start();
include("../divers/connexion.php");
include("../divers/balises.php");


// La requete de création de compte : INSERT INTO utilisateur VALUES(NULL,?,?)
// Le premier parametre de la requête est le login
// Le second parametre de la requete est le mot de passe
if(isset($_POST['login'])){
    if(isset($_POST['password']) && isset($_POST['passwordConfirm']) && $_POST['password'] == $_POST['passwordConfirm']){
        $sql = "INSERT INTO utilisateur VALUES(NULL,?,md5(?)";
        $query = $pdo->prepare($sql);
        $query -> execute(array($_POST['login'],$_POST['password']));
    }
}


// Ca serait bien d'être loggé !
// A la fin on retourne à la page d'amitié :  il faut bien se faire des amis !
header("Location:affichage/mur.php");
?>