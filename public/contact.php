<?php //fichier public/contact.php

require_once('../config/settings.php');

$_POST = array_map('trim', $_POST);

if (!empty($_POST)) {

    $errors = 0;

    if (empty($_POST['nom'])) {
        flash_in('error','Merci de renseigner votre nom');
        $errors++;
    }

    if (empty($_POST['prenom'])) {
        flash_in('error','Merci de renseigner votre prénom');
        $errors++;
    }

    if (empty($_POST['message'])) {
        flash_in('error', 'Merci de renseigner votre message');
        $errors++;
    }

    if (empty($_POST['phone'])) {
        flash_in('error', 'Merci de renseigner votre numéro de téléphone');
        $errors++;
    }

    if (!empty($_POST['email'])) {
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            flash_in('error', 'Merci de renseigner une adresse email valide');
            $errors++;
        }
    }
    else{
        flash_in('error', 'Merci de renseigner une adresse email');
        $errors++;
    }
    
    if ($errors == 0){
        $headers[] = "MIME-Version: 1.0";
        $headers[] = "Content-Type: text/html; charset=UTF-8";
        $headers[] = 'From: '. $_POST['prenom'] . $_POST['nom'] . '<' . $_POST['email'] . '>';
        //  $headers[] = 'Cc: Jeanne Doe <jeannedoe@gmail.com>';
    
        $mail = $_POST['email'];
        $sujet = '[' .$_POST['prenom']. ' ' .$_POST['nom']. ']' . ' ' .$_POST['demande'];
        $message ='<p>De '.$_POST['civilite'].' '.$_POST['nom'].' '.$_POST['prenom'].'<br>'.'<p>Message : '.$_POST['message'] .'</p>'.'<br>'.'<p>Numéro de téléphone : '.$_POST['phone'] . '</p>'.'<br>'.'<p>Type de demande : ' .$_POST['situation'].'</p>';
        // str_replace(ce que je veux remplacer, par quoi, dans quelle chaine)
    
        mail($mail, $sujet, $message, implode(PHP_EOL, $headers) );
    
        // implode transforme un tableau en chaine caractères avec un séparateur entre chaque élément du tableau
        //   ligne 1 PHP_EOL ligne 2 PHP_EOL ligne 3
        // implode(séparateur, tableau)
    
        $chaine = "2021-02-15";
        $tab = explode('-',$chaine); // transforme une chaine en tableau en utilisant le séparateur spécifié entre chaque élément 
        // tab[0] => année
        // tab[1] => mois

        flash_in('success', 'Message envoyé');
    }


}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact | Les compagnons du compost</title>
    <?php include('asset/includes/head.php');
    ?>
</head>

<body>
    <?php require_once('asset/includes/header.php'); ?>

    <section class="banner">
        <div class="row">
        <h1 class="col-12 display-2 mb-3 display-3 text-center margin-title align-self-center titre">Contact</h1>
        </div>
    </section>
    <div class="wave-header">
        <img src="<?= URL ?>public/asset/img/wavy3.svg" class="curvy-header" alt="wavy-bg">
    </div>

    <div class="container">
    <?php echo flash_out() ?>
        <div class="row contactRow">
            <div class="col-lg-6">
                <ul class="ulContact">
                    <li class="liContact">
                        <i class="iContact fa fa-phone" aria-hidden="true"></i>
                        <p>06 70 60 19 96</p>
                    </li>
                    <li class="liContact">
                        <i class="iContact fa fa-envelope-o" aria-hidden="true"></i>
                        <p>contact@lescompagnonsducompost.fr</p>
                    </li>
                    <li class="liContact">
                        <i class="iContact fa fa-home" aria-hidden="true"></i>
                        <p>02100 Saint-Quentin et 40 <br> km aux alentours</p>
                    </li>
                    <li class="liContact">
                    <i class="iContact fa fa-clock-o" aria-hidden="true"></i>
                        <p>Du lundi au vendredi<br>de 08h30 - 12h30 et de 13h30 - 16h30</p>
                    </li>
                </ul>
                <div class="contact-menu">
                        <ul id="menu-get-started" class="contact-menu-list">
                            <li class="menu-item">
                                <a href="https://www.linkedin.com/company/les-compagnons-du-compost" target="_blank"><i class="contactIcon fab fa-linkedin-in"></i></a>
                            </li>
                            <!--<li class="menu-item">
                                <a href="#"><i class="contactIcon fab fa-twitter"></i></a>
                            </li>
                            <li class="menu-item">
                                <a href="#"><i class="contactIcon fab fa-facebook-f"></i></a>
                            </li>
                            <li class="menu-item">
                                <a href="#"><i class="contactIcon fab fa-instagram"></i></a>
                            </li>-->
                        </ul>
                    </div>
            </div>

            <div class="col-lg-6">
                <form method="post">
                    <!-- .form-group*3>label+input.form-control -->
                    <div class="form-group civilbox">
                        <div class="civilh">
                        <input type="radio" name="civilite" value="Monsieur" id="homme" checked><label for="homme">Monsieur</label>
                        </div>
                        <div class="civilfemme">
                        <input type="radio" name="civilite" value="Madame" id="femme"><label for="femme">Madame</label>
                        </div>
                    </div>
                    <div class="justify-content-between">
                        <div class="form-group input-group col-lg-offset-1 col-md-offset-2">
                            <input type="text" class="form-control input-contact" id="prenom" name="prenom" placeholder="Prénom">
                        </div>
                        <div class="form-group input-group col-lg-offset-1 col-md-offset-2">
                            <input type="text" class="form-control input-contact" id="nom" name="nom" placeholder="Nom"> 
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control input-contact" id="email" name="email" placeholder="Adresse email">
                    </div>
                    <div class="form-group">
                        <input type="tel" class="form-control input-contact" id="phone" name="phone" placeholder="Numéro de téléphone">
                    </div>
                    <div class="form-group">
                        <select name="situation" id="situations">
                            <option value="Collectivités">Collectivités</option>
                            <option value="Professionnels">Professionnels</option>
                            <option value="Particuliers">Particuliers</option>
                            <option value="Rejoindre l'équipe">Rejoindre l’équipe</option>
                            <option value="Devenir partenaire">Devenir partenaire</option>
                            <option value="Autres">Autres</option>
                        </select>
                    </div>
                    <div class="form-group demandeDot">
                        <div class="dotOne">
                        <input type="radio" name="demande" value="Prise de rendez-vous" checked> Demande de prise de rendez-vous
                        <input type="radio" name="demande" value="Demande de diagnostic et de devis"> Demande de diagnostic et de devis
                        </div>
                        <div class="dotTwo">
                        <input type="radio" name="demande" value="Candidature"> Candidature
                        <input type="radio" name="demande" value="Autres"> Autres
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message"></label>
                        <textarea name="message" id="message" cols="30" rows="10" class="form-control input-contact" placeholder="message"></textarea>
                    </div>

                    <button type="submit" class="btnContact">Envoyer</button>

                </form>
            </div>
        </div>
    </div>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d82327.22060457562!2d3.2090238950150036!3d49.84761240122195!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e8186188e01cc5%3A0x40af13e8169d440!2s02100%20Saint-Quentin!5e0!3m2!1sfr!2sfr!4v1616097320463!5m2!1sfr!2sfr" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>


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