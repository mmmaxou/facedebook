<?php
session_start();

include("../divers/connexion.php");
include("../divers/balises.php");

if(!isset($_SESSION['id'])) {
	// On n'est pas connecté, il faut retourner à la pgae de login
	header("Location:login.php");
}

// La requete de demande de creation amitie : UPDATE lien set etat=? INTO lien WHERE idUtilisateur1=? and idUtilisateur2=?
// Le premier paramètre de la requête la valeur banni si on veut pas ou la valeur ami si on est d'accord
// Le second paramètre de la requête est le $_POST['id'] : celui a qui on repond
// Le troisieme paramètre de la requête est le SESSION['id'] : celui qui répond à la demande d'amitié

renderArray($_POST);
renderArray($_SESSION);

if ( $_POST['reponse'] == "accepter") $reponse = "ami";
if ( $_POST['reponse'] == "refuser") $reponse = "banni";

$sql = "UPDATE lien set etat=? WHERE idUtilisateur1=? and idUtilisateur2=?";
$query = $pdo->prepare($sql);
$query->execute( array($reponse, $_POST['id'], $_SESSION['id']) );

// A la fin, on retourne a la page de login
header("Location:../affichage/ami.php");
?>