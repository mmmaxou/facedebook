<?php
session_start();
//Celui la ressemble au TD4 exo 3. 
// A vous l'honneur


// Si ça marche on est redirigé vers son mur


header("Location:mur.php?id=".$_SESSION['id']);
?>