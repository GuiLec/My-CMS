<?php
	$page = $donnee['nom'];
	require '../../global/bdd_call.php';
	$reponse = $bdd->query('SELECT contenu, type, id FROM '. $page);
	while ($data = $reponse->fetch())
	{
		if($data['type']=='textarea'){
			echo '<textarea name=module_'.$data['id'].'>'.$data['contenu'].'</textarea><br/>';
		}
	}
	$reponse->closeCursor();
?>