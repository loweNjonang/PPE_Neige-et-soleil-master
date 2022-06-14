<?php
session_start();
require "constants.php";
require "functions.php";
//partie haute commune à toutes les pages
require "partie_commune_haute.php";





if(isset($_SESSION['firstName']))
{
    $bdd = connectBDD( NAMEBDD, ROOT, HOST, MDPBDD );

    if(isset($_SESSION['numH'])){

        //***Insertion des informations du contrat_propriétaire dans la base de données**//

        $numH=$_SESSION['numH'];
        $idP=$_SESSION['idP'];

        $requete3 = $bdd->prepare( 'INSERT INTO contrat_proprietaire(numH ,idP) 
        VALUES(:numH ,:idP)' );

        $requete3->bindValue(':numH', $numH, PDO::PARAM_STR );
        $requete3->bindValue( ':idP', $idP, PDO::PARAM_STR );

        $requete3->execute();

        $_SESSION['IDContratP'] = $bdd->lastInsertId();
    }

    echo "<div class=\"bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow\">
                <div class=\"text-center mb-4\">
                    <br>
                    <h1 class=\"h3 mb-3 font-weight-normal\">Profil</h1>
                    <br>
                    <img src=\"img/profil.png\" width=\"92\" height=\"92\">
                    <br>
                </div>
                
                Nom et prenom : ".$_SESSION['civ'].". ".$_SESSION['lastName']." ".$_SESSION['firstName']."<br>".
                //Affiche l'adresse mail
                "Votre adresse email : ".$_SESSION['email']."<br>".
                //Affiche le lien pour modifier le mot de passe
                 "<a class=\"py-2 d-none d-md-inline-block\" href=modify_password.php>Modifier mon mot de passe</a>
        </div>";

}
else
{    
    echo "<div class=\"bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow\">
               Vous devez vous connecter ou bien vous inscrire pour accéder à votre compte !</div>";

}




//Footer commun à toutes les pages 
require "footer.php";  ?>
