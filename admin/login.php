<?php //fichier admin/login.php

require_once('../config/settings.php');

//si la session admin existe
if (isset($_SESSION['admin'])) {
    // Je suis déjà connectée
    header('Location:' . URL . 'admin');
    exit();
}

//on enlève tous les espaces
$_POST = array_map('trim', $_POST);

//si le formulaire est soumis
if (!empty($_POST)) {
    //on vérifie si le login OU le mdp sont remplis
    if(empty($_POST['login']) || empty($_POST['password']) ){
        flash_in('error','Merci de remplir tous les champs');
    }
    else{ //sinon si les 2 champs sont remplis, on crée une variable qui va vérifier le login
        $user = getUserByLogin($_POST['login']);
        if( $user ){
            // si je trouve le login correspondant
            // je vérifie si le mdp correspond à celui de la DB
            if(password_verify($_POST['password'], $user['password'])){

                //je stocke la variable dans une session appelée admin
                $_SESSION['admin'] = $user;
                flash_in('success','Connexion réussie, vous êtes connecté en tant qu\'admin');
                header('location:'.URL.'index.php');
                exit();

            }else{
                flash_in('error','Identifiants incorrects');
            }
        }
        else{
            flash_in('error','Identifiants incorrects');
        }

    }

}
// Contenu de la page de connexion
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
    <link rel="stylesheet" href="<?php echo URL ?>admin/asset/css/styleback.css"> <!-- URL a été enregistré dans settings.php et echo URL permet de toujours revenir à la racine -->
    <!----FAVICON---->
    <link rel="apple-touch-icon" sizes="180x180" href="<?= URL?>public/asset/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= URL?>public/asset/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= URL?>public/asset/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?= URL?>public/asset/img/favicon/site.webmanifest">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
</head>
<body>
    <div id="loginBody">
    <div class="row pt-4">
        <div class="col-8 col-lg-3 formBox">
            <img src="asset/img/3.png" class="loginLogo">
                <div class="col-8 col-lg-10 formBoxes">
                <h2 id="loginTitle">Connexion admin</h2>
                <hr>
                <?php echo flash_out() ?>
                <form method="post" class="signinBox">
                    <div class="form-group">
                        <label for="login" class="labelLogin">Identifiant</label> <i class="fa fa-user loginIcon" aria-hidden="true"></i>
                        <input type="text" class="form-control" id="login" name="login">
                    </div>
                    <div class="form-group">
                        <label for="password" class="labelLogin">Mot de passe</label> <i class="fa fa-eye voirmdp loginIcon" aria-hidden="true"></i>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <a href="../index.php" class="btn btn-warning">Retour au site</a>
                    <button type="submit" class="btn btn-primary">Se connecter</button>
                </form>
                <a href="<?php echo URL ?>admin/requestpassword.php" class="d-block mt-4">Mot de passe oublié ?</a>
                </div>  
            </div>
        </div>    
    </div>

<?php

require_once('asset/includes/footer.php');