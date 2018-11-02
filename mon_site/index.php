<?php

	require 'global/bdd_call.php';
	$reponse = $bdd->query('SELECT nom, description, ID FROM pages  WHERE is_page_d_accueil = 1');
	//$reponse2 = $bdd->query('SELECT nom, description, ID FROM pages  WHERE in_menu = 1');
	while ($donnees = $reponse->fetch())
	{
        $id = $donnees['ID'];
	}
    header('Location:page/page.php?page_id='.$id);
?>
