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

$map = array(
    "a" => '▲ ',
    "b" => '฿ ',
    "c" => '₵ ',
    "d" => 'Đ ',
    "e" => '☰ ',
    "f" => '₣ ',
    "g" => 'ğ ',
    "h" => 'Ħ ',
    "i" => 'ï ',
    "j" => '_| ',
    "k" => 'Ќ ',
    "l" => 'Ŀ ',
    "m" => '∇∇ ',
    "n" => '∩ ',
    "o" => '0 ',
    "p" => '₱ ',
    "q" => 'ℚ ',
    "r" => 'Я ',
    "s" => '$ ',
    "t" => '† ',
    "u" => '∪ ',
    "v" => '∀ ',
    "w" => 'Ш ',
    "x" => 'Ж ',
    "y" => '¥ ',
    "z" => 'ℤ '
);

    
function up() {
    
    $config['upload_path'] = '../uploads';
    $config['allowed_types'] = '*';
    
    $upload = new Upload($config);
    
    if ($upload->do_upload('imageStatut')) {
        return $upload->file_name;
    } else {        
        return false;
    }
    
}

function vaportexte( $texte, $map) {
    $letter;
    $vaportexte = "";
    
    for( $i=0 ; $i < strlen($texte) ; $i++ ) {
        $letter = $texte[$i];
        $letter = isset($map[$letter]) ? $map[$letter] : $letter;
        if ( isset($letter)) {
            $vaportexte .= $letter;
        }
    } 
    
    return $vaportexte;    
}

//Ecrire un message
if(isset($_POST['statut']) || isset($_FILES['imageStatut'])){
    $f = up();
    $texte = $_POST['statut'];
    
    if ( isset($_POST['vaportexte']) ) {
        $texte = vaportexte( $texte , $map);
    };
            
    $file = $f ? $f : null;
    $sql = "INSERT INTO ecrit VALUES(NULL,?,?,?,?,?,?)";
    $query =$pdo->prepare($sql);
    
    $query -> execute(array($_POST['titre'],$texte,date("Y-m-d h:i:s"),$file,$_SESSION['id'],$_POST['id']));
}

header('Location:'.$_SERVER['HTTP_REFERER']);
?>