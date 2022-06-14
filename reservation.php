<?php
session_start();
require "constants.php";
require "functions.php";
//partie haute commune à toutes les pages
require "partie_commune_haute.php";


//************PARTIE VERIFICATION DE INFORMATIONS SAISIES**************//
$bdd = connectBDD( NAMEBDD, ROOT, HOST, MDPBDD );

//***reservation*** idResa 	DateD 	DateF 	numH 	idClient 	

//***contrat***     Id_Contrat 	idResa
if ( isset( $_POST['submit'] ) ) {
    //recuperation des informations
    $cat=$_POST["cat"];
    $date_debut=$_POST["date_debut"];
    $date_fin=$_POST["date_fin"];
    $villeH=$_POST["villeH"];
    $regionH=$_POST["regionH"];

    $extensions = ['jpg', 'png' ,'jpeg' , 'gif'];
    $maw;
    $maxsize = 400000;
    
    //idResa 	DateD 	DateF 	numH 	idClient 
    //Id_Contrat 	idResa 


    //recuperer idR identifiant de la region
    $req = $bdd->prepare( 'SELECT idR FROM region WHERE nomR = :regionH' );
    $req->execute( array(
        'regionH' => $regionH ) );

    $result = $req->fetch( PDO::FETCH_ASSOC );
    $idR = implode( "", $result );

    // recuperer les id de la categorie d'habitation    
    $req2 = $bdd->prepare( 'SELECT id_cat FROM categorie_hab WHERE nom_cat = :cat' );
    $req2->execute( array(
        'cat' => $cat ) );

    $result2 = $req2->fetch( PDO::FETCH_ASSOC );
    $id_cat = implode( "", $result2 );
//___________________________________________


    //***habitation***  numH   adresseH  villeH  codepostalH   nbdechambre   superficieH  idR  id_cat  photoH
    //verifier que Datefin dans res est inferieure à dateDebut dans formulaire

    //***affichage des informations des habitation non réservé dans la base de données**//

    $req3 = $bdd->prepare(  'CREATE VIEW VHABIT_DISPO as 
                                SELECT * FROM HABITATION 
                                   WHERE habitation.numH NOT IN 
                                 (select numH from reservation) 
                          UNION
                                 select * FROM HABITATION 
                                  WHERE numH IN (select numH FROM reservation 
                                     WHERE DateF<=curdate())', array());
    
    $req3->execute();
    
    var_dump($id_cat, $idR, $villeH);
    
    $req5 = $bdd->prepare( 'SELECT * from VHABIT_DISPO');
        
    $req5->execute();
    //$req9 = $bdd->prepare( 'select * from habitation where id_cat=:id_cat AND idR=:idR)', array());
    //$req3->execute();
    echo '
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class=\"bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center >';
                    while($result5 = $req5->fetch())
                    {
                        $l = $result5['photoH'];
                        echo ' <span>
                                    <img class="col-sm-10 left" src="img/'.$l.'"  >
                              </span>    <hr align=center size=8 size="10%" color="black">
                                        
                              ';
                    }
                    
    echo
                '</div>
            </div>
        </div>
    </div>';


    //stocker id habitation

    //redirection
    //header( "Location:profil.php" );
}

?>



<div class="container">
    <div class="row">
        <div class="col-12">
            <?php 
            //Afficher deconnexion si l'utilisateur est deja connecté sinon afficher se connecter
            if (isset($_SESSION['firstName']) AND isset($_SESSION['lastName']))

            {
                echo'<form class="mt-5" action="#" method="post">
    <br><br>
    <fieldset class="form-group">
        <div class="row">
            <legend class="col-form-label col-sm-2 pt-0">Catégorie</legend>
            <div class="col-sm-10 ">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="cat" id="gridRadios1" value="maison" checked>
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
               

            </div>
        </div>
    </fieldset>
    <div class="datation text-center">
        <label for="start">Date début:</label>

        <input type="date" id="start" name="date_debut" value="2021-07-22" min="2021-01-01" max="2021-12-31">
        &nbsp &nbsp
        <label for="end">Date fin:</label>

        <input type="date" id="end" name="date_fin" value="2021-07-28" min="2021-01-01" max"2021-12-31">
    </div>
    <br> <br>';


                $req4 = $bdd->prepare('SELECT NomR FROM region ', array());
                $req4->execute();

                echo'<div class="form-group row">
    <label for="inputRegion" class="col-sm-2 col-form-label">Region</label>
    <div class="col-sm-10">
        <select name="regionH" class="form-control" id="inputRegion" required>
            <option value="">Sélectionner la région</option>';

                while($ligne = $req4->fetch()){
                    $n=$ligne['NomR'];
                    echo '
                    <option value="'.$n.'">'.$n.'</option>
                ';}
                echo'</select>
            </div>
    </div>';
                echo'
                <div class="form-group row">
                    <label for="inputVilleH" class="col-sm-2 col-form-label">Ville</label>
                    <div class="col-sm-10">
                        <input type="text" name="villeH" class="form-control" id="inputVilleH" required>
                    </div>
                </div>
                <div class="form-group row">

                </div>
                <div class="col-sm-10">
                    <center>
                        <button type="submit" name="submit" class="btn btn-lg btn-primary btn-block">Rechercher</button>
                        <br>
                        <a class="btn btn-sm btn-outline-secondary" href="index.php">Retour</a>
                    </center>
                </div>
                </form>';
            }
            else
            {
                echo    "<div class='bg-danger text-white font-weight-bold text-center overflow' \>vous devez vous connecter ou vous inscrire pour réserver</div>
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
            ?>
        </div>
    </div>
</div>

<?php //Footer commun à toutes les pages 
require "footer.php";  ?>

<style>
     .btn {
        background-color: rgba(0, 0, 0, .85);
    }
</style>