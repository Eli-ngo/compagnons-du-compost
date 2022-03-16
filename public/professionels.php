<?php //fichier public/professionels.php

require('../config/settings.php');

$listAvis = $pdo->prepare('SELECT * FROM avis ORDER BY id');

$listAvis->execute();

$tAvis = $listAvis->fetchAll(PDO::FETCH_ASSOC);

?><!DOCTYPE html>
<html lang="fr">
<head>
    <title>Professionels | Les Compagnons du Compost</title>
    <?php include('asset/includes/head.php');
    ?>
    <meta name="description" content="Les Compagnons du compost accompagnent les professionnels dans leurs démarches de compostage avec un suivi personnalisé">
</head>
<body>
<!----HEADER---->
    <header>
    <?php include('asset/includes/header.php');
    ?>
    </header>


<!----MAIN---->
    <main>
        <section class="banner">
        <div class="row">
            <h1 class="col-12 display-2 mb-3 display-3 text-center margin-title align-self-center titre">Professionels</h1>
            <a class="btn btn-primary" style="background-color: #7FA43C; border:none; margin-top: 60px; margin: auto;" href="contact.php" role="button">Contactez-nous</a>
        </div>
        </section>
       
        <!----WAVE---->
        <div class="wave">
            <img src="asset/img/waveabout.svg" class="curvy-header" alt="wavy-bg">
        </div>
        <!----WAVE FIN---->
        <section class="mission mb-5">
            <div class="row container-fluid">
                <div class="col-xs-9 col-sm-10 col-md-7 col-lg-7 mb-5 mt-5 texteM">
                        <p>Nous accompagnons les <span class="introGras">restaurants scolaires</span>, <span class="introGras">restaurants administratifs</span>, <span class="introGras">marchés</span>…à valoriser leurs biodéchets pour respecter la réglementation tout en maîtrisant leur budget.</p>
                </div>
            </div>   
        </section>

        <!------------ TIMELINE ---------->
        <div class="container mb-5">
            <div class="page-header">
                <h2 class=" tit txtA col-12  display-5 mb-5 margin-title">Ce que nous ferons ensemble</h2>
                <p class = "col-12 mt-4">Nous vous accompagnons tout au long de votre aventure avec nous. </p>
            </div>
            <ul class="timeline">
                <li>
                    <div class="timeline-badge"> 
                        <i class="fas fa-handshake"></i>
                    </div>
                    <div class="timeline-panel"><!- bloc a gauche->
                        <div class="timeline-heading">
                            <h4 class="timeline-title">Première rencontre </h4>
                        </div>
                        <div class="timeline-body">
                            <p>Rencontre gratuite pour découvrir vos besoins et vous proposer l’offre la plus adaptée à votre établissement (devis) </p>
                        </div>
                    </div>
                </li>
                <li class="timeline-inverted"><!- bloc a droite->
                    <div class="timeline-badge warning">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <h4 class="timeline-title">Etat des lieux</h4>
                        </div>
                        <div class="timeline-body">
                            <p>Evaluer le volume de biodéchets produit jusqu’à la mise en relation avec le fournisseur de matériel adapté et à l’obtention d’aides de subvention.</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="timeline-badge danger">
                        <i class="fas fa-cog"></i>
                    </div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <h4 class="timeline-title">Mise en route</h4>
                        </div>
                        <div class="timeline-body">
                            <p>Accompagnement théorique et pratique de vos équipes et un suivi chaque semaine pendant un mois</p>
                        </div>
                    </div>
                </li>
                <li class="timeline-inverted"><!- bloc a droite->
                    <div class="timeline-badge warning">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <h4 class="timeline-title">Suivi</h4>
                        </div>
                        <div class="timeline-body">
                            <p>Suivi régulier de validation du compost et certificats de preuve de conformité avec la loi sur le compostage en établissement dit compostage de proximité</p>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <!------------ FIN TIMELINE ---------->

        <!-- ------------TEMOIGNAGE---------------- ---->
        <section class="container-fluid">
        <h2 class = "tit teMoignage col-12  display-5 mb-5 margin-title">Témoignages</h2>

        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
            <?php foreach($tAvis as $avis): ?>
                    <?php //si le boolean est à 1, on affiche
                    if($avis['category'] == 'Professionnel' && $avis['display'] == '1'){?>
                <div class="item carousel-item">
                    <div class="row justify-content-around mb-5">
                        <div class="col-xs-12 col-sm-9 col-md-8 col-lg-6 col-xl-6 order-md-2 order-sm-2 order-2 ">
                            <figure>
                                <img class = "img-fluide" src="<?= URL?>public/asset/data/<?= $avis['file'] ?>" alt="agriculture">
                            </figure>
                        </div>
                        <div class="col-xs-12 col-sm-9 col-md-10 col-lg-6 col-xl-5 texteO order-lg-2 order-1">
                            <div class="avis-block prO col-sm-12 col-md-11 col-lg-10">
                                <p class="avis-p fond"><?= $avis['feedback'] ?></p>
                                <figure>
                                    <img src="public/asset/img/tpab.jpeg" alt="" class="imgAvis rounded-circle">
                                </figure>
                                <p class="avis-name text-center">Professionel</p>
                            </div>
                        </div>
                    </div>
                </div> <!-- end of div .carousel-item -->
                <?php } ?>
            <?php endforeach; ?>
            </div> <!-- end of div .carousel-inner -->
            <!-- Carousel Controls -->

            <a class="carousel-control left carousel-control-prev" href="#myCarousel" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="carousel-control right carousel-control-next" href="#myCarousel" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>

        </div> <!-- end of div #myCarousel--> 
        </section>
    <!-- ------------TEMOIGNAGE---------------- ---->

    <!----PARTENAIRES---->
        
        <div class="container">
            <div class="row col-12">
                <h2 class="txt tit text-center col-12 display-5 mb-5 margin-title">Ils nous font confiance</h2>
                <div class="imgPart">
                <figure class="thumbnail-height mb-5 col-7 col-md-4 col-lg-6">
                    <img src="asset/img/bge.webp" alt="" class="img-thumbnail rounded-circle">
                    </figure>
                    <figure class="thumbnail-height mb-5 col-7 col-md-4 col-lg-6">
                    <img src="asset/img/agglo.webp" alt="" class="img-thumbnail rounded-circle">
                    </figure> 
                </div>
            </div>
        </div>
        
<!----PARTENAIRES FIN---->
    <section class="contacter container">

    <div class="row">

        <div class="contactEnsemble col-12">

            <h2>Nous contacter</h2>
            <a class="btn btnContacter btn-primary" style="background-color: #7FA43C; border:none; margin-top: 60px" href="mailto:xxx@yz.org" role="button">Contactez-Moi</a>

        </div>
        
    </div> 
    </section>
     

    </main>

<!----FOOTER---->
    <?php include('asset/includes/footer.php');
    ?>
<!----FOOTER FIN---->
<!---- JQUERY CDN ---->
    <script src="asset/js/jquery-3.5.1.min.js"></script>
<!---- SCRIPT ---->
    <script src="asset/js/script.js"></script>
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</body>
</html>