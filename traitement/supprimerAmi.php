<?php
session_start();
include("../divers/connexion.php");
include("../divers/balises.php");

if(isset($_GET['id']) & is_numeric($_GET['id'])){
    $sql = "UPDATE lien SET etat='banni' WHERE (idUtilisateur1=? AND idUtilisateur2=?) OR (idUtilisateur1=? AND idUtilisateur2=?)";
    $query = $pdo->prepare($sql);
    renderArray($_SESSION);
    $query->execute(array($_GET['id'],$_SESSION['id'],$_SESSION['id'],$_GET['id']));   
}
else{
    echo "ERREUR";
    
}
 
header("Location:".$_SERVER['HTTP_REFERER']);

?>