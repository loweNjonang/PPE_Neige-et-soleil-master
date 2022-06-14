<?php
session_start();

//partie haute commune à toutes les pages
require "partie_commune_haute.php";

//*AFFICHAGE DES IDENTIFIANTS DE L'UTILISATEUR S'IL est DEJA CONNECTE

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="main.css" rel="stylesheet">
</head>

<header>
    <center>

    <br><h1> <b> <i> Bienvenue chez Neige & Soleil ! </i></b></h1> <hr>

        <div class="slide1" id="carousel"></div>
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                   
                    <img src="img/tum.gif" class="d-block" width="70%">
                </div>
                <div class="carousel-item">
                    <img src="img/th.jpg" class="d-block" width="70%">
                </div>
                <div class="carousel-item">
                    <img src="https://www.luxury-design.com/wp-content/uploads/2015/01/location-de-chalet-luxe-courcheval-Perce-neige-exterieur-915x610.jpg" class="d-block" width="70%">
                </div>
                <div class="carousel-item">
                    <img src="img/Vh.jpg" class="d-block" width="70%">
                </div>
                <div class="carousel-item">
                    <img src="img/Rh.jpg" class="d-block" width="50%">
                </div>
                <div class="carousel-item">
                    <img src="img/660.jpg" class="d-block" width="70%">
                </div>
                <div class="carousel-item">
                    <img src="img/chalet3.jpg" class="d-block" width="70%">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Précédent</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Suivant</span>
            </a>
        </div>
    </center>
    <script>
        var slides = document.querySelectorAll('#slides .slide');
        var currentSlide = 0;
        var slideInterval = setInterval(nextSlide, 200);

        function nextSlide() {
            slides[currentSlide].className = 'slide';
            currentSlide = (currentSlide + 1) % slides.length;
            slides[currentSlide].className = 'slide showing';
        }
        //#sourceURL=pen.js

    </script>
</header>

<body>
    <div class=info>
<center>
    <hr align=center size=8 width="70%" color="navy">
   
    <br> <div class="card mb-3 align-content-center flex-wrap" style="max-width: 1200px;">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <img src="img/9301.jpg" class="card-img" alt="">
                </div>
                <div class="col-md-8 row align-items-center">
                    <div class="card-body">
                        <p class="card-text">
                            
        <div class="icon-box">
            
            <h4>N'hesitez pas !</h4>
            <p>Une sélection d'hébergements vérifiés selon des critères de qualité et de design.</p>
          </div>
          <div class="icon-box" >

            <h4>Pour vous</h4>
            <p>Grâce à Neige et Soleil vous pouvez faire des locations de vacances en montagne, profitez de toutes les possibilités qu'offre les pyrénées.</p>
          </div>
         
                        </div>
                </div>
            </div>
        </div>
        <center>
        <br> <div class="card mb-3 align-content-center flex-wrap" style="max-width: 1200px;">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <img src="img/vue.jpg" class="card-img" alt="">
                </div>
                <div class="col-md-8 row align-items-center">
                    <div class="card-body">
                        <p class="card-text">
       
          <div class="icon-box" >
            
            <h4>Découvrez</h4>
            <p> Découvrez une sélection de plusieurs locations de vacances idéales pour votre séjour en Montagne. Quelles que soient vos envies, de vacances en famille, entre amis ou avec vos compagnons à quatre pattes,</p>
          </div>
          <div class="icon-box" >
            
            <h4>Les propriétés</h4>
            <p> les propriétés appartement de vacances et chalets sont très recherchées pour des vacances à la Montagne. Quels que soient vos besoins, vous trouverez sans difficulté la location idéale pour toute la famille.</p>
          </div>
                        </div>
                </div>
            </div>
        </div>

    
    <center>
       <br> <div class="card mb-3 align-content-center flex-wrap" style="max-width: 1200px;">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <img src="https://media.odalys-vacances.com/imgResize-1099-701/output/information/lieu_hebergement/1781/tmp4C22_location-ski-les-deux-alpes-chalet-odalys-soleil-levant-1.jpg" class="card-img" alt="">
                </div>
                <div class="col-md-8 row align-items-center">
                    <div class="card-body">
                        <p class="card-text">
                            Neige et soleil est une entreprise de location dédié aux vacances et loisirs en montagne. Nous vous proposont une large gamme de logement partout en France. En collaboration avec les particuliers mettant à votre disposition leur propriété.</p>
                            Elle emploie à 
               ce jour 4 personnes en plus du directeur : une secrétaire-comptable-gestionnaire, deux commerciaux et un 
               ouvrier pour tous les petits travaux d’entretien dans les appartements et la maintenance du matériel de ski.
              Sa région d'implantation se situe dans la vallée du Queyras, près de Briançon.
                        </div>
                </div>
            </div>
        </div>
    
    </div>
</div>
       <center> <br><br>
        <h1>Choisissez Neige et soleil pour des vacances hors du temps et comme à la maison</h1>
        <hr align=center size=8 width="60%" color="black">
        <br><br>
        <div class="card-deck " style="max-width: 1600px;">
            <div class="card">
                <img src="img/221_00-2020-11-27-0250.jpg" class="card-img-top" alt="...">
                <div class="card-body row align-items-center">
                    <p class="card-text ">Quel que soit la saison, la durée, la période, nous proposons toute l'année nos offres en accord avec les propriétaires. Parmis nos offres, vous pouvez trouver vos vacances de sports d'hiver idéales durant ou hors les périodes de vacances scolaires.</p>
                </div>
            </div>
            <div class="card">
                <img src="img/soleil1.jpg" class="card-img-top" alt="..." wodth=50%>
                <div class="card-body row align-items-center">
                    <p class="card-text">Seul ou en famille, nous vous proposons des séjours inoubliable hors de votre quotidien. Vos loisirs sont nos missions. Vous pourrez ainsi, chisir le logement de votre séjour en fonction du nombre de chambre à un prix tout à fait abordables négociés par nos soins avec les propriétaires. Nos logements sont tout équipés (internet, cuisine, télévision, salle de bains et bien plus encore ...)</p>
                </div>
            </div>
            <div class="card">
                <img src="img/unnamed.jpg" class="card-img-top" alt="...">
                <div class="card-body row align-items-center">
                    <p class="card-text">Avez-vous un maison, chalet, un appartement à louer ? Si c'est le cas vous pouvez directement le faire sur notre site en postant une anonce, notre service de location sera la pour négocier avec vous le prix à établir. Il vous sera possible de vous rétracter à tout moment. Pourquoi choisir notre groupe ? Notre objectif n'est pas de faire de l'argents mais de vous en faire économiser. En effet sur la totalité du prix d'une location, 90% revient directement aux propriétaires de cette dernières. Alors n'hésitez plus et réservez.</p>
                </div>
            </div>
        </div>
    </center>
    
</body>

<style>
section .content-1 {
	background: hotpink;
    text-align: center;
    padding: 10px;
	color: #ffffff;
	border: 2px solid rgb(10, 241, 2);
	border-radius: 10px;
}
h1{
    font-family: "Century Gothic", helvetica, arial, sans-serif;
}

.info{
background-color: rgb(173, 205, 235) ;  
background-size: cover;
  padding: 60px 0;
  position: relative;
  
  display:auto;
}

</style>
 </html>
<?php //Footer commun à toutes les pages 
require "footer.php";  ?>
