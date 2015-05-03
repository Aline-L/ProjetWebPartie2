<!DOCTYPE html>
 <html>

		<?php include ("includes/Head.php"); ?> 

 		 <body>

 		 <?php include ("includes/Header.php"); ?>
		
 		<div id="colonneP">
			<h1> Formulaire d'ajout d'article </h1>
			<form id="soumissionArticle" method="post" action="Introuvable.php">
				<input name="Auteur" type="text" placeholder="Auteur">
				<input name="Titre" type="text" placeholder="Titre">
				<textarea placeholder="Tapez le résumé de votre article ici" cols="80" rows="10"></textarea>
				<textarea placeholder="Tapez votre article complet ici" cols="80" rows="10"></textarea>

				<div>	
					<p>Télecharger une image : </p>
					<input name="Image" type="file">
				</div>
				<div>
					<button>Soumettre l'article</button> 
					<button>Annuler</button>
				</div>
			</form>
		</div>

		<?php 
		include("includes/Menu.php"); 	//inclusion du menu latéral 
		include("includes/Footer.php");	//inclusion du footer 
		?>

		</body>
		
 </html>
