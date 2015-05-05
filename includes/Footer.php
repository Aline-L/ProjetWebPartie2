<footer>
	<p>Designed by Aline Legros | Cyril Weller</p>	

	<?php

	try 
			{
				$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');
			}
				catch (Exception $e)
				{
			    die('Erreur : ' . $e->getMessage());
				}
	
	$query = $bdd->exec('SELECT COUNT(Identifiant) FROM utilisateur');
	$nbuser = $query1->fetch();
	
	switch ($nbuser){
		case 0:
		echo '<p>Ce blog ne compte aucun membre</p>';
		break;

		case 1:
		echo '<p>Ce blog compte 1 membre</p>';
		break;

		default:
		echo '<p>Ce blog compte actuellement '.$nbuser.' membres</p>';
		break;
	}
	?>
</footer>