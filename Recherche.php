<?php session_start() ?>
<!DOCTYPE html>
 <html>
	<?php include ("includes/Head.php"); ?> 
	<body>

		<?php include ("includes/Header.php"); ?>



		<div id ="colonneP">



			<div id="resultatsRecherche">
					<h1> Résultat(s) de la recherche </h1>

		<?php 
		try 
			{
				$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');
			}
				catch (Exception $e)
				{
			    die('Erreur : ' . $e->getMessage());
				}

		$query=$bdd->prepare('SELECT Titre FROM rticle WHERE Titre LIKE :val ');
		$query->execute(array('val'=$_SESSION['Recherche']));
		//$titre = $query->fetch();



		?>
					<div class="resultatRecherche">
						<section>
							<h2>Lilly le petit chaton | posté par Aline Legros le 21/03/2015</h2>
							<h3>Le dédoublement de personnalité de Lilly</h3>
							<nav><a href="Article01.php"> Lire l'article</a></nav>
						</section>
					</div>
					<div class="resultatRecherche">
						<section>
							<h2>Léon le chaton | posté par Cyril Weller le 21/03/2015</h2>
							<h3> Léon le chaton à l'école des chat-sorciers </h3>
							<nav><a href="Article02.php"> Lire l'article</a></nav>
						</section>
					</div>
			</div>
		</div>
			
		<?php 
		include("includes/Menu.php"); 	//inclusion du menu latéral 
		include("includes/Footer.php");	//inclusion du footer 
		?>

		</body>
		
 </html>