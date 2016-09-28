<?php

//mur ok
//ami ok
//deco ok
//recherche

$mur = "mur.php?id=".$_SESSION['id'];
echo lien($mur, "Mon mur"). "   ";
echo lien("ami.php", "Mes amis");

?>



<form method="get" action="../traitement/deconnexion.php">
    <input type="submit" name="action" value="deconnexion"> 
</form>

<form method="post" action="../traitement/demanderamitie.php">
    Ajouter un ami
    <input type="text" name="id" placeholder="L'id de la personne" required>
    <input type="submit" value="valider">
</form>