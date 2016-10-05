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
echo '<div class="mur">';

$sql = "SELECT * FROM utilisateur WHERE id=?";
$query = $pdo->prepare($sql);
$query -> execute(array($_GET['id']));
$line = $query->fetch();

echo "<h1>Mur de ".$line['login']."</h1>";

$ok = false;
$etat = null;
if($_GET['id']==$_SESSION['id']) {
	$ok = true; // C notre mur, pas de soucis
} else {
	// Verifions si on est amis avec cette personne
	$sql = "SELECT * FROM lien WHERE etat='ami' 
		AND ((idUtilisateur1=? AND idUtilisateur2=?) OR (idUtilisateur1=? AND idUtilisateur2=?))";

	// les deux ids à tester sont : $_GET['id'] et $_SESSION['id']		
	// A completer. Il faut récupérer une ligne, si il y en a pas ca veut dire que l'on est pas ami avec cette personne
    
    $query=$pdo->prepare($sql);
    $query->execute( array($_GET['id'], $_SESSION['id'], $_SESSION['id'], $_GET['id']));
    
    $line = $query->fetch();
    
    if ( $line['etat'] != "ami" ) {
        $ok = false;
    } else {
        echo 'Vous etes amis';
        $ok = true;
    }

}
if($ok == false) {
	echo "Vous n'êtes pas encore ami, vous ne pouvez voir son mur !!<br/>";
    
    $sql = "SELECT * FROM lien WHERE (idUtilisateur1=? AND idUtilisateur2=?) OR (idUtilisateur1=? AND idUtilisateur2=?)";
    $query = $pdo->prepare($sql);
    $query -> execute(array($_GET['id'], $_SESSION['id'], $_SESSION['id'], $_GET['id']));
    
    $line = $query->fetch();
    $etat = $line['etat'];
    
    
    if ($etat == "attente") {
        echo "Invitation deja envoyée";
    } else if ($etat == "banni") {
        echo "L'utilisateur vous a banni";
    } else {
    echo "<a href='../traitement/demanderamitie.php?id=".$_GET['id']."'><input type='button' value='Demander en Ami'></a>";
    }	
    
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

while ($line = $query-> fetch() ) {
    
//    renderArray($line);
    
    $sql = "SELECT * FROM utilisateur WHERE id=?";
    $q = $pdo->prepare($sql);
    $q->execute(array($line["idAuteur"]));
    
    
    while ( $auteur = $q->fetch()) {
                
        afficherPost( $line, $auteur );
        
    } 
    
}

function afficherPost( $data, $auteur) {
    echo "<div class='well'>";
    
    echo $data["titre"]."<br/>";
    echo $data["contenu"]."<br/>";
    echo $data["dateEcrit"]."<br/>";
    echo "auteur : ".$auteur["login"]."<br/>";
    
    if (isset($data['image'])) {
        echo "il y a une image";
    } else {
        echo "il n'y a pas d'image";
    }
    
    echo lien("../traitement/effacer.php?id=".$data['id']," Supprimer");


    echo "</div>";

    
}


echo "<form action='../traitement/ecrire.php' method='POST' enctype='multipart/form-data'>";

echo "<form action='../traitement/ecrire.php' method='POST'>

        Entre ton titre enculé : <input type='text' name='titre' value='titre'>
        <textarea name='statut' style='resize:none' ></textarea><br/>
        <input type='submit' value='Poster'>
        <input type='hidden' name='id' value=".$_GET['id'].">
      </form>
    ";

echo "<form action='../traitement/uploader.php' method='POST' enctype='multipart/form-data'>
        <input type='file' name='imageStatut'>
        <input type='text' name='descriptionImageStatut'>
      </form>
    ";



echo '</div>';
// On termine par le pied de page

include("pied.php");


?>