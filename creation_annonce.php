<?php

session_start();
require "constants.php";
require "functions.php";
//partie haute commune à toutes les pages
require "partie_commune_haute.php";

//************PARTIE VERIFICATION DE INFORMATIONS SAISIES**************//
$bdd = connectBDD( NAMEBDD, ROOT, HOST, MDPBDD );

if ( isset( $_POST['submit'] ) ) {
    //recuperation des informations
    $cat = $_POST['cat'];
    $VilleH = $_POST['VilleH'];
    $adresseH = $_POST['adresseH'];
    $region = $_POST['region'];
    $codepostalH = $_POST['codepostalH'];
    $nbdechambre = $_POST['nbdechambre'];
    $superficieH = $_POST['superficieH'];
    $photoH = $_POST['photoH'];
    $extension = array('jpg','JPG','png','PNG','gif','GIF');
    // recupere le num de la région
    
    $bdd = connectBDD( NAMEBDD, ROOT, HOST, MDPBDD );

        $req = $bdd->prepare( 'SELECT idR FROM region WHERE nomR = :region' );
    $req->execute( array(
        'region' => $region ) );

    $result = $req->fetch( PDO::FETCH_ASSOC );
    $idR = implode( "", $result );

    // recuperer les id de la categorie d'habitation    
    $req2 = $bdd->prepare( 'SELECT id_cat FROM categorie_hab WHERE nom_cat = :cat' );
    $req2->execute( array(
        'cat' => $cat ) );

    $result2 = $req2->fetch( PDO::FETCH_ASSOC );
    $id_cat = implode( "", $result2 );
//-----------------------------


    //***Insertion des informations de l'habitation dans la base de données**//
    $requete = $bdd->prepare( 'INSERT INTO habitation(adresseH, VilleH,codepostalH,nbdechambre,superficieH, idR,id_cat, photoH) VALUES(:adresseH,:VilleH,:codepostalH,:nbdechambre, :superficieH, :idR,:id_cat, :photoH)' );

    $requete->bindValue(':adresseH', $adresseH, PDO::PARAM_STR );
    $requete->bindValue( ':VilleH', $VilleH, PDO::PARAM_STR );
    $requete->bindValue( ':codepostalH', $codepostalH, PDO::PARAM_STR );
    $requete->bindValue( ':nbdechambre', $nbdechambre, PDO::PARAM_STR );
    $requete->bindValue( ':superficieH', $superficieH, PDO::PARAM_STR );
    $requete->bindValue( ':idR', $idR, PDO::PARAM_STR );
    $requete->bindValue( ':id_cat', $id_cat, PDO::PARAM_STR );
    $requete->bindValue( ':photoH', $photoH, PDO::PARAM_STR );


    $requete->execute();
    //stocker id habitation
    $_SESSION['numH'] = $bdd->lastInsertId();

    //***Insertion des informations du propriétaire dans la base de données**//

    $nomP=$_SESSION['lastName'];
    $prenomP=$_SESSION['firstName'];
    $adresseP=$_SESSION['adresseU'];
    $telP=$_SESSION['telU'];
    $mail=$_SESSION['email'];
    $id_u=$_SESSION['id_u'];
    $idP=$id_u;
    
    //chercher si le user est deja enregistré comme proprietaire
    $req6 = $bdd->prepare('SELECT idP FROM proprietaire WHERE idP = :idP');
    $req6->execute(array(
        'idP' => $idP));
    $resultat6 = $req6->fetch();

    //Si le user n'est pas présent dans la table proprietaire alors on le rajoute à la table proprietaire
    if (!$resultat6)
    {
        $requete2 = $bdd->prepare( 'INSERT INTO proprietaire(idP,nomP,prenomP,adresseP,telP, mail) VALUES(:idP,:nomP,:prenomP,:adresseP, :telP, :mail)' );

        $requete2->bindValue(':idP', $idP, PDO::PARAM_STR );
        $requete2->bindValue(':nomP', $nomP, PDO::PARAM_STR );
        $requete2->bindValue( ':prenomP', $prenomP, PDO::PARAM_STR );
        $requete2->bindValue( ':adresseP', $adresseP, PDO::PARAM_STR );
        $requete2->bindValue( ':telP', $telP, PDO::PARAM_STR );
        $requete2->bindValue( ':mail', $mail, PDO::PARAM_STR );
        $requete2->execute();

        $_SESSION['idP'] = $idP;
        $_SESSION['nomP']=$nomP;
        $_SESSION['prenomP']=$prenomP;
        $_SESSION['adresseP']=$adresseP;
        $_SESSION['telP']=$telP;
        $_SESSION['mail']=$mail;

    }else{
        $_SESSION['idP'] = $idP;
    }

    //redirection
    header( "Location:profil.php" );
}





