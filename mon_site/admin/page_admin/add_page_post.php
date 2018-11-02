<?php

	require '../../global/bdd_call.php';
	$accueil= (isset($_POST['is_page_d_accueil']) ? 1 : 0);
	$reponse = $bdd->query('SELECT nom FROM pages  WHERE is_page_d_accueil = 1');
	$data=0;
	while ($donnees = $reponse->fetch())
		{
			$data++;
		}
	$reponse2 = $bdd->query('SELECT nom FROM pages');
	$name_list = [];
	while ($donnees = $reponse2->fetch()){
		array_push($name_list, $donnees['nom']);
	}

	if(!in_array($_POST['new_page_name'], $name_list)){
		if ($data == 0 || $accueil == 0){
			$req = $bdd->prepare('INSERT INTO pages(nom, is_page_d_accueil) VALUES(:nom, :is_page_d_accueil)');
			$req->execute(array(
				'nom' => $_POST['new_page_name'],
				'is_page_d_accueil' => $accueil
			));
			add_table($_POST['new_page_name']);
			header('Location: page_manager.php?succes=add');

		}else{

			header('Location: page_manager.php?echec=accueil');
		}		
	} else {
		header('Location: page_manager.php?echec=page_name');
	}

	$reponse->closeCursor();


	function add_table($name){
		// Create connection
		$conn = new mysqli('localhost', 'root', 'root', 'mon_site');
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}
		// sql to create table
		$sql = "CREATE TABLE $name (id INT PRIMARY KEY NOT NULL AUTO_INCREMENT, type VARCHAR(255), contenu TEXT)";

		if ($conn->query($sql) === TRUE) {
		    echo "Table MyGuests created successfully";
		} else {
		    echo "Error creating table : " . $conn->error;
		}
	}
?>