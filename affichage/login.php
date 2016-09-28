<?php
// La page du formulaire de login (il ressemble étrangement à celui de création de compte
// Le formulaire sera envoyé vers ../traitement/connexion.php


session_start();
include("../divers/connexion.php");
include("../divers/balises.php");





// Il faut faire des requêtes pour afficher ses amis, les attentes, les gens qu'on a invités qui ont pas répondu etc..
// Elles sont listées ci-dessous
// Connaitre ses amis : 

  
?>

<form action='../traitement/connexion.php' method='POST'>
    <input type='text' name='login'>
    <input type='password' name='pwd'>
    <input type='submit' value='Connexion'>
    Se souvenir de moi : 
    <input type='checkbox' name='remember'>
</form>
<br/>
<br/>

<form action='../traitement/login.php' method='POST'>
    Veuillez rentrer votre Login : 
    <input type='text' name='login'><br/>
    Tapez votre mdp
    <input type='password' name='password'></br>
    Encore fdp
    <input type='password' name='passwordConfirm'></br>
    <input type='submit' value='Connexion'>
</form>

<?php

include("pied.php");
?>