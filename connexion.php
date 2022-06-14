<?php

require "constants.php";
require "functions.php";
//partie haute commune à toutes les pages
require "partie_commune_haute.php";


//VERIFICATION DES CHAMPS SAISIES 


if(isset($_POST['submit'])){

    $bdd = connectBDD( NAMEBDD, ROOT, HOST, MDPBDD );

    $email= $_POST['email'];

    $req = $bdd->prepare('SELECT id_u,civ,lastName,firstName ,mdp FROM users WHERE email = :email');
    $req->execute(array(
        'email' => $email));
    $resultat = $req->fetch();


    // Comparaison du pass envoyé via le formulaire avec la base
    $isPasswordCorrect = password_verify($_POST['password'], $resultat['mdp']);

    if (!$resultat)
    {
         echo "<div class=\"bg-danger text-white font-weight-bold text-center overflow\"><h5>
               Mauvais email ou mot de passe !</h5></div>"; 

    }
    else
    {
        if ($isPasswordCorrect) {
            session_start();
            //****///
            $_SESSION['id_u']=$resultat['id_u'];
        
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['lastName'] = $resultat['lastName'];
            $_SESSION['firstName'] = $resultat['firstName'];
            $_SESSION['civ'] = $resultat['civ'];

            $email=$_SESSION['email'];
            echo "<div class=\"bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow\">".
                $_SESSION['lastName']." ".$_SESSION['firstName']."</div>"; 
            //*******************recuperation de l'adresseU et du telU********************
            $req2 = $bdd->prepare( 'SELECT adresseU FROM users WHERE email = :email' );
            $req2->execute( array(
                'email' => $email ) );

            $result2 = $req2->fetch( PDO::FETCH_ASSOC );
            $adresseU = implode( "", $result2 );

            $_SESSION['adresseU']=$adresseU;
            /**************************telU******************/
            $req3 = $bdd->prepare( 'SELECT telU FROM users WHERE email = :email' );
            $req3->execute( array(
                'email' => $email ) );

            $result3 = $req3->fetch( PDO::FETCH_ASSOC );
            $adresseU = implode( "", $result3 );

            $_SESSION['telU']=$adresseU;
            //******************************************************************************
            header( "Location:index.php" );

        }
        else {
            echo "<div class=\"bg-danger text-white font-weight-bold text-center overflow\"><h5>
               Mauvais mot de passe !</h5></div>";
        }
    }

}

?>


<div class="bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow">

    <form class="form-signin" method="post" action="connexion.php">
        <div class="text-center mb-4">
            <br>
            <img src="img/profil.png" width="72" height="72">
            <br>
            <h1 class="h3 mb-3 font-weight-normal">Connexion :</h1>
        </div>

        <div class="form-label-group">
            <label for="inputEmail3">Email </label>
            <input type="email" id="inputEmail3" class="form-control" placeholder="Adresse e-mail" name="email" required autofocus>

        </div>
        <br>
        <div class="form-label-group">
            <label for="inputPassword3">Mot de passe</label>
            <input type="password" id="inputPassword3" class="form-control" placeholder="Mot de passe" name="password" required>

        </div>
        <br>

        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Connexion</button>
    </form>
    <br>
    <a class="btn btn-sm btn-outline-secondary" href="index.php">Retour</a> 
    <br><br>
</div>




<?php require "footer.php";  ?>
<style>
     .bg-light button {
        background-color: rgba(0, 0, 0, .85);
    }
</style>