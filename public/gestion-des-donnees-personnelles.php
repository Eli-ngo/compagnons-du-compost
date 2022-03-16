<?php //fichier public/about.php
require('../config/settings.php');
?><!DOCTYPE html>
<html lang="fr">
<head>
    <title>Gestion des données personnelles | Les Compagnons du Compost</title>
    <meta name="description" content="Gestion des données personnelles de la société Les Compagnons du compost">
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
        <h1 class="margin-title">Gestion des données personnelles</h1>
        <section>
            <h2 class="margin-title">Données personnelles</h2>
            <p class="mt-4">En conformité avec le Règlement Général pour la Protection des Données (RGPD), vous pouvez demander à : </p>
            <ul>
                <li>Retirer votre consentement,</li>
                <li>Accéder à vos données,</li>
                <li>Modifier vos données,</li>
                <li>Effacer vos données,</li>
                <li>Transférer vos données vers un tiers (droit à la portabilité).</li>
            </ul>
        <p class="mt-4">Pour exercer ces droits, l’Utilisateur doit adresser une demande à l’adresse postale suivante : Les Compagnons du compost 16 rue de la Comédie, Saint-Quentin 02100, France; ou par mail à : <a href="mailto:contact@lescompagnonsducompost.fr">contact@lescompagnonsducompost.fr</a> en indiquant ses nom et prénom. Les Compagnons du compost pourront demander à l’Utilisateur de prouver son identité, en joignant à sa demande tout document nécessaire, notamment une copie de sa carte d’identité ou de son passeport.</p>
        <p class="margin-bottom">"Les Compagnons du compost mettront en œuvre les moyens à leur disposition pour procéder au traitement des demandes relatives aux données à caractère personnel des Utilisateurs. En cas de faille de sécurité du Site ou de perte de données personnelles relatives à des Utilisateurs, Les Compagnons du compost les en informeront par mail dans les conditions légales applicables. Il prendra toutes les mesures qui s’imposent, dans la limite de ses moyens humains, matériels et financiers, pour remédier à la faille et assurer la sécurité des données. Les Utilisateurs disposent également d’un droit à réclamation, qu’ils peuvent exercer auprès de l’autorité de contrôle nationale, à savoir la CNIL. Pour obtenir plus d’informations au sujet de leurs droits, les Utilisateurs peuvent cliquer sur le lien suivant : <a class="margin-bottom" href="https://www.cnil.fr/fr/comprendre-vos-droits" target="_blank">https://www.cnil.fr/fr/comprendre-vos-droits</a></p>
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
