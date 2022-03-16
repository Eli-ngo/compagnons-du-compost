<?php //fichier public/asset/includes/header.php

?>
    <section class="navigation">
        <div class="nav-container">
            <div class="brand">
                <a href="<?= URL?>" title="logo Compagnons du Compost">
                    <img class="theLogo" src="<?php echo URL?>public/asset/img/logo.webp" alt="logo Compagnons du Compost">
                </a>
            </div>
            <nav>
            <div class="nav-mobile">
                <a id="nav-toggle" href="#!"><span></span></a>
            </div>
            <ul class="nav-list">
                <!-- Ne pas enlever le #! car ça permet d'exécuter aucune action au click -->
                <li><a href="<?= URL ?>public/qui-sommes-nous.php" title="à propos de nous">Qui sommes-nous ?</a></li>
                <li><a href="<?= URL ?>public/pourquoi-composter.php" title="pourquoi composter">Pourquoi composter ?</a></li>
                <li><a href="#!">Services</a>
                <ul class="nav-dropdown">
                    <li><a href="<?= URL ?>public/professionels.php" title="service pour professionnels">Professionnels</a></li>
                    <li><a href="<?= URL ?>public/collectivites.php" title=" service pour collectivités">Collectivités</a></li>
                    <li><a href="<?= URL ?>public/particuliers.php" title=" service pour particuliers">Particuliers</a></li>
                </ul>
                </li>
                <li><a href="<?= URL ?>public/contact.php" title="contact">Contact</a></li>
                <?php if (isset($_SESSION['admin']) ) {?>
                    <li>
                        <a href="<?php echo URL?>admin/index.php">
                            <span class="icon"><i class="fa fa-wrench" aria-hidden="true"></i></span>
                            <span class="title">Espace Admin</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo URL?>admin/?action=deco">
                            <span class="icon"><i class="fa fa-sign-out" aria-hidden="true"></i></span>
                            <span class="title">Déconnexion</span>
                        </a>
                    </li>
                <?php } ?>
            </ul>
            </nav>
        </div>
    </section>