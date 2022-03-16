<?php

require_once('../config/settings.php');

if (!isset($_SESSION['admin'])) {
    // je ne suis encore connecté
    header('location:' . URL . 'admin/login.php');
    exit();
}

if(isset($_GET['action']) && $_GET['action'] == 'deco'){
    unset($_SESSION['admin']);
    // header('location:' . $_SERVER['PHP_SELF']);
    header('location:' . URL . 'admin');
    exit();
}


//Changement de l'identifiant
if (isset($_POST['changelogin'])) {
    // on sait que l'on traite le premier formulaire (email, coordonnées)
    if (!empty($_POST['identifiant'])) {

            //Modification dans la DB
            executeSQL("UPDATE users SET login=:login WHERE id_user=:id_user", array(
                'login' => $_POST['identifiant'],
                'id_user' => $_SESSION['admin']['id_user']
            ));
            // Maj de la session
            $_SESSION['admin']['login'] = $_POST['identifiant'];
            flash_in('success', "Votre pseudo a bien été mis à jour");
            header('location:' . $_SERVER['PHP_SELF']);
            exit();
        
    } else {
        flash_in('error', "Merci de renseigner le pseudo");
    }
}

//Changement de l'adresse email
if (isset($_POST['changemail'])) {
    // on sait que l'on traite le premier formulaire (email, coordonnées)
    if (!empty($_POST['email'])) {
        // format de l'email
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            // Modif dans la DB
            executeSQL("UPDATE users SET email=:email WHERE id_user=:id_user", array(
                'email' => $_POST['email'],
                'id_user' => $_SESSION['admin']['id_user']
            ));
            // Maj de la session
            $_SESSION['admin']['email'] = $_POST['email'];
            flash_in('success', "L'email a été mis à jour");
            header('location:' . $_SERVER['PHP_SELF']);
            exit();
        } else {
            flash_in('error', "Le format de l'email est incorrect");
        }
    } else {
        flash_in('error', "Merci de renseigner l'email");
    }
}


//changement du mdp
if (isset($_POST['changemdp'])) {
    // on sait que l'on traite le deuxieme formulaire (mdp)
    if (empty(trim($_POST['mdp'])) || empty(trim($_POST['newmdp'])) || empty(trim($_POST['confirmation']))) {
        flash_in('error', 'Merci de remplir tous les champs');
    } else {

        if (!password_verify($_POST['mdp'], $_SESSION['admin']['password'])) {
            flash_in('error', 'Le mot de passe actuel est incorrect');
        } else {
            if ($_POST['newmdp'] !== $_POST['confirmation']) {
                flash_in('error', 'Le nouveau mot de passe et sa confirmation ne concordent pas');
            } else {

                if (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[_\$\!\-\.\%])[\w\$\!\-\.\%]{8,20}$#', $_POST['newmdp'])) { //expressions régulières
                    // OK compléxité respectée
                    $newmdp = password_hash($_POST['newmdp'], PASSWORD_DEFAULT);
                    executeSQL("UPDATE users SET password=:newmdp WHERE id_user=:id_user", array(
                        'newmdp' => $newmdp,
                        'id_user' => $_SESSION['admin']['id_user']
                    ));
                    $_SESSION['admin']['password'] = $newmdp;
                    flash_in('success', 'Le mot de passe a été mis à jour');
                    header('location:' . $_SERVER['PHP_SELF']);

                    //  ex: http://localhost/b2dev/projet/admin/gestion_articles.php?action=edit&id=13
                    // $_SERVER['PHP_SELF'] page courante ( uniquement le fichier de script ) =>  http://localhost/b2dev/projet/admin/gestion_articles.php
                    //  $_SERVER['REQUEST_URI'] url complet http://localhost/b2dev/projet/admin/gestion_articles.php?action=edit&id=13
                    
                    exit();
                } else {
                    flash_in('error', 'Le mot de passe doit comporter entre 8 et 20 caractères dont au moins 1 minuscule, 1 majuscule, 1 chiffre et 1 caractère spécial (_$!-.%)');
                }
            }
        }
    }
}


require_once('asset/includes/header.php');

?>
<body id="bodyManager">
    

<div id="bodyProfile" class="container">
<?php echo flash_out() ?>
    <div class="mainProfile row">
        <div class="col-md-6 pt-4">
        <h3>Login : <?php echo $_SESSION['admin']['login'] ?></h3>
            <form method="post">
                <div class="form-group">
                    <label for="identifiant">Votre login</label>
                    <input type="text" class="requestBox form-control" id="identifiant" name="identifiant" value="<?php echo $_POST['identifiant'] ?? $_SESSION['admin']['login'] ?>">
                </div>
                <button type="submit" name="changelogin" class="btn btn-primary">Modifier</button>
            </form>

            <form method="post">
            <h3 class="mailManager">Votre adresse email : <?php echo $_SESSION['admin']['email'] ?></h3>
                <div class="form-group">
                    <label for="email">Votre email</label>
                    <input type="email" class="requestBox form-control" id="email" name="email" value="<?php echo $_POST['email'] ?? $_SESSION['admin']['email'] ?>">
                </div>
                <button type="submit" name="changemail" class="btn btn-primary">Modifier</button>
            </form>
        </div>
        <div class="col-md-6 pt-4">
            <h3>Changer le mot de passe</h3>
            <form method="post">
                <div class="form-group position-relative">
                    <label for="mdp">Mot de passe actuel</label> <i class="fa fa-eye voirmdp"></i> <!-- <i class="fa fa-eye-slash"></i>-->
                    <input type="password" class="requestBox form-control" id="mdp" name="mdp">
                </div>
                <div class="form-group position-relative">
                    <label for="newmpd">Nouveau mot de passe</label> <i class="fa fa-eye voirmdp"></i> 
                    <input type="password" class="requestBox form-control" id="newmdp" name="newmdp">
                </div>
                <div class="form-group position-relative">
                    <label for="confirmation">Confirmation</label> <i class="fa fa-eye voirmdp"></i> 
                    <input type="password" class="requestBox form-control" id="confirmation" name="confirmation">
                </div>
                <button type="submit" name="changemdp" class="btn btn-primary">Modifier</button>
            </form>
        </div>
    </div>
</div>

<?php
require_once('asset/includes/footer.php');
?>
</body>