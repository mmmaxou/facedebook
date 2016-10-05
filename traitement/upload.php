<?php

$maxSize = 4000000; // Taille maximale pour une image 

if(isset($_FILES['imageStatut'])){
    if($_FILES['imageStatut']['error']>0){
        header("Location:".$_SERVER['HTTP_REFERER']);
    }
    if($_FILES['imageStatut']['size'] > $maxSize){
        header("Location:".$_SERVER['HTTP_REFERER']);
    }
    $dossierUpload = '../imgUploaded';
    $uploadSuccess = move_uploaded_file($_FILES['imageStatut']['tmp_name'],)
}



?>