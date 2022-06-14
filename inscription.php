<?php
session_start();
require "constants.php";
require "functions.php";
//partie haute commune à toutes les pages
require "partie_commune_haute.php";

//***Si l'utilisateur est connecté , il doit d'abord se deconnecter pour créer un autre compte
if (isset($_SESSION['firstName']))
    echo "<div class=\"bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow\">
              Vous devez d'abord vous déconnecter pour crée un autre compte</div>";

//************PARTIE VERIFICATION DE INFORMATIONS SAISIES**************//
$bdd = connectBDD( NAMEBDD, ROOT, HOST, MDPBDD );

if ( isset( $_POST['submit'] ) ) {
    //recuperation des informations
    $civ = $_POST['civ'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
    $adresseU = $_POST['adresseU'];
    $telU = $_POST['telU'];
    // crypte le mot de passe

    $requete = $bdd->prepare( 'INSERT INTO users(civ,lastName,firstName,email,mdp,adresseU,telU) VALUES(:civ,:lastName,:firstName,:email,:mdp,:adresseU,:telU)' );
    $requete->bindValue( ':civ', $civ, PDO::PARAM_STR );
    $requete->bindValue( ':lastName', $lastName, PDO::PARAM_STR );
    $requete->bindValue( ':firstName', $firstName, PDO::PARAM_STR );
    $requete->bindValue( ':email', $email, PDO::PARAM_STR );
    $requete->bindValue( ':mdp', $mdp, PDO::PARAM_STR );
    $requete->bindvalue( ':adresseU', $adresseU, PDO::PARAM_STR);
    $requete->bindvalue( ':telU', $telU, PDO::PARAM_STR);
    $requete->execute();

    $_SESSION['id_u'] = $bdd->lastInsertId();
    $_SESSION['civ'] = $civ;
    $_SESSION['firstName'] = $firstName;
    $_SESSION['lastName'] = $lastName;
    $_SESSION['email']= $email;
    $_SESSION['adresseU']= $adresseU;
    $_SESSION['telU']= $telU;
    //redirection
    header( "Location:profil.php" );
}

?>
<div class="container">
    <div class="row">
        <div class="col-12">

            <form class="mt-5" action="#" method="post">
                <fieldset class="form-group">
                    <div class="row">
                        <legend class="col-form-label col-sm-2 pt-0">Civilité</legend>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="civ" id="gridRadios1" value="Mr" checked>
                                <label class="form-check-label" for="gridRadios1">
                                    Mr
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="civ" id="gridRadios2" value="Mme">
                                <label class="form-check-label" for="gridRadios2">
                                    Mme
                                </label>
                            </div>

                        </div>
                    </div>
                </fieldset>
                <div class="form-group row">
                    <label for="inputLastName" class="col-sm-2 col-form-label">Nom</label>
                    <div class="col-sm-10">
                        <input type="text" name="lastName" class="form-control" id="inputLastName" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputfirstName" class="col-sm-2 col-form-label">Prenom</label>
                    <div class="col-sm-10">
                        <input type="text" name="firstName" class="form-control" id="inputfirstName" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputadresseU" class="col-sm-2 col-form-label">Adresse</label>
                    <div class="col-sm-10">
                        <input type="text" name="adresseU" class="form-control" id="inputadresseU">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" name="email" class="form-control" id="inputEmail3" required pattern="^[a-z0-9.-_]+@[a-z0-9.-_]+\.[a-z]{2,6}$">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputtelU" class="col-sm-2 col-form-label">Telephone</label>
                    <div class="col-sm-10">
                        <input type="tel" name="telU" class="form-control" id="telU" size="10" required pattern="^(?:0|(?+33)?\s?|0033\s?)[1-79](?:[.-\s]?\d\d){4}$">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Mot de passe</label>
                    <div class="col-sm-10">
                        <input type="password" name="mdp" class="form-control" id="inputPassword3" required pattern="[A-Aa-z0-9]+">
                    </div>
                </div>

                <div class="form-group row">

                </div>
                <div class="col-sm-10 text-center">
                    <button type="submit" name="submit" class="btn btn-lg btn-primary btn-block">Inscription</button>
                    <br>
                    <a class="btn btn-sm btn-outline-secondary" href="index.php">Retour</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php //Footer commun à toutes les pages 
require "footer.php";  ?>

<style>
    .col-sm-10 button {
        background-color: rgba(0, 0, 0, .85);
    }
</style>
