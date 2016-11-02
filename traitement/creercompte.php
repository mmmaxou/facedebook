<?php
session_start();
include("../divers/connexion.php");
include("../divers/balises.php");


// La requete de création de compte : INSERT INTO utilisateur VALUES(NULL,?,?)
// Le premier parametre de la requête est le login
// Le second parametre de la requete est le mot de passe
renderArray($_POST);
if(isset($_POST['login'])){
    $sql = "SELECT login FROM utilisateur WHERE login=?";
    $query = $pdo->prepare($sql);
    $query ->execute(array($_POST['login']));
    if($query -> fetch() != 0){
        header("Location:../affichage/login.php");
    
    }
    else{
        if(isset($_POST['password']) && isset($_POST['passwordConfirm']) && $_POST['password'] == $_POST['passwordConfirm']){
            $sql = "INSERT INTO utilisateur VALUES(NULL,?,md5(?),NULL)";
            $query = $pdo->prepare($sql);
            $query -> execute(array($_POST['login'],$_POST['password']));
            
           
            $sql = "SELECT * FROM utilisateur WHERE login=?";
            $query = $pdo-> prepare($sql);
            $query -> execute(array($_POST['login']));
            $line = $query->fetch();
            
            //rédiger les sessions id login
            $_SESSION['id'] = $line['id'];
            $_SESSION['login'] = $_POST['login'];
            header("Location:../affichage/mur.php?id=".$_SESSION['id']);
        }
    }
    
    
}


// Ca serait bien d'être loggé !
// A la fin on retourne à la page d'amitié :  il faut bien se faire des amis !
//header("Location:../affichage/mur.php");
?>