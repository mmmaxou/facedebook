<?php
session_start();

include("../divers/connexion.php");
include("../divers/balises.php");

if(!isset($_SESSION['id'])) {
	// On n'est pas connecté, il faut retourner à la pgae de login
	header("Location:login.php");
}


// Ecrire un message
if(isset($_POST['statut'])){
    $sql = "INSERT INTO ecrit VALUES(NULL,?,?,?,NULL,?,?)";
    $query =$pdo->prepare($sql);
    $query -> execute(array($_POST['titre'],$_POST['statut'],date("Y-m-d h:i:s  "),$_SESSION['id'],$_POST['id']));
    
    $extensionsAutorisees = array("jpeg", "jpg", "png"); //extensions acceptées
    $fichierImport = $_FILES['imageStatut']['name']; //simplification du nom du fichier d'upload

    if(isset($fichierImport)){
        if(!(in_array($_FILES['type'],$extensionsAutorisees))){
            echo "C'est pas le bon type fdp";
            header("Location:../affichage/mur.php?id=".$_SESSION['id']);
        }
        else{
            $repertoireDeDepot = "../images";
        }
    }
}



// POST IMAGE 




/*
    <?php $time_added = \Helpers\AgoTimeFormat::convert_datetime( $notifies['date_time']); ?> // $notifies['date_time'] some sql datebase time <?php echo $converted_time = \Helpers\AgoTimeFormat::makeAgo($time_added); ?>
    
    https://github.com/geomorillo/Upload
    
    
$nomOrigine = $_FILES['pp']['name'];
$elementsChemin = pathinfo($nomOrigine);
$extensionFichier = $elementsChemin['extension'];



if (!(in_array($extensionFichier, $extensionsAutorisees))) {
    echo "Le fichier n'a pas l'extension attendue";
} 

else{    

    $repertoireDestination = dirname(__FILE__)."/photoprofil/";
    $nomDestination = "photo".$_SESSION['id'].".".$extensionFichier;

	if (move_uploaded_file($_FILES["pp"]["tmp_name"], $repertoireDestination.$nomDestination)) {
		$sqlinsert = "UPDATE utilisateur SET photo=? WHERE id=?";
		$queryinsert = $pdo->prepare($sqlinsert);
		$queryinsert ->execute(array($_SESSION['id'],$_SESSION['id']));

    	$_SESSION['photo'] = $_SESSION['id'];	
    	header("location:../affichage/mur.php?id=".$_SESSION['id']."");
	}

	else{
	    echo "Le fichier n'a pas été uploadé (trop gros ?)";
	}
}
*/
?>