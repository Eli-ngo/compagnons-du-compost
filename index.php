<?php //fichier index.php

//on va chercher les avis donc se co à la base
require('config/settings.php');
//on écrit la requête
$requete = $pdo->prepare('SELECT * FROM avis ORDER BY id');

$requete->execute();

$lesAvis = $requete->fetchAll(PDO::FETCH_ASSOC);
?><!DOCTYPE html>
<html lang="fr">
<head>
    <title>Accueil | Les Compagnons du Compost</title>
    <meta name= "description" content="Les Compagnons du compost vous accompagnent dans vos démarches compostage">
    <?php include('public/asset/includes/head.php');
    ?>
</head>
<body>
    <!----HEADER---->
    <header>
        <?php include('public/asset/includes/header.php');
        ?>
        <?php echo flash_out() ?>
    </header>

    <!----MAIN---->

    <!----SLIDER---->
    <div class="banner">
        <div class="row">
            <div class="col-md-12 col-xl-8 0 col-center m-auto">
                <h1 class="col-12 display-2 diisplay-sm-4 mb-3 text-left htext">Les Compagnons<br>du Compost</h1>
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Carousel -->
                    <div class="carousel-inner">
                        <div class="item carousel-item active">
                            <br><p class="paragraphe">Les biodéchets représentent 1/3 de nos poubelles.
                            <br>La bonne nouvelle ? Nous vous aidons à les composter.</p>
                        </div>
                        <div class="item carousel-item">
                            <p class="paragraphe">Le 31 décembre 2023, chacun devra trier et valoriser ses déchets organiques.
                            <br>La bonne nouvelle ? Nous vous accompagnons pour anticiper cette réglementation.</p>
                        </div>
                        <div class="item carousel-item">
                            <p class="paragraphe">60% des citoyens seraient prêt à s’engager dans la pratique du compostage avec un accompagnement
                            <br>La bonne nouvelle ? Nous vous guidons pas à pas dans cette démarche.</p>
                        </div>
                    </div>
                    <!-- Carousel Controls -->
                    <a class="carousel-control left carousel-control-prev" href="#myCarousel" data-slide="prev">
                        <i class="fa fa-angle-left " aria-hidden="true" style= "  margin-top: 1rem;
                        font-size: 4rem!important;}"></i>
                    </a>
                    <a class="carousel-control right carousel-control-next" href="#myCarousel" data-slide="next">
                        <i class="fa fa-angle-right " aria-hidden="true" style= "  margin-top: 1rem;
                        font-size: 4rem!important;}"></i>
                    </a>
                    <a class="btn btn-primary btn-index" style="background-color: #7FA43C; border:none;}" href="<?php URL?>public/contact.php" role="button" title="Contactez-nous">Contactez-nous</a>
                    <div class="arrow">
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!----SLIDER FIN---->

    <!----WAVE HEADER---->
        <div class="wave-header">
            <img src="public/asset/img/wavy3.svg" class="curvy-header" alt="wavy">
        </div>
      <!----WAVE FIN---->
        <section class="col-12 col-md-12 col-lg-12">
            <div class="citation containers col-12 col-md-12 col-lg-9">
                <p class="text-center col-12 col-md-12 col-lg-12 display-5 mb-5"><span class="col-3 col-md-3 col-lg-3 ">“</span>Avec les Compagnons du Compost, nous vous accompagnons dans une démarche éco-responsable et durable. <span class="col-12 col-md-12 col-lg-12 s2">„</span></p>
            </div>
        </section>

    <!----NOS DEMARCHES---->
    <div class="demarches ">
        <div class="row contD col-12 col-md-6 col-lg-5">
            <h2 class="dem col-12 display-5 mb-5 margin-title">Notre démarche verte</h2>
            <p class="text-center col-12 display-8 mb-5">Nous vous guidons pas à pas dans cette démarche en vous proposant :</p>
            <article class="col-12 col-md-4 col-lg-4 text-center demarche">
                <img class = "icon mb-4" src="public/asset/img/devis.webp" alt="icon deviss">
                <h3>État des lieux de votre site</h3>
            </article>
            <article class="col-12 col-md-4 col-lg-4 text-center demarche">
                <img class = "icon mb-4" src="public/asset/img/plante.webp" alt="icon plante">
                <h3>Accompagnement à la mise en place de la démarche</h3>
            </article>
            <article class="col-12 col-md-4 col-lg-4 text-center demarche">
                <img class = "icon mb-4" src="public/asset/img/composter.webp" alt="icon composter">
                <h3>Suivi du compost</h3>
            </article>
        </div>
    </div> 
    <!----NOS DEMARCHES FIN---->

    <!----SERVICES---->
    <article class="services">
        <div class="row contS col-12 col-md-10
         col-lg-11">
            <h2 class="text-center txt col-12 display-5 mb-5 margin-title">Nos services</h2>
            <p class="text-center col-12 display-8 mb-5">Intervenant sur tout le territoire de l’Aisne, notre service d’accompagnement s’adresse aux :</p>
            <div class="artS justify-content-center col-lg-10 col-md-11 col-12">
                <article class="col-xl-3 col-lg-5 col-md-6 col-sm-8 text-center service">
                    <h3 class="col-lg-3 col-md-3 col-3 txtS">Professionnels</h3>
                    <p class="col-lg-9 col-md-8 col-sm-6 col-xs-6">
                        <a class="btn btn-success" style="background-color: #7FA43C;margin-top: -74px; margin-left: -75px; padding: 10px 34px;border-radius: 10px;" href="<?php URL?>public/professionels.php" role="button" title="En savoir plus">En savoir plus</a>
                    </p>
                </article>
                <article class="col-xl-3 col-lg-5 col-md-6 col-sm-8 text-center service">
                    <h3 class="col-lg-3 col-md-3 col-3 txtS">Collectivités</h3>
                    <p class="col-lg-9 col-md-8 col-sm-6 col-xs-6 ">
                        <a class="btn btn-success" style="background-color: #7FA43C;margin-top: -74px; margin-left: -75px; padding: 10px 34px;border-radius: 10px;" href="<?php URL?>public/collectivites.php" role="button" title="En savoir plus">En savoir plus</a>
                    </p>
                </article>
                <article class="col-xl-3 col-lg-5 col-md-6 col-sm-8 text-center service">
                    <h3 class="col-lg-3 col-md-3 col-3 txtS">Particuliers</h3>
                    <p class="col-lg-9 col-md-8 col-sm-6 col-xs-6 ">
                        <a class="btn btn-success" style="background-color: #7FA43C; margin-top: -74px;
                        margin-left: -75px; padding: 10px 34px;border-radius: 10px;" href="<?php URL?>public/particuliers.php" role="button" title="En savoir plus">En savoir plus</a>
                    </p>
                </article>
            </div>
        </div>
    </article>
    <!----SERVICES FIN---->

    <!----POURQUOI TRAVAILLER---->
    <section class="pourquoi">
        <div class="row justify-content-around containerP">
           <div class="col-xs-12 col-sm-9 col-md-9 col-lg-6 col-xl-4 mt-5 textPk">
                <h2>Pourquoi travailler <br>avec nous</h2>
                <p>Il existe des tas de raisons qui vous ont poussé <br> à vous intéresser au compost :</p>
                <ul>
                    <li class="elips">
                        <i class="fa fa-circle e1" aria-hidden="true" style="margin-top: 2rem;"></i>
                        <p class ="ml-4 mt-2">Réduire vos déchets alimentaires</p>
                    </li>
                    <li class="elips">
                        <i class="fa fa-circle e2" aria-hidden="true" style="margin-top: 2rem;"></i>
                        <p class ="ml-4 mt-2">Être en conformité avec la loi AGEC</p>
                    </li>
                    <li class="elips">
                        <i class="fa fa-circle e3" aria-hidden="true" style="margin-top: 2rem;"></i>
                        <p class ="ml-4 mt-2">Obtenir de l’engrais naturel</p>
                    </li>
                </ul>
                <p>Notre accompagnement vous permettra d’être aidé à chaque étape dans la mise en place de cette démarche pour vous faire gagner du temps et fédérer vos équipes ou votre quartier autour de ce projet.
                </p>
                <p>
                    <a class="btn btn-primary" style="background-color: #162721; border:none; margin-top: 60px; padding: 10px 60px; border-radius: 10px;" href="<?= URL?>public/pourquoi-composter.php" role="button">En savoir plus</a>
                </p>
            </div>
            <div class="col-xs-12 col-sm-9 col-md-6 col-lg-6 col-xl-5">
                <figure class ="imgPk">
                    <img src="<?= URL?>public/asset/img/pourquoi.webp" alt="composte">
                </figure>
            </div> 
        </div>
    </section>
    <!----POURQUOI TRAVAILLER FIN---->


