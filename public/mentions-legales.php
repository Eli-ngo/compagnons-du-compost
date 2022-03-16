<?php //fichier public/about.php
require('../config/settings.php');
?><!DOCTYPE html>
<html lang="fr">
<head>
    <title>Mentions légales | Les Compagnons du Compost</title>
    <meta name="description" content="Mentions légales de la société Les Compagnons du compost">
    <?php include('asset/includes/head.php');
    ?>
</head>
<body>
<!----HEADER---->
    <header>
    <?php include('asset/includes/header.php');
    ?>
    </header>

<!----MAIN---->
    <main class="col-xs-9 col-sm-10 col-md-7 col-lg-7 texteM">
        <h1 class="titreBlacks margin-title">Mentions légales</h1>
        <section>
            <h2 class="margin-title">Editeur du site</h2>
            <p class="mt-4">L’édition du site <a href="https://lescompagnonsducompost.fr/">lescompagnonsducompost.fr</a> est assurée par </p>
            <p>Morgane NOURY</p>
            <p>16 rue de la Comédie</p>
            <p>02100 Saint-Quentin, France</p>
            <p>Email : <a href="mailto:contact@lescompagnonsducompost.fr">contact@lescompagnonsducompost.fr</a></p>
            <p>Téléphone : +33 6 70 60 19 96</p>
        </section>
        <section>
            <h2 class="margin-title">Hébergement du site internet</h2>
            <p class="mt-4">L’hébergeur du site <a href="https://lescompagnonsducompost.fr/">lescompagnonsducompost.fr</a> est : <a href="https://www.infomaniak.com/fr">Infomaniak</a>  - Rue Eugène-Marziano 25, 1227 Genève, Suisse.</p>
            <p>Téléphone : +41 22 820 35 44.</p>
            <p>N° IDE & TVA : CHE-103.167.648</p>
        </section>
        <section class="mb-5">
            <h2 class="margin-title">Conception du site</h2>
            <p class="margin-bottom mt-4">La conception du site a été réalisée par des étudiants de <a href="https://www.digital-campus.fr/ecole/paris">Digital Campus Paris</a>.</p>
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
