<?php //fichier admin/addreview.php

//on ajoute la config du site
include('../config/settings.php');

//si la session admin n'existe pas, on redirige vers la page de connexion
if (!isset($_SESSION['admin'])) {
    // je suis encore connectée
    header('location:' . URL . 'admin/login.php');
    exit();
}

//si action de déco existe
if(isset($_GET['action']) && $_GET['action'] == 'deco'){
    unset($_SESSION['admin']); //reset la session
    // header('location:' . $_SERVER['PHP_SELF']);
    header('location:' . URL . 'admin');
    exit();
}

require_once('asset/includes/header.php');

?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <title>Back</title>
</head>
<body>
    <div id="addBody">
        <div class="mainAdd">
            <h1>Ajouter un témoignage / avis</h1>
            <?php echo flash_out() ?>
            <form class="formAdd" method="POST" action="core/addreview.php" enctype="multipart/form-data">
                <!-- pour le formulaire puisse envoyer des fichiers, il faut obligatoirement qu'il ait l'attribut enctype="multipart/form-data".
                Sans cet attribut, les fichiers ne seront pas envoyés-->

                <p>
                    <input type="file" name="fichier">
                </p>
                <p>
                    <input type="text" name="nom_avis" placeholder="Nom">
                </p>
                <p>
                    <input type="text" name="prenom_avis" placeholder="Prénom">
                </p>
                <p class="addp">
                    Catégorie :
                    <input type="radio" name="categorie_avis" id="particulier" value="Particulier">
                    <label for="particulier">Particulier</label>

                    <input type="radio" name="categorie_avis" id="pro" value="Professionnel">
                    <label for="pro">Professionnel</label>

                    <input type="radio" name="categorie_avis" id="collectivite" value="Collectivite">
                    <label for="collectivite">Collectivité</label>
                </p>
                <p>
                    <textarea id="feedback" name="message_avis" placeholder="Avis laissé"></textarea>
                </p>
                <p>
                    <a href="reviewtable.php" class="btn btn-warning">Retour</a>
                    <button type="submit" name="addcontent" class="btn btn-primary">Ajouter</button>
                </p>

            </form>
        </div>
    </div>
    <?php require_once('asset/includes/footer.php');?>
</body>
</html>