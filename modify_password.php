<?php
session_start();
require "constants.php";
require "functions.php";
//partie haute commune à toutes les pages
require "partie_commune_haute.php";

//Modification du mot de passe dans la BDD
if(isset($_POST['submit']))
{

    $bdd = connectBDD( NAMEBDD, ROOT, HOST, MDPBDD );
    $email=$_SESSION['email'];

    //****verifier l'ancien mot de passe****/
    $req = $bdd->prepare("SELECT mdp FROM users WHERE email ='". $email."'");
    $req->execute(array(
        'email' => $email));
    $resultat = $req->fetch();

    // Comparaison du pass envoyé via le formulaire avec la base
    $isPasswordCorrect = password_verify($_POST['old_password'], $resultat['mdp']);


    if ($isPasswordCorrect) {

        //**********//
        $mdp=password_hash($_POST['new_password'], PASSWORD_DEFAULT);

        $requete = $bdd->query("UPDATE users SET mdp='".$mdp."' where email='".$email."'");
        if($requete)
        {
            echo "<div class=\"bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow\">
                Votre mot de passe a bien été modifié !
             </div>";
        }

    }else
    {
        echo "<div class=\"bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow\">
                Votre mot de passe actuel est incorrect !
             </div>";
    }

}
?>
<div class="bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow">
    <form class="form-signin" method="post" action="modify_password.php">
        <div class="text-center mb-4">
            <br>
            <img src="img/profil.png" width="72" height="72">
            <br>
            <h1 class="h3 mb-3 font-weight-normal">Modifier mon mot de passe :</h1>
        </div>
        <div class="form-label-group">
            <label for="inputPassword3">Mot de passe actuel</label>

            <input type="password" id="inputPassword3" class="form-control" placeholder="Mot de passe actuel" name="old_password" required>
        </div>
        <div class="form-label-group">
            <label for="inputPassword3">Nouveau mot de passe</label>

            <input type="password" id="inputPassword3" class="form-control" placeholder="Nouveau mot de passe" name="new_password" required>
        </div>
        <br>

        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Confirmer</button>
    </form>
    <br>
    <a class="btn btn-sm btn-outline-secondary" href="index.php">Retour</a>
</div>

<?php //Footer commun à toutes les pages 
require "footer.php";  ?>
