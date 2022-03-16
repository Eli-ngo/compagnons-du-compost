<?php  //fichier admin/core/editreview.php


//on ajoute le settings
include('../../config/settings.php');


//si sur ce script sans passer par le form
if(!empty($_POST)){
	//flash_in
	foreach ($_POST as $key => $value) {
		$_POST[$key] = htmlspecialchars(trim($value)); //convertit les caractères spéciaux en entité HTML et enlève les espaces
	}

    $errors = 0;

    if (empty($_POST['nom_avis'])) {
        flash_in('error', 'Merci de saisir un nom');
        $errors++;
    }
    if (empty($_POST['prenom_avis'])) {
        flash_in('error', 'Merci de saisir un prénom');
        $errors++;
    }
    if (empty($_POST['message_avis'])) {
        flash_in('error', 'Merci de saisir un message');
        $errors++;
    }
    if (empty($_FILES['fichier']['name'])  && empty($_POST['datapreview']) && empty($_POST["couverture_actuelle"])) {
        flash_in('error', 'Merci de saisir une image de couverture');
        $errors++;
    }
	//on recup les données de l'avis dans la base
	if (!empty($_FILES['fichier']['name']) || !empty($_POST['datapreview'])) {
		// j'ai choisi une nouvelle couverture
		// je vais chercher les infos actuelles pour récupèrer l'ancienne couverture
		$article = executeSQL("SELECT * FROM avis WHERE id=:id", array('id' => $_POST['id']));
		if ($article->rowCount() == 1) {
			$infos = $article->fetch();
			$couverture = $infos['file'];
			$chemin = $_SERVER['DOCUMENT_ROOT'] . URL . 'public/asset/data/';
			// S'il y a une couverture et que le fichier existe
			if (!empty($couverture) && file_exists($chemin . $couverture)) {
				// on supprime l'ancien fichier
				unlink($chemin . $couverture);
			}
		}
	}


	$autorisations = array('image/jpeg', 'image/png', 'image/webp');
	$tFilename = explode('.', $_FILES['fichier']['name']);
	$extFile = array_pop($tFilename);

	if (!empty($_FILES['fichier']['name'])) {
		if (!in_array($_FILES['fichier']['type'], $autorisations)) {
			flash_in('error', 'Veuillez sélectionner le bon format de l\'image parmi JPEG, PNG, WEBP');
			$error++;
		}else{

			$newName = 'pic-'.time().'.'.$extFile;
			$chemin = $_SERVER['DOCUMENT_ROOT'] . URL . 'public/asset/data/';
			move_uploaded_file($_FILES['fichier']['tmp_name'], $chemin . $newName);
		}
	}elseif (!empty($_POST['datapreview'])) {
		list($type, $data) = explode(';', $_POST['datapreview']);
		list(, $typemime) = explode(';', $type);
		if (!in_array($extFile, $autorisations)) {
			flash_in('error', 'Veuillez sélectionner le bon format de l\'image parmi JPEG, PNG, WEBP');
			$error++;
		}else{
			list(, $donnees) = explode(',', $data);
			list(, $extension) = explode('/', $typemime);
			$newName = 'pic-'.time().'.'.$extFile;
			$chemin = $_SERVER['DOCUMENT_ROOT'] . URL . 'public/asset/data/';
			//création du fichier à partir de datapreview
			file_put_contents($chemin . $newName, base64_decode($donnees));
		}
	}else{
		$newName = $_POST['couverture_actuelle'];
	}

	if($errors == 0){
	$modif = $pdo->prepare('UPDATE avis SET lastname = :lastname, firstname = :firstname, feedback = :feedback, file = :fichier, category = :category, edited = NOW() WHERE id = :i');
	//on execute avec les valeurs
	$modif->execute([
		':fichier' => $newName,
		':lastname' => $_POST['nom_avis'],
		':firstname' => $_POST['prenom_avis'],
		':feedback' => $_POST['message_avis'],
		':category' => $_POST['categorie_avis'],
		':i' => $_POST['id']
	]);

	//flash_in
	flash_in('success', 'Le témoignage vient d\'être modifié.');
	//on redirige
	header('Location: ../reviewtable.php');
	exit();
}
else{
	
	header('location:' . $_SERVER['HTTP_REFERER']);
    exit();
}
}

