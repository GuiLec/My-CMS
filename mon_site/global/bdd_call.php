<?php
try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=mon_site;charset=utf8', 'root', 'root');
	}
catch(Exception $e)
	{
	        die('Erreur : '.$e->getMessage());
	}
?>