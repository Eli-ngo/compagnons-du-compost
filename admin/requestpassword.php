<?php

require_once('../config/settings.php');


//Si je suis déjà connecté, inutile d'afficher cette page
if (isset($_SESSION['admin'])) {
    // Je suis déjà connecté
    header('location:' . URL . 'admin');
    exit();
}

// Si le formulaire est soumis
if (!empty($_POST)) {

    if ( !empty($_POST['email']) ) {
        // vérifier le format de l'email
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            // validité du format de l'email
            $user = executeSQL("SELECT * FROM users WHERE email=:email", array(
                'email' => $_POST['email']
            ));
            if ($user->rowCount() > 0) {
                $infosUser = $user->fetch();
                $destinataire = $infosUser['email'];
                $expiration = time() + 30 * 60; // J'ajoute 30 minutes à partir de maintenant
                $token = uniqid() . uniqid() . uniqid(); //On ajoute 3 tokens pour compliquer le pattern
                executeSQL("UPDATE users SET token=:token, expiration=:expiration WHERE id_user=:id_user", array(
                    'token' => $token,
                    'expiration' => $expiration,
                    'id_user' => $infosUser['id_user']
                ));
                $lien = 'http://localhost' . URL . 'admin/resetpassword.php?email=' . $infosUser['email'] . '&token=' . $token;

                $message ='<p>Bonjour '.$infosUser['login'].'<br>
                            Voici le lien à suivre afin de réinitialiser votre mot de passe. Ce lien est valide 30 minutes. Ne tardez pas !<br>
                            <a href="'.$lien.'">'.$lien.'</a>
                            <br>
                            A bientot sur notre site</p>';
                $headers[] = 'MIME-Version:1.0';
                $headers[] = "Content-Type: text/html; charset=UTF-8";
                $headers[] = 'From: noreply@lescompagnonsducompost.fr';
                $sujet = '[Projet] Demande de réinitialisation de mot de passe';

                mail($infosUser['email'],$sujet,$message,implode(PHP_EOL,$headers));

            }
            flash_in('success', 'Si cette adresse email est enregistrée dans notre base de données, Un lien vous sera envoyé dans quelques instants afin de réinitialiser votre mot de passe.');
            header('location:'.URL.'admin/login.php');
            exit();

        } else {
            flash_in('error', 'Adresse mail invalide');
        }
    } else {

        flash_in('error', 'Merci de renseigner votre adresse email');
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
            <h1>Demande de réinitialisation de mot de passe</h1>
            <hr>
            <p>Merci de renseigner l'adresse mail avec laquelle vous êtes inscrit(e) <br>sur ce site afin de réinitialiser votre mot de passe.</p>
            <?php echo flash_out() ?>
            <form method="post">
                <div class="form-group">
                    <label for="email">Adresse mail</label>
                    <input type="email" class="form-control requestBox" id="email" name="email" placeholder="Votre adresse email">
                </div>
                <a href="<?php echo URL ?>admin/login.php" class="btn btn-warning">Retour sur la page de connexion</a>
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </form>
        </div>
    </div>
</div>
<?php require_once('asset/includes/footer.php');
?>