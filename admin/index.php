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

// Contenu de la page d'admin
?>
<title>Admin | Les Compagnons du Compost</title>
<div id="bodyIndex">
<?php echo flash_out() ?>
    <div class="mainIndex">
        <h1>Admin - Les compagnons du compost</h1>
        <h2>Bonjour Admin !</h2>
        <p>
            Bienvenue sur le Back-Office du site Les Compagnons du Compost. Le Back-Office (également appelé "Back-End") est une interface de gestion destinée exclusivement à l'administrateur pour que celui-ci puisse ajouter, mettre à jour et supprimer du contenu spécifique. Il est protégé par authentification et en conséquence ne doit pas être partagé à quique ce soit.
        </p>
        </div>
    </div>

<?php
require_once('asset/includes/footer.php');
?>

