<?php

//mur ok
//ami ok
//deco ok
//recherche ok

$mur = "mur.php?id=".$_SESSION['id'];

$sql = "SELECT * FROM utilisateur WHERE id=?";
$query = $pdo->prepare($sql);
$query->execute( array( $_SESSION['id'] ) );
$line = $query->fetch();


echo "<div class='menu'><ul>";
echo "<li>".lien("mur.php?id=".$_SESSION['id'],"Bonjour ".$line['login'])."</li>";
echo item(lien("ami.php", "Mes amis"));

?>


    
    <li>
        <form method="post" action="#">
            Rechercher un ami
            <input type="text" name="search" placeholder="Son pseudo" required>
            <input type="submit" value="valider">
        </form>
    </li>
    <li>
        <form method="get" action="../traitement/deconnexion.php">
            <input type="submit" name="action" value="deconnexion"> 
        </form>
    </li>
</ul>
</div>
<div class="container">


<?php

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