

<?php
	$reponse = $bdd->query('SELECT contenu, type FROM '. $nom);
	while ($data = $reponse->fetch())
	{
		if($data['type']=='textarea'){
			echo '<div class="module">'.$data['contenu'].'</div>';
		}
	}
	$reponse->closeCursor();
	
?>