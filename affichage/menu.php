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


echo "<div class='menu'><div class='wrapper-menu'><ul>";
echo item(lien("mur.php?id=".$_SESSION['id'],"Bonjour ".$line['login']), array('class'=>'link'));
echo item(lien("timeline.php","Timeline"),array('class'=>'link'));
echo item(lien("ami.php", "Mes amis"), array('class'=>'link'));

?>



<li>
    <form method="post" action="#">
        <div class="search">
            <input type="text" name="search" id="search_text" placeholder="Chercher un ami" required>
            <input type="submit" id="search_button" value="valider">
        </div>
    </form>
</li>
<li>
    <form method="get" action="../traitement/deconnexion.php">
        <input type="submit" id="deconnexion" name="action" value="deconnexion"> 
    </form>
</li>
</ul>
</div>
</div>
<div class="container-fluid">

    <?php

    //Requete de recherche des amis
    if ( isset($_POST['search']) ) {
        
        echo '<div class="recherche-ami">';
        echo '<p>Recherche d\'amis</p>';

        $search = $_POST['search'];
        $sql = "SELECT * FROM utilisateur WHERE login LIKE '%".$search."%'";
        $query = $pdo->prepare($sql);
        $query -> execute();

        while ( $line = $query->fetch() ) {

            echo lien("mur.php?id=".$line['id'], $line['login']).'<br>';

        }
    }

    ?>
    </div>