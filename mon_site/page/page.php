<?php
	require '../global/bdd_call.php';
    if (isset($_GET['page_id']))
    {
        $rep = $bdd->query('SELECT nom, description FROM pages WHERE ID='.$_GET['page_id']);
        $n=0;
        while($donnee=$rep->fetch()){
            $n++;
            $nom=$donnee['nom'];
            $description=$donnee['description'];
        }
        $rep->closeCursor();
        $id = $_GET['page_id'];
        if($n!=1){
            header('Location:../index.php');
        }
    } else {
        header('Location:../index.php');
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?=$nom?></title>
        <link rel="stylesheet" type="text/css" href="../CSS/reset.css">
        <link rel="stylesheet" type="text/css" href="../CSS/page.css">
    </head>
    <body>
    	<header class="page_header">
    		<nav>
    			<ol>
	    			<?php
                        $name_list=[];
                        $reponse = $bdd->query('SELECT nom, description, ID FROM pages  WHERE in_menu = 1');
	    				while ($data = $reponse->fetch())
						{
                            echo '<li><a href=page.php?page_id='.$data['ID'].'>'.$data['nom'].'</a></li>';
                            array_push($name_list, $data['nom']);
						}
                        $reponse->closeCursor();
	    			?>
    			</ol>
    		</nav>
    	</header>
    	<section>
    		<h1><?=$nom?></h1>
        	<div class="descripton"><?=$description?></div>
            <?php require 'get_modules_in_page.php'?>
    	</section>
	</form>
    </body>
</html>












