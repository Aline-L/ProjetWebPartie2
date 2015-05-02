 <!DOCTYPE html>
 <html>
 
		<?php include ("includes/Head.php"); ?> 

 		 <body>

 		 <?php include ("includes/Header.php"); ?>
 		 
 		<div id="colonneP">
 		<form id="Inscription" method="post" action="Introuvable.php">
				<input name="Pseudo" type="text" placeholder="Votre Pseudo">
				<input name="Mail" type="text" placeholder="Votre adresse e-mail">
				<input name="Password" type="password" placeholder="Votre Mot de Passe">
				<input name="Password2" type="password" placeholder="Retapez otre Mot de Passe">
				<div>
					<button>S'inscrire</button> 
				</div>
		</form>
		</div>

 		<?php 
		include("includes/Menu.php"); 	//inclusion du menu latéral 
		include("includes/Footer.php");	//inclusion du footer 
		?>

		</body>
		
 </html>