//Afficher la liste des régions
$req4 = $bdd->prepare( 'SELECT NomR FROM region ', array() );
$req4->execute();

echo'
<div class="container">
    <div class="row">
        <div class="col-12">';

/*************Formulaire de création d'annonces***************/
if ( isset( $_SESSION['firstName'] ) AND isset( $_SESSION['lastName'] ) ) {
    echo '
            <form class="mt-5" action="#" method="post">
                <fieldset class="form-group">
                    <div class="row">
                        <legend class="col-form-label col-sm-2 pt-0">Catégorie</legend>
                        <div class="col-sm-10 row align-items-center">
                            <div class="form-check">
                                <input class="form-check- input" type="radio" name="cat" id="gridRadios1" value="maison" checked>
                                <label class="form-check-label" for="gridRadios1">
                                    Maison
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="cat" id="gridRadios2" value="appartement">
                                <label class="form-check-label" for="gridRadios2">
                                    Appartement
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="cat" id="gridRadios2" value="chalet">
                                <label class="form-check-label" for="gridRadios2">
                                    Chalet
                                </label>
                            </div>

                        </div>
                    </div>
                </fieldset>
                <div class="form-group row">
                    <label for="inputAdresse" class="col-sm-2 col-form-label">Adresse habitation</label>
                    <div class="col-sm-10 row align-items-center">
                        <input type="text" name="adresseH" class="form-control" id="inputAdresse" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputVilleH" class="col-sm-2 col-form-label">Ville</label>
                    <div class="col-sm-10 row align-items-center">
                        <input type="text" name="VilleH" class="form-control" id="inputVilleH" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputRegion" class="col-sm-2 col-form-label">Region</label>
                    <div class="col-sm-10 row align-items-center">
                        <select name="region" class="form-control" id="inputLastName" required>
                            <option value="">Sélectionner la région</option>';
    while($ligne = $req4->fetch())
    {
        $n = $ligne['NomR'];
        echo '<option value="'.$n.'">'.$n.'</option>';
    }
    echo'
                            </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputCodepostalH" class="col-sm-2 col-form-label">Code Postal</label>
                    <div class="col-sm-10 row align-items-center ">
                        <input type="text" name="codepostalH" class="form-control" id="inputCodepostalH" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputnbChambre" class="col-sm-2 col-form-label">Nombre de chambres</label>
                    <div class="col-sm-10 row align-items-center">
                        <select name="nbdechambre" id="chambre-select">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputSuperficieH" class="col-sm-2 col-form-label">Superficie Habitation (m²)</label>
                    <div class="col-sm-10 row align-items-center">
                        <input type="text" name="superficieH" class="form-control" id="superficieH" required>
                    </div>
                </div>

                <div class="form-group row">

                    <label for="inputphotoH" class="col-sm-2 col-form-label">Veuillez insérer des photos qui présentent l\'habitation</label>
                    <div class="col-sm-10 row align-items-center">
                        Choisir fichier : <input name="photoH" type="file" /><br/>
                    </div>


                </div>
                <div class="col-sm-10 text-center">
                    <button type="submit" name="submit" class="btn btn-lg btn-primary btn-block">Soumettre</button>
                    <br>
                    <a class="btn btn-sm btn-outline-secondary" href="index.php">Retour</a>
                </div>
            </form>';
} else {
     echo "
            <div class=' bg-danger text-white font-weight-bold text-center overflow' \>Vous devez vous connecter ou vous inscrire pour créer une annonce</div>
            <br>
            <hr align=center size=8 width='60%' color='black'>
            <br>
            <center>
                <a href='connexion.php'><button type='button' class='btn btn-primary'> Se connecter </button>
                </a>
                <a href='inscription.php'><button type='button' class='btn btn-primary'> S'inscrire </button>
                </a>
            </center>
            <br>
            <hr align=center size=8 width='60%' color='black'>
            <br>";
}
echo'
        </div>
    </div>
</div>';

//Footer commun à toutes les pages
require "footer.php";
?>

<style>
     .btn {
        background-color: rgba(0, 0, 0, .85);
    }
</style>