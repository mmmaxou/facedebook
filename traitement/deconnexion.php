<?php
// Celui la aussi ressemble au TP4
if(isset($_GET['action']) && $_GET['action'] == "deconnexion"){
    session_destroy();
    $_SESSION = array();
    session_register_shutdown();
    setcookie('login','',time()-3600);
    header('Location:../affichage/login.php');
}
?>