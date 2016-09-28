<?php
session_start();
include("../divers/connexion.php");
include("../divers/balises.php");

if(!isset($_SESSION['id'])) {
	// On n'est pas connecté, il faut retourner à la pgae de login
	header("Location:login.php");
}

include("entete.php");

if(!isset($_GET['id']) || !is_numeric($_GET['id'])) {
	// On n a pas donné le numéro de l'id de la personne dont on veut afficher le mur.
	// On affiche un message et on meurt
	echo "Bizarre !!!!";die(1);
}

// On affiche le menu
include("menu.php");


// On veut affchier notre mur ou celui d'un de nos amis et pas faire n'importe quoi 

$ok = false;
if($_GET['id']==$_SESSION['id']) {
	$ok = true; // C notre mur, pas de soucis
} else {
	// Verifions si on est amis avec cette personne
	$sql = "SELECT * FROM lien WHERE etat='ami' 
		AND ((idUtilisateur1=? AND idUtilisateur2=?) OR ((idUtilisateur1=? AND idUtilisateur2=?)))";

	// les deux ids à tester sont : $_GET['id'] et $_SESSION['id']		
	// A completer. Il faut récupérer une ligne, si il y en a pas ca veut dire que l'on est pas ami avec cette personne
    
    $query=$pdo->prepare($sql);
    $query->execute( array($_GET['id'], $_SESSION['id'], $_SESSION['id'], $_GET['id']));
    
    $line = $query->fetch();
    
    if ( $line == false ) {
        $ok = false;
    }

}
if($ok==false) {
	echo "Vous n'êtes pas encore ami, vous ne pouvez voir son mur !!";
	die(1);
}

// Tout va bien, il maintenant possible d'afficher le mur en question.
// A completer
// Requête de sélection des éléments d'un mur
// SELECT * FROM ecrit WHERE idAmi=?
// le paramètre  est le $_GET['id']

$sql = "SELECT * FROM ecrit WHERE idAmi=?";
$query=$pdo->prepare($sql);
$query->execute(array($_GET['id']));

while ($line = $query->fetch()) {

    $sql = "SELECT * FROM utilisateur WHERE id=".$line["idAuteur"];
    $query = $pdo->prepare($sql);
    $query->execute();
    $auteur = $query->fetch();
    
    afficherPost( $line, $auteur );
    
}

function afficherPost( $data, $auteur) {
    echo "<fieldset>";
    
    echo $data["titre"]."<br/>";
    echo $data["contenu"]."<br/>";
    echo $data["dateEcrit"]."<br/>";
    echo "auteur : ".$auteur["login"]."<br/>";
    
    if (isset($data['image'])) {
        echo "il y a une image";
    } else {
        echo "il n'y a pas d'image";
    }
    
    echo "</fieldset>";
    
}


?>

<?php
// On termine par le pied de page

include("pied.php");


?>