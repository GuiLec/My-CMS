<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Gestionnaire de pages</title>
    </head>
    <body>
    	<?php
    		require '../../global/bdd_call.php';
    		$reponse = $bdd->query('SELECT ID FROM pages WHERE is_page_d_accueil=1');
    		$accueil = 0;
    		while ($donnees = $reponse->fetch()){
    			$accueil++;
    		}
    	?>
        <h1>Gestionnaire de pages</h1>
        <div id="message_temporaire">
            <?php if (isset($_GET['echec'])&&$_GET['echec']=='accueil'){
            	echo '<p style="color:red">Echec de l\'ajout de la page : il ne peut y avoir qu\'une seule page d\'accueil.</p>';
            }elseif (isset($_GET['succes'])&&$_GET['succes']=='delete') {
            	echo '<p style="color:green">La page a été supprimée.</p>';
            }elseif (isset($_GET['succes'])&&$_GET['succes']=='update') {
            	echo '<p style="color:green">La page a été modifiée.</p>';
            }elseif (isset($_GET['echec'])&&$_GET['echec']=='Annuler') {
            	echo '<p style="color:red">Modification annulée.</p>';
            }elseif (isset($_GET['succes'])&&$_GET['succes']=='add') {
            	echo '<p style="color:green">La page a été ajoutée.</p>';
            }elseif (isset($_GET['echec'])&&$_GET['echec']=='page_name'){
                echo '<p style="color:red">Echec de l\'ajout de la page : 2 pages ne peuvent pas avoir le même nom.</p>';
            }
            ?>
        </div>
        <?php
        if ($accueil != 1) {
        	echo '<p style="color:red">Il faut une unique page d\'accueil ('.$accueil.')</p>';
        }
        ?>
        <p>Liste des pages.</p>
        <ul id="page_list">
	        <?php
			$reponse = $bdd->query('SELECT nom, ID FROM pages');
			while ($donnees = $reponse->fetch())
			{
				echo '<li>'.$donnees['nom'] . ' &emsp;<a href="update_page.php?id_to_update='.$donnees['ID'].'" ><small>Éditer</small></a> <a href="delete_page_post.php?id_to_delete='.$donnees['ID'].'&nom='.$donnees['nom'].'" style="color:red; text-decoration:none" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer la page ?\')"><small>X</small></a></li>';
			}
			$reponse->closeCursor();
			?>
		</form>
		</ul>
		<script type="text/javascript">
			function show_form(){
				document.getElementById("add_page_form").style="display:true";
				document.getElementById("add_page_button").disabled=true;
				document.getElementById("new_page_name").autofocus="autofocus";
			}
		</script>
		<button id="add_page_button" onclick="show_form()">Ajouter une page</button>
		<p></p>
		<form id="add_page_form" action="add_page_post.php" method="post" style="display:none">
			<label for="new_page_name">Titre : </label><input id="new_page_name" type="text" name="new_page_name" placeholder="Nom de la page à ajouter" required><br/>
			<input type="checkbox" id="is_page_d_accueil" name="is_page_d_accueil" value="yes"><label for="is_page_d_accueil"><small>&nbsp; Cocher si page d'accueil</small></label><br/>
			<input type="submit" value="Ajouter">
		</form>
    </body>
</html>