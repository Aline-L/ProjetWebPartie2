 <!DOCTYPE html>
 <html>
 
		<?php include ("includes/Head.php"); ?> 

 		 <body>

 		 <?php include ("includes/Header.php"); ?>

 		 <div id="colonneP">
			<form id="Connexion" method="post" action="Introuvable.php">
				<input name="Pseudo" type="text" placeholder="Votre Pseudo">
				<input name="Password" type="password" placeholder="Votre Mot de Passe">
				<div>
					<button>Se connecter</button> 
				</div>
			</form>
		</div>

 		<?php 
		include("includes/Menu.php"); 	//inclusion du menu latéral 
		include("includes/Footer.php");	//inclusion du footer 
		?>

		</body>
		
 </html>