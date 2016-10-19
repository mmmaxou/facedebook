<?php
session_start();
include("../divers/connexion.php");
include("../divers/balises.php");
include("../divers/agoTimeFormat.php");


if(!isset($_SESSION['id'])) {
    // On n'est pas connecté, il faut retourner à la pgae de login
    header("Location:login.php");
}

include("entete.php");

echo "<title>Timeline de ".$_SESSION['login']."</title>
      </head><body>";

include("menu.php");


// On affiche le menu
//include("menu.php");
echo '<div class="mur">';

echo '<div id="profil">';
echo '</div>';
echo '<div id="main">';


echo "<div class='timeline'>";
// on veut afficher tous les posts des gens qui sont amis avec nous

echo "<div class='posts'>";


//On selectionne les personnes amies avec l'utilisateur connecté

$sql = "SELECT ecrit.*,utilisateur.login FROM ecrit JOIN utilisateur ON idAuteur=utilisateur.id where idAmi=? OR (idAmi IN (SELECT idUtilisateur2 FROM lien WHERE idUtilisateur1=?)) OR ((idAmi IN (SELECT idUtilisateur1 FROM lien WHERE idUtilisateur2=?))) ORDER BY dateEcrit DESC";

$query= $pdo->prepare($sql);
$query ->execute(array($_SESSION['id'],$_SESSION['id'],$_SESSION['id']));

while($line = $query->fetch()){
    //$requete = "SELECT login FROM utilisateur WHERE id=?";
    //$query2=$pdo->prepare($requete);
    //$query2->execute(array($line['idAuteur']));
    $auteur = $line['login'];//$query2->fetch();
    afficherPost($line,$auteur);
}

 function afficherPost( $data, $auteur) {
    echo "<div class='well' id='well".$data['id']."'>";

    echo "<h3>".htmlspecialchars($data["titre"])."</h3><br/>";
     
     echo "<div class='content'>";
    echo "<p class='texte'>".htmlspecialchars($data["contenu"])."</p>";    
    if (isset($data['image'])) {
        echo "<img src='../uploads/".$data['image']."' alt='".$data['image']."'><br/>";
    }
    echo "</div>"; // Fermeture de div 'content'
     
    $time_added =$data['dateEcrit']; 
     // $notifies['date_time'] some sql datebase time
    echo $converted_time = AgoTimeFormat::makeAgo(strtotime($time_added)); 
     

     
    echo "<p class='sous-texte'>Ecrit par <a href='mur.php?id=".$data['idAuteur']."'>".$auteur."</a>";
   
     if ( $data['idAuteur'] == $_SESSION['id'] ) {     
        echo lien("","E | Editer",array('class'=>'gestion', 'data-toggle'=>'modal','id'=>$data['id'],'onClick'=>'editer(this)'));
        echo lien("../traitement/effacer.php?id=".$data['id'],"X | Supprimer",array('class'=>'gestion'));

    }

    echo "</p>";
    echo "</div>";

}
echo '
<div id="texte-modal" class="modal fade" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
     <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editer un post</h4>
      </div>
      <form action="../traitement/editer.php" method="post">
      <div class="modal-body">
        <input type="text" name="titre">
        <textarea name="statut" style="resize: vertical;"></textarea><br/>
        <label>Supprimer l\'image </label>
        <input type="checkbox" name="del" value="del">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-default" value="edit">Modifier</button>
        <input type="hidden" name="id-well">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </form>
</div>

</div>
</div>';
    echo '</div></div></div><div id="spacer"></div>';
    include("pied.php");
?>    