<?php
	require '../../global/bdd_call.php';
	if(isset($_GET['id_to_update'])){
		$reponse=$bdd->query('SELECT nom, is_page_d_accueil, description FROM pages where ID='.$_GET['id_to_update']);
	}else{
		header('Location: page_manager.php');
	}
	$donnee=$reponse->fetch();
	
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?=$donnee['nom']?> - Édition</title>
    </head>
    <body>
        <h1><?=$donnee['nom']?> - Édition</h1>
        <?php if (isset($_GET['echec'])&&$_GET['echec']=='accueil'){
        	echo '<p style="color:red">Echec de modification de la page : il existe déjà une page d\'accueil.</p>';
        }
        ?>
        <form id="modifier_form" method="post" action=<?='update_page_post.php?id_to_update='.$_GET['id_to_update']?>>
        	<label for="titre">Titre : </label><input type="text" name="nom" required readonly value=<?= '"'.$donnee['nom'].'"'?>><br/>
        	<input type="checkbox" name="is_page_d_accueil" value="yes" <?php if($donnee['is_page_d_accueil']==1){echo 'checked';}?>><label for="is_page_d_accueil"><small>&nbsp; Cocher si page d'accueil</small></label><br/>
    		<label for="description">Description : </label><br/><textarea name="description"><?=$donnee['description']?></textarea><br/>
            <p>Modules :</p>
            <?php require 'get_modules_in_uptate_page.php'?>
            <button type=button onclick="add_field()" id="add_button">+</button><br/><br/>
			<input type="submit" value="Modifier" onclick="passer_nb_de_modules()">
		</form>
		<form action="page_manager.php?echec=cancel" method="get">
			<input type="submit" name="echec" value="Annuler">
		</form>

        <script type="text/javascript" src="JS/update_page.js"></script>
    </body>
</html>





