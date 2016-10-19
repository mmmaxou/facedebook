<?php
session_start();

include("../divers/connexion.php");
include("../divers/balises.php");
include("../divers/Security.php");
include("../divers/Upload.php");
date_default_timezone_set("Europe/Paris");

if(!isset($_SESSION['id'])) {
	// On n'est pas connecté, il faut retourner à la pgae de login
	header("Location:login.php");
}


renderArray($_POST);
renderArray($_FILES);

function up() {
    
    $config['upload_path'] = '../uploads';
    $config['allowed_types'] = '*';
    
    $upload = new Upload($config);

    renderArray($upload);
    
    if ($upload->do_upload('imageStatut')) {
        echo "ok";
        return $upload->file_name;
    } else {
        echo "nonono";
        
        return false;
    }
    
}

// Ecrire un message
if(isset($_POST['statut']) || isset($_FILES['imageStatut'])){
    $f = up();
    
    echo $f == false ? "oui" : "non";
    
    $file = $f ? $f : null;
    $sql = "INSERT INTO ecrit VALUES(NULL,?,?,?,?,?,?)";
    $query =$pdo->prepare($sql);
    
    $query -> execute(array($_POST['titre'],$_POST['statut'],date("Y-m-d h:i:s  "),$file,$_SESSION['id'],$_POST['id']));
}

//header('Location:'.$_SERVER['HTTP_REFERER']);
?>