 <!DOCTYPE html>
 <html>
 
		<?php include ("Head.php") ?> 

 		 <body>

 		 <?php include ("Header.php"); ?>

 		 <div id="colonneP">
			<form id="Connexion" action="Introuvable.php">
				<input name="Pseudo" type="text" placeholder="Votre Pseudo">
				<input name="Password" type="password" placeholder="Votre Mot de Passe">
				<div>
					<button>Se connecter</button> 
				</div>
			</form>
		</div>

 		<?php 
		include("Menu.php"); 	//inclusion du menu latéral 
		include("Footer.php")	//inclusion du footer 
		?>

		</body>
		
 </html>