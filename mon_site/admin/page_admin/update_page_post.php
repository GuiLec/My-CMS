<?php
	require '../../global/bdd_call.php';

//=====================================================		
	//D'abord mettre les contenus existants de la page
	$nom_table = $_POST['nom'];
	$reponse = $bdd->query('SELECT id FROM '.$nom_table);
	while ($donnees = $reponse->fetch()){
		$req = $bdd->prepare('UPDATE '.$nom_table.' SET contenu = :nvcontenu WHERE id='.$donnees['id']);
		$req->execute(array(
			'nvcontenu' => $_POST['module_'.$donnees['id']]
		));
	}
//=====================================================		
	//Puis ajouter les nouveaux modules à la page

	for ($i = 0; $i < $_GET['nombre_de_nvmodule']; $i++){
		$req = $bdd->prepare("INSERT INTO $nom_table(contenu,type) VALUES(:contenu, :type)");
		$req->execute(array(
			'contenu' => $_POST['nvmodule'.($i+1)],
			'type' => "textarea"
		));
	}


//=====================================================
	//Mettre à jour la BDD "pages"
	$reponse = $bdd->query('SELECT ID, nom FROM pages  WHERE is_page_d_accueil = 1');
	$data=0;
	while ($donnees = $reponse->fetch()){
		$data++;
		$page_ID=$donnees['ID'];
	}

	if ($data == 0 || $_POST['is_page_d_accueil'] != "yes" || $page_ID==$_GET['id_to_update']){
		$req = $bdd->prepare('UPDATE pages SET is_page_d_accueil = :nvis_page_d_accueil, description = :nvdescription WHERE ID='.$_GET['id_to_update']);
		$req->execute(array(
			'nvis_page_d_accueil' => ($_POST['is_page_d_accueil']=="yes" ? 1 : 0),
			'nvdescription' => $_POST['description']
		));
		header('Location: page_manager.php?succes=update');
	}else{

		header('Location: update_page.php?echec=accueil&id_to_update='.$_GET['id_to_update']);
	}
	$reponse->closeCursor();

?>