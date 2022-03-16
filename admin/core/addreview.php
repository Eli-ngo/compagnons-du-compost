<?php //fichier back/core/addreview.php

require_once('../../config/settings.php');

$errors = 0;
if (isset($_POST['addcontent'])) { //si le formulaire est soumis
    //si un des champs est vide, on affiche erreur
    if (empty($_FILES['fichier']['name']) || empty(trim($_POST['nom_avis'])) || empty(trim($_POST['prenom_avis'])) || empty($_POST['categorie_avis']) || empty(trim($_POST['message_avis']))) {
        flash_in('error', 'Veuillez remplir tous les champs');
        header('Location: ../addreview.php');
    }else{

		foreach ($_POST as $key => $value) {
			$_POST[$key] = htmlspecialchars(trim($value)); //convertit les caractères spéciaux en entité HTML et enlève les espaces
		}
    
        //J'autorise ces fichiers
        $extensions = ['png', 'jpg', 'jpeg', 'jfif']; 
        //on découpe le nom complet du fichier dans un tableau (on coupe selon le .)
        $tFilename = explode('.', $_FILES['fichier']['name']);
        //on récup la dernière case du tableau
        $extFile = array_pop($tFilename);

        //si le fichier n'est pas dans un format autorisé (si l'extension du fichier n'est pas dans le tableau des extentions autorisées)
        if( !in_array($extFile, $extensions)){
            //on marque l'erreur
            $errors = 1;
            flash_in('error', 'Veuillez sélectionner le bon format de l\'image parmi JPEG, PNG, WEBP');
            header('Location: ../addreview.php');
            exit();
        }
        //si on ne trouve aucune erreur
        if($errors == 0){
                //on crée le nouveau nom du fichier
                $newName = 'pic-'.time().'.'.$extFile;

                //on déplace le fichier de la mémoire temporaire vers le dossier public/data en utilisant le nouveau nom
                move_uploaded_file($_FILES['fichier']['tmp_name'], '../../public/asset/data/'.$newName);

                //on créer la requête d'ajout (avec le nouveau nom)
                $add = $pdo->prepare('INSERT INTO avis (file, lastname, firstname, feedback, category) VALUES (:file, :lastname, :firstname, :feedback, :category)');
                $add->execute([
                    ':file' => $newName,
                    ':lastname' => $_POST['nom_avis'],
                    ':firstname' => $_POST['prenom_avis'],
                    ':category' => $_POST['categorie_avis'],
                    ':feedback' => $_POST['message_avis']
                ]);

                //on redirige vers le form et on affiche le message success
                flash_in('success', 'Le témoignage a bien été ajouté');
                header('Location: ../reviewtable.php?success');
                exit();
        }
    }
}