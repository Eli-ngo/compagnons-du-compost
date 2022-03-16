<?php


require_once('../config/settings.php');

//Si je suis déjà connecté, inutile d'afficher cette page
if (isset($_SESSION['admin'])) {
    // Je suis déjà connecté
    header('location:' . URL . 'admin');
    exit();
}

// Contrôles
if (!empty($_GET['email']) && !empty($_GET['token'])) {

    $user = executeSQL('SELECT * FROM users WHERE email=:email AND token=:token AND expiration>=:expiration', array(
        'email' => $_GET['email'],
        'token' => $_GET['token'],
        'expiration' => time()
    ));
    if ($user->rowCount() == 0) {
        flash_in('error', 'Le lien utilisé est invalide ou a expiré');
        header('location:' . URL . 'admin/login.php');
        exit();
    } else {
        $infosUser = $user->fetch();
    }
} else {
    flash_in('error', 'Le lien utilisé est invalide');
    header('location:' . URL . 'admin/login.php');
    exit();
}

//  En plaçant le traitement du post ici, je profite des controles précèdents pour verifier que j'ai toujours affaire à un lien valide( email, token et expiration non atteinte)
if(!empty($_POST)){
    if(!empty($_POST['newmdp']) && !empty($_POST['confirmation'])){
        if( $_POST['newmdp'] === $_POST['confirmation']){
            // les deux champs sont remplis et identiques
            if (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[_\$\!\-\.\%])[\w\$\!\-\.\%]{8,20}$#', $_POST['newmdp'])) {
                executeSQL("UPDATE users SET password=:newmdp, token=NULL WHERE id_user=:id_user",array(
                        'newmdp' => password_hash($_POST['newmdp'],PASSWORD_DEFAULT),
                        'id_user' => $infosUser['id_user']
                ));
                flash_in('success','Le mot de passe a été changé avec succès');
                header('location:'.URL.'admin/login.php');
                exit();
            }else{
                flash_in('error', 'Merci de créer un mot de passe plus difficile à trouver. Le mot de passe doit comporter entre 8 et 20 caractères dont au moins 1 minuscule, 1 majuscule, 1 chiffre et 1 caractère spécial (_$!-.%)');
            }
        }
        else{
            flash_in('error','Le nouveau mot de passe et la confirmation ne concordent pas');
        }
    }
    else{
        flash_in('error','Merci de remplir tous les champs');
    }

}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Les compagnons du compost</title>
    <!-- css bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!-- fontawesome cdn -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- css perso -->
    <link rel="stylesheet" href="<?php echo URL ?>admin/asset/css/styleback.css">
</head>
<body class="requestBody">
<nav class="navAdmin">
    <a href="<?php echo URL?>"><img src="<?php echo URL ?>admin/asset/img/3.png" alt="Logo"></a>
</nav>
<div class="container requestContainer pt-5">
    <div class="row requestMain mt-5">
        <div class="col mt-5">
            <h1>Réinitialiser votre mot de passe</h1>
            <hr>
            <p>Veuillez choisir un mot de passe comportant entre 8 et 20 caractères<br> dont au moins 1 minuscule, 1 majuscule, 1 chiffre et 1 caractère spécial (_$!-.%)</p>
            <?php echo flash_out() ?>
            <form method="post">
                <input type="hidden" name="id_user" value="<?php echo $infosUser['id_user'] ?>">
                <div class="form-group">
                    <label for="newmdp">Nouveau mot de passe</label> <i class="fa fa-eye voirmdp"></i>
                    <input type="password" class="form-control requestBox" id="newmdp" name="newmdp" placeholder="nouveau mot de passe">
                </div>
                <div class="form-group">
                    <label for="confirmation">Confirmation</label> <i class="fa fa-eye voirmdp"></i>
                    <input type="password" class="form-control requestBox" id="confirmation" name="confirmation" placeholder="confirmer le mot de passe">
                </div>
                <a href="<?php echo URL ?>admin/login.php" class="btn btn-warning">Retour sur la page de connexion</a>
                <button type="submit" class="btn btn-primary">Valider</button>
            </form>
        </div>
    </div>
</div>
<?php require_once('asset/includes/footer.php');
?>

