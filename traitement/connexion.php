<?php
    session_start();
    include("../divers/connexion.php"); //on include la connexion à la BDD
    //on check si y'a déjà un cookie, si oui on le regarde
    if(!isset($_SESSION['id']) && isset($_COOKIE['login'])){
        $sql = "SELECT * FROM utilisateur WHERE hash=?";
        $query = $pdo->prepare($sql);
        $query -> execute(array($_COOKIE['login']));
        $line = $query-> fetch();
        if($line == false)
            header("Location:connexion.php");
        $_SESSION['id'] = $line['id'];
        $_SESSION['login'] = $line['login'];
        
    }

    // si le formulaire est soumis on check si le mec fait partit de la BDD
    if(isset($_POST['login'])){
        $sql = "SELECT * FROM user WHERE login=? AND=md5(?)";
        $query = $pdo -> prepare($sql);
        $query -> execute(array($_POST['login'],$_POST['pwd']));   
        $line = $query->fetch();
        if($line == false)
            header("Location:connexion.php");
        $_SESSION['id']= $line['id'];
        $_SESSION['login'] = $line['login'];
        //si la case remember est cochée, on set un cookie 
        if(isset($_POST['remember'])){
            $u = uniqid();
            setcookie('login',$u,time()+3600*24*7);
            $sql = "UPDATE utilisateur set hash=? WHERE id=?";
            $query = $pdo-> prepare($sql);
            $query ->execute(array($u,$line['id']));
            
        }
    }
    


    // Si ça marche on est redirigé vers son mur


   // header("Location:mur.php?id=".$_SESSION['id']);
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Connectez vous sur InkarmaCorp</title>
    </head>
    <body>
        <?php
            if(isset($_SESSION['id'])){
                echo "C'est bon t'es log bitch et tu t'appelles :".$_SESSION['login'];
            }else{
                echo "
                    <form action='#' method='POST'>
                        <input type='text' name='login'>
                        <input type='password' name='pwd'>
                        <input type='submit' value='Connexion'>
                        Se souvenir de moi : 
                        <input type='checkbox' name='remember'>
                
                    </form>
                ";
            }
            
        ?>
    </body>
</html>