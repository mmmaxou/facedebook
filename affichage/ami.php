<?php
// La page de gestion des amis.
// Amis, attente, invitation (les bannis on les aime pas, on les affiche pas)
// Formulaire d'acceptation/refus amitié
// formulaire de demande d'amitié


session_start();
include("../divers/connexion.php");
include("../divers/balises.php");

if(!isset($_SESSION['id'])) {
	// On n'est pas connecté, il faut retourner à la pgae de login
	header("Location:login.php");
}

include("entete.php");

echo "
    <title>Mes amis</title>
    </head>
    <body>
";

include("menu.php");

// Il faut faire des requêtes pour afficher ses amis, les attentes, les gens qu'on a invités qui ont pas répondu etc..
// Elles sont listées ci-dessous
    
    
// Connaitre les gens que l'on a invité et qui n'ont pas répondu : 
// SELECT utilisateur.* FROM utilisateur INNER JOIN lien ON utilisateur.id=idUtilisateur2 AND etat='attente' AND idUtilisateur1=?
// Paramètre 1 : le $_SESSION['id']
echo '<div class="ami">';
echo '<div id="profil">';
echo '</div>';
echo '<div id="main">';


echo '<h2>Demandes d\'ami(s) en attente : </h2><br/>';
$sql = "SELECT utilisateur.* FROM utilisateur INNER JOIN lien ON utilisateur.id=idUtilisateur2 AND etat='attente' AND idUtilisateur1=?";
$query = $pdo -> prepare($sql);
$query->execute( array( $_SESSION['id'] ) );

while ( $line = $query->fetch() ) {
//    renderArray($line);
    $link = 'mur.php?id='.$line['id'];    
    echo lien($link, renderArray($line['login']))."<br/>";
    
}
// Connaitre les gens qui nous ont invité et pour lequel on a pas répondu 
// SELECT utilisateur.* FROM utilisateur WHERE id IN(SELECT idUtilisateur1 FROM lien WHERE idUtilisateur2=? AND etat='attente'
// Paramètre 1 : le $_SESSION['id']

echo '<h2>Ces personnes vous ont demandées en ami : </h2>';

$sql = "SELECT utilisateur.* FROM utilisateur WHERE id IN 
        ( SELECT idUtilisateur1 FROM lien WHERE idUtilisateur2=? AND etat='attente' )";
$query = $pdo->prepare($sql);
$query->execute( array( $_SESSION['id'] ) );

while ( $line = $query->fetch() ) {
    
   
    
    renderArray($line ['login']);
        echo ' ';
    echo '<form action="../traitement/valideramitie.php" method="POST">';
    
    echo input('submit', 'reponse', array('value'=>'accepter'));
    echo input('submit', 'reponse', array('value'=>'refuser'));
    echo input('hidden', 'id', array('value'=>$line['id']));
    
    echo '</form>';
    
}




// Connaitre ses amis : SELECT * FROM utilisateur WHERE id IN (SELECT )
// SELECT utilisateur.* FROM utilisateur INNER JOIN lien ON idUtilisateur1=utilisateur.id AND etat='ami' AND idUTilisateur2=? UNION SELECT utilisateur.* FROM utilisateur INNER JOIN lien ON idUtilisateur2=utilisateur.id AND etat='ami' AND idUTilisateur1=?
// Les deux paramètres sont le $_SESSION['id']
    
echo "<br/><h2>Votre liste d'ami(s) :</h2><br/>";

$sql = "SELECT utilisateur.* FROM utilisateur INNER JOIN lien ON idUtilisateur1=utilisateur.id AND etat='ami' AND idUTilisateur2=? UNION SELECT utilisateur.* FROM utilisateur INNER JOIN lien ON idUtilisateur2=utilisateur.id AND etat='ami' AND idUTilisateur1=?";
$query = $pdo->prepare($sql);
$query->execute(array($_SESSION['id'], $_SESSION['id']));



while ( $line = $query->fetch() ) {
    echo "<a href='mur.php?id=".$line['id']."' >";
    renderArray( $line['login'] );
    echo "</a>";
}

echo '</div>';
echo '<div id="spacer"></div>';
?>



<?php

include("pied.php");
?>