<?php

//mur ok
//ami ok
//deco ok
//recherche

$mur = "mur.php?id=".$_SESSION['id'];
echo lien($mur, "Mon mur"). "   ";
echo lien("ami.php", "Mes amis");

$sql = "SELECT * FROM utilisateur WHERE id=?";
$query = $pdo->prepare($sql);
$query->execute( array( $_SESSION['id'] ) );
$line = $query->fetch();
echo '<h1>Session de '.$line['login'].'</h1>';

?>



<form method="get" action="../traitement/deconnexion.php">
    <input type="submit" name="action" value="deconnexion"> 
</form>

<form method="post" action="../traitement/demanderamitie.php">
    Ajouter un ami
    <input type="text" name="id" placeholder="L'id de la personne" required>
    <input type="submit" value="valider">
</form>