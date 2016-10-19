<?php
// La page du formulaire de login (il ressemble étrangement à celui de création de compte
// Le formulaire sera envoyé vers ../traitement/connexion.php


session_start();
include("../divers/connexion.php");
include("../divers/balises.php");
include("entete.php");

echo "
    <title>Vapor-Book </title>
    </head>
    <body>
";



// Il faut faire des requêtes pour afficher ses amis, les attentes, les gens qu'on a invités qui ont pas répondu etc..
// Elles sont listées ci-dessous
// Connaitre ses amis : 

  
?>
<div class="container">
   
   
    <div class='wrapperConnexion'>
        <form action='../traitement/connexion.php' method='POST' >
           <table id="formConnexion">
               <tr>
                   <td colspan="2"><h3>Se connecter</h3></td>
               </tr>
               <tr>
                    <td>Votre login : </td>
                    <td><input type='text' name='login' placeholder="Login"></td>
               </tr>
               <tr>
                  <td>Votre mot de passe : </td>
                   <td><input type='password' name='pwd' placeholder="Mot de passe"></td>
               </tr>
               <tr>
                   <td>
                       Se souvenir de moi : 
                   </td>
                   <td>
                       <input type='checkbox' name='remember'>
                   </td>
               </tr>
               <tr>
                   <td colspan="2"><input type='submit' value='Connexion'></td>
               </tr>
           </table>
            
            
            
        </form>
    </div>


    <div class='wrapperConnexion'>
        <form action='../traitement/creercompte.php' method='POST' >
           <table id="formInscription">
               <tr>
                   <td colspan="2"><h3>S'inscrire</h3></td>
               </tr>
               <tr>
                   <td>Login :</td>
                   <td><input type='text' name='login'><br/></td>
               </tr>
               <tr>
                   <td>
                        Mot de Passe :
                   </td>
                   <td>
                      <input type='password' name='password'><br/> 
                   </td>
               </tr>
               <tr>
                   <td>
                      Verification : 
                   </td>
                   <td>
                       <input type='password' name='passwordConfirm'><br/>
                   </td>
               </tr>
               <tr>
                   <td colspan="2"><input type='submit' value='Inscription'></td>
               </tr>
           </table>
     </form>
   </div>

<?php

include("pied.php");
?>