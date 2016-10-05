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

renderArray($_POST);


//Requete de recherche des amis
if ( isset($_POST['search']) ) {
    
    $search = $_POST['search'];
    $sql = "SELECT * FROM utilisateur WHERE login LIKE '%".$search."%'";
    $query = $pdo->prepare($sql);
    $query -> execute();
    
    while ( $line = $query->fetch() ) {
        
        echo lien("mur.php?id=".$line['id'], $line['login']);
        
    }
}
    
?>



<form method="get" action="../traitement/deconnexion.php">
    <input type="submit" name="action" value="deconnexion"> 
</form>

<form method="post" action="#">
    Rechercher un ami
    <input type="text" name="search" placeholder="Son pseudo" required>
    <input type="submit" value="valider">
</form>