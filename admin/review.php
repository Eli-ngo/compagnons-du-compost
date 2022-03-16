<?php 

require_once('../config/settings.php');

if (!isset($_SESSION['admin'])) {
    // je suis encore connectée
    header('location:' . URL . 'admin/login.php');
    exit();
}

if(isset($_GET['action']) && $_GET['action'] == 'deco'){
    unset($_SESSION['admin']);
    // header('location:' . $_SERVER['PHP_SELF']);
    header('location:' . URL . 'admin');
    exit();
}

require_once('asset/includes/header.php');

$edit = $pdo->prepare('SELECT * FROM avis WHERE id = :i');
$edit->execute([':i' => $_GET['reviewid'] ]);


if($edit->rowCount() == 1){
    $tEdit = $edit->fetch();
    $couverture = $tEdit['file'];
}

?>
<title>Modifier un témoignage</title>
<div id="bodyEdit">
    <div class="mainEdit">
    <?php echo flash_out() ?>
    <form method="POST" action="core/editreview.php" enctype="multipart/form-data">
                <!-- pour le formulaire puisse envoyer des fichiers, il faut obligatoirement qu'il ait l'attribut enctype="multipart/form-data".
                Sans cet attribut, les fichiers ne seront pas envoyés-->
                <p>
                <input type="hidden" name="id" value="<?= $tEdit['id'] ?>">
                </p>
                <div>
                    <label for="fichier"><img src="<?php echo (!empty($_POST['datapreview'])) ? $_POST['datapreview'] : ((isset($tEdit['file'])) ? URL . 'public/asset/data/' . $tEdit['file'] : URL . 'admin/asset/img/placeholder.png') ?>" alt="couverture" id="preview" class="img-fluid border"></label>
                    <label for="">Photo</label>
                    <input type="file" name="fichier" id="fichier" accept="image/jpeg,image/png,image/webp,image/jfif">
                    <input type="hidden" name="datapreview" id="datapreview" value="<?= $_POST['datapreview'] ?? '' ?>">

                    <?php
                    if (isset($tEdit['file'])) {
                    ?>
                        <input type="hidden" name="couverture_actuelle" value="<?= $tEdit['file'] ?>">
                    <?php } ?>
                </div>
                <p>
                    <input type="text" name="nom_avis" placeholder="Nom" value="<?= $tEdit['lastname'] ?>">
                </p>
                <p>
                    <input type="text" name="prenom_avis" placeholder="Prénom" value="<?= $tEdit['firstname'] ?>">
                </p>
                <p>
                    Catégorie :
                    <input type="radio" name="categorie_avis" id="particulier" value="Particulier" <?php
            if($tEdit['category'] == 'Particulier') echo 'checked'; ?>>
                    <label for="particulier">Particulier</label>

                    <input type="radio" name="categorie_avis" id="pro" value="Professionnel" <?php
            if($tEdit['category'] == 'Professionnel') echo 'checked'; ?>>
                    <label for="pro">Professionnel</label>

                    <input type="radio" name="categorie_avis" id="collectivite" value="Collectivite" <?php
            if($tEdit['category'] == 'Collectivite') echo 'checked'; ?>>
                    <label for="collectivite">Collectivité</label>
                </p>
                <p>
                    <textarea type="text" name="message_avis" placeholder="Avis laissé" id="feedback"><?= $tEdit['feedback'] ?></textarea>
                </p>
                <p>
                    <button type="submit" name="editcontent" class="btn btn-primary">Modifier</button>
                    <a href="reviewtable.php" class="btn btn-warning">Retour</a>
                </p>

            </form>
    </div>
</div>

<!-- A REMODIFIER -->
<?php include('asset/includes/footer.php');