<!----AVIS CLIENTS---->
    <?php if($requete->rowCount() > 0){?>
    <div class="avis">
        <!-- WAVE avis -->
        <div class="wave-avis">
                <img src="public/asset/img/wavepq.svg" class="curvy-avis">
        </div>
        <div class="container">
            <div class="row avis-content">
                <h2 class=" tit txtA col-12 text-center display-5 mb-5 margin-title">Avis clients</h2>
                <?php foreach($lesAvis as $avis): ?>
                <?php //si le boolean est à 1, on affiche la section Avis
                if($avis['display'] == '1'){?>
                        <div class="avis-block col-12 col-md-4 col-lg-4">
                                <p class="avis-p"><?= $avis['feedback'] ?></p>
                                <figure>
                                <img src="public/asset/data/<?= $avis['file'] ?>" alt="" class="imgAvis rounded-circle">
                                </figure>
                                <p class="avis-name text-center"><?= $avis['firstname']." ".$avis['lastname'] ?></p>
                        </div>
                        <?php } ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php } ?>
<!----AVIS CLIENTS FIN---->

<!----PARTENAIRES---->
<div class="container">
        <div class="row col-12">
            <h2 class="txt text-center col-12 display-5 mb-5 margin-title">Ils nous font confiance</h2>
            <div class="imgPart">
                <figure class="thumbnail-height mb-5 col-7 col-md-4 col-lg-6">
                    <img src="public/asset/img/bge-logo.webp" alt="logo partenaire BGE" class="img-thumbnail rounded-circle">
                </figure>
                <figure class="thumbnail-height mb-5 col-7 col-md-4 col-lg-6">
                    <img src="public/asset/img/agglo-logo.webp" alt="logo partenaire AGGLO" class="img-thumbnail rounded-circle">
                </figure> 
            </div>
        </div>
    </div>
    <div class="partenaires"></div>
 
    <!----PARTENAIRES FIN---->

    <!----MAIN FIN---->

    <!----FOOTER---->
    <?php include('public/asset/includes/footer.php');
    ?>
    <!----FOOTER FIN---->

    <!---- JQUERY CDN ---->
    <script src="public/asset/js/jquery-3.5.1.min.js"></script>
    <!---- SCRIPT ---->
    <script src="public/asset/js/script.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</body>
</html>