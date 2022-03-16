<?php //fichier admin/core/deletereview.php

require_once('../../config/settings.php');

if (!empty($_GET['reviewid'])) {
	$avis = executeSQL("SELECT * FROM avis WHERE id=:id", array('id' => $_GET['reviewid']));

	if ($avis->rowCount() == 1) {

		// Suppression de la photo
		$infos = $avis->fetch();
		$couverture = $infos['file'];
		$chemin = $_SERVER['DOCUMENT_ROOT'] . URL . 'public/asset/data/';
		if (!empty($couverture) && file_exists($chemin . $couverture)) {
			// on supprime le fichier
			unlink($chemin . $couverture);
		}
		// Suppression en DB
		executeSQL("DELETE FROM avis WHERE id = :id", array('id' => $_GET['reviewid']));
		flash_in('success','Le témoignage vient d\'être supprimé');
	} 
	else{
		flash_in('error', 'Avis inexistant');
	}
	header('Location: ../reviewtable.php');
	exit();
}