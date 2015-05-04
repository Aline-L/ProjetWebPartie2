<?php session_start() ?>
<!DOCTYPE html>
 <html>
	<?php include ("includes/Head.php"); ?> 
	<body>

		<?php include ("includes/Header.php"); ?>



		<div id ="colonneP">



			<div id="resultatsRecherche">
					<h1> Résultat(s) de la recherche </h1>


					<div class="resultatRecherche">

		<?php 
		try 
			{
				$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');
			}
				catch (Exception $e)
				{
			    die('Erreur : ' . $e->getMessage());
				}

			$request = $_SESSION['Recherche'];

			$query=$bdd->prepare('SELECT * FROM article WHERE Titre LIKE "%'.$request.'%" ');
			$query->execute();

			while ($resultat = $query->fetch()) {

					echo '<p> Titre : '.$resultat['Titre'].' - '.
					'Date d\'Ajout : '.$resultat['Date_Ajout'].' - '. 
					'Auteur : '.$resultat['Redacteur'].' '.
					'<a href="article.php?id='.$resultat['Numero_Article'].'">Lien vers l\'article </a> </p>';
			}

			$query->closeCursor();

		?>
		</div>
		</div>
		</div>
			
		<?php 
		include("includes/Menu.php"); 	//inclusion du menu latéral 
		include("includes/Footer.php");	//inclusion du footer 
		?>

		</body>
		
 </html>