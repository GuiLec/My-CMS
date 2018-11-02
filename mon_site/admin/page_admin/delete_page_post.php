<?php
	require '../../global/bdd_call.php';
	
	$bdd->exec('DELETE FROM pages WHERE ID='.$_GET['id_to_delete']);

	$conn = new mysqli('localhost', 'root', 'root', 'mon_site');
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	// sql to drop table
	$nom = $_GET['nom'];
	$sql = "DROP TABLE $nom";
	if ($conn->query($sql) === TRUE) {
	    echo "Table deleted successfully";
	} else {
	    echo "Error deleting table : " . $conn->error;
	}

	
	header('Location: page_manager.php?succes=delete');

?>