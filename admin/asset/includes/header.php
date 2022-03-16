<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!-- fontawesome cdn -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- DataTables cdn -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.css"/>
    <!-- css perso -->
    <link rel="stylesheet" href="<?= URL ?>admin/asset/css/styleback.css"> <!-- URL a été enregistré dans settings.php et echo URL permet de toujours revenir à la racine -->
    <link rel="stylesheet" href="<?= URL ?>admin/asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= URL ?>admin/asset/css/font-awesome.min.css">

    <!----FAVICON---->
    <link rel="apple-touch-icon" sizes="180x180" href="<?= URL?>public/asset/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= URL?>public/asset/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= URL?>public/asset/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?= URL?>public/asset/img/favicon/site.webmanifest">
    <link rel="mask-icon" href="<?= URL?>public/asset/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    
</head>
<body>
    <nav class="navAdmin">
        <a href="<?php echo URL?>"><img src="<?php echo URL ?>admin/asset/img/3.png" alt="Logo"></a>
    </nav>
        
    <div class="navigation">
        <ul>
            <li>
                <a href="index.php">
                    <span class="icon"><i class="fa fa-home" aria-hidden="true"></i></span>
                    <span class="title">Accueil</span>
                </a>
            </li>
            <li>
                <a href="reviewtable.php">
                    <span class="icon"><i class="fa fa-commenting" aria-hidden="true"></i></span>
                    <span class="title">Témoignages / Avis</span>
                </a>
            </li>
            <li>
                <a href="manager.php">
                    <span class="icon"><i class="fa fa-lock" aria-hidden="true"></i></span>
                    <span class="title">Espace membre</span>
                </a>
            </li>
            <li>
                <a href="?action=deco">
                    <span class="icon"><i class="fa fa-sign-out" aria-hidden="true"></i></span>
                    <span class="title">Se déconnecter</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="toggle"></div>