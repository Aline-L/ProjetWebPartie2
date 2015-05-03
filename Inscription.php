 <?php session_start() ?>
 <!DOCTYPE html>
 <html>
 
		<?php include ("includes/Head.php"); ?> 

 		 <body>

 		 <?php include ("includes/Header.php"); ?>
 		 
 		<div id="colonneP">
 		<form id="Inscription" method="post" action="#">
				<input name="PseudoInscription" type="text" placeholder="Votre Pseudo">
				<input name="Mail" type="text" placeholder="Votre adresse e-mail">
				<input name="Password" type="password" placeholder="Votre Mot de Passe">
				<input name="Password2" type="password" placeholder="Retapez votre Mot de Passe">
				<div>
					<button>S'inscrire</button> 
				</div>
		</form>

		<?php
		if($_POST['PseudoInscription'] == null OR $_POST['Mail'] == null 
			OR $_POST['Password'] == null OR $_POST['Password2'] == null){

			echo "<p> Veuillez remplir tous les champs ! </p>";	
		}
		
		elseif($_POST['Password'] != $_POST['Password2']){
			echo "<p> Mots de passe différents ! </p>";		
		}
		?>

		</div>
		

 		<?php 
		include("includes/Menu.php"); 	//inclusion du menu latéral 
		include("includes/Footer.php");	//inclusion du footer 
		?>

		</body>
		
 </html>