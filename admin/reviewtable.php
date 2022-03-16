<?php 

require_once('../config/settings.php');

//si la session admin existe
if (!isset($_SESSION['admin'])) {
    // je suis encore connectée
    header('location:' . URL . 'admin/login.php');
    exit();
}

//si la session admin existe, afficher le bouton Déconnexion
if(isset($_GET['action']) && $_GET['action'] == 'deco'){
    unset($_SESSION['admin']);
    // header('location:' . $_SERVER['PHP_SELF']);
    header('location:' . URL . 'admin');
    exit();
}

require_once('asset/includes/header.php');

//Gestion de l'affichage
if(isset($_GET['action']) && $_GET['action'] == 'changestatut' && !empty($_GET['id']) ){
    $avis = executeSQL("SELECT * FROM avis WHERE id=:id", array('id' => $_GET['id']));
    if($avis->rowCount() == 1){
        $infos = $avis->fetch();
        $nouveaustatut = ($infos['display'] == 1) ? 0 : 1;
        executeSQL("UPDATE avis SET display=:nouveaustatut WHERE id=:id", array(
            'nouveaustatut' => $nouveaustatut,
            'id' => $infos['id']
        ));
        if($nouveaustatut == 1){
            flash_in('success', 'L\'avis est publié en ligne.');
        }else{
            flash_in('success', 'L\'avis n\'est plus mis en ligne');
        }
    }
}

$listAvis = $pdo->prepare('SELECT * FROM avis ORDER BY id DESC');

$listAvis->execute();

$tAvis = $listAvis->fetchAll(PDO::FETCH_ASSOC);


?>
<title>Témoignages | Les Compagnons du Compost</title>
<body id="bodyFeedback">
    
        <section class="header text-center">
            <div class="container text-white">
            <?php echo flash_out() ?>
                <header class="titleFeedbacks">
                    <h1>Avis sur la page d'accueil <br>[<?php echo $listAvis->rowCount(); ?> témoignage<?php if($listAvis->rowCount() > 1) echo 's';?> enregistré<?php if($listAvis->rowCount() > 1) echo 's';?>]</h1>
                    <p class="feedback-p font-italic mb-1">Les avis que vous aurez cochés ici s'afficheront sur la page d'accueil tandis que les pages de services <br>publieront directement l'avis selon la catégorie.<br>Veillez à ne déposer que des photos qui ont la même hauteur et largeur.</p>
                </header>
        
        
                <div class="row">
                <p class="col-lg-6 mx-auto">
                    <a class="btn btn-warning" style="border:none; padding: 10px 60px; border-radius: 10px;" target="_blank" href="<?= URL ?>" role="button">Visualiser</a>
                </p>
                <p class="col-lg-6 mx-auto">
                    <a class="btn btn-success" style="border:none; padding: 10px 60px; border-radius: 10px;" href="addreview.php" role="button">Ajouter un avis</a>
                </p>
                    <div class="col-lg-12">
                        <div class="card border-0 shadow">
                            <div class="card-body p-5">
        
                                <!-- Responsive table -->
                                <div class="table-responsive">
                                    <table class="table m-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">Affichage</th>
                                                <th scope="col">Prénom</th>
                                                <th scope="col">Nom</th>
                                                <th scope="col">Photo</th>
                                                <th scope="col-lg-3">Message</th>
                                                <th scope="col-lg-3">Catégorie</th>
                                                <th scope="col-lg-4">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //si on a au moins 1 avis, on les affiche
                                            if($listAvis->rowCount() > 0){ ?>
                                                <tr>
                                                    <?php
                                                        foreach ($tAvis as $value) { ?>
                                                            <td>
                                                                <a href="?action=changestatut&id=<?php echo $value['id']; ?>" type="button" data-toggle="tooltip" data-placement="top" title="Affichage">
                                                                <?php 
                                                                echo ($value['display'] == '1') ? '<i style="font-size: 20px; color: green; padding: 5px;" class="fa fa-toggle-on"></i>' : '<i style="font-size: 20px; color: red; padding: 5px;" class="fa fa-toggle-off"></i>';
                                                                ?>
                                                                </a>
                                                                <?php 
                                                                
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $value['firstname']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $value['lastname']; ?>
                                                            </td>
                                                            <td>
                                                            <img src="<?php echo URL . 'public/asset/data/' . $value['file'] ?>" class="img-fluid imgfeedback">
                                                            </td>
                                                            <td>
                                                                <?php echo $value['feedback']; ?>
                                                                <!--
                                                                <hr>
                                                                Publié le <?php // echo date('d/m/Y à H:i', strtotime($value['published'])) ?>
                                                                <?php
                                                                     //if($value['edited']){
                                                                        ?>
                                                                        <br>
                                                                        Mise à jour le <?php //echo date('d/m/Y à H:i', strtotime($value['edited'])) ?>
                                                                        <?php
                                                                    //}
                                                                ?>
                                                                -->
                                                            </td>
                                                            <td>
                                                                <?php echo $value['category']; ?>
                                                            </td>
                                            
                                                    <td class="edit">
                                                        <!-- Call to action buttons -->
                                                        <ul class="list-inline m-0">
                                                                <a href="review.php?reviewid=<?php echo $value['id']; ?>" class="btn btn-primary btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Modifier"><i class="fa fa-edit"></i></a>
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <a href="core/deletereview.php?reviewid=<?php echo $value['id']; ?>" class="btn btn-danger btn-sm rounded-0" type="submit" data-toggle="tooltip" data-placement="top" title="Supprimer"><i class="fa fa-trash"></i></a>
                                                            </li>
                                                        </ul>
                                                    
                                                    </td>
                                                </tr>
                                                <?php } //fin de foreach ?>
                                            <?php } //fin de if ?>
                                        </tbody>
                                    </table>
        
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <?php require_once('asset/includes/footer.php');?>
</body>