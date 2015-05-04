 <?php session_start() ?>
 <!DOCTYPE html>
 <html>
 
		<?php include ("includes/Head.php"); ?> 

 		 <body>

 		 <?php include ("includes/Header.php"); ?>
 		 
 		<div id="colonneP">
 		<form id="Inscription" method="post" action="#" >
				<input name="Identifiant" type="text" placeholder="Votre Pseudo">
				<input name="Mail" type="text" placeholder="Votre adresse e-mail">
				<input name="Mot_de_Passe" type="password" placeholder="Votre Mot de Passe">
				<input name="Mot_de_Passe2" type="password" placeholder="Retapez votre Mot de Passe">
				<div>
					<input name="Signin" value="S'inscrire" type="submit">
				</div>
			</form>	

		<?php
		if(!isset($_POST['Identifiant']) OR !isset($_POST['Mail'])
			OR !isset($_POST['Mot_de_Passe']) OR !isset($_POST['Mot_de_Passe2'])){

			echo "<p> Veuillez remplir tous les champs ! </p>";	
		}
		
		elseif($_POST['Mot_de_Passe'] != $_POST['Mot_de_Passe2']){
			echo "<p> Mots de passe différents ! </p>";		
		
		}

		if( isset($_POST['Signin']) ) // si formulaire soumis
			{
			try 
				{
					$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');
				}
					catch (Exception $e)
				{
					die('Erreur : ' . $e->getMessage());
				}

		$date = date('Y-m-d');
		$type = "user";
		$query=$bdd->prepare('INSERT INTO utilisateur(Identifiant, Mot_de_Passe, Date_Inscription, Type) VALUES(:val1, :val2, :val3, :val4)');
		$query->execute(array('val1'=>$_POST['Identifiant'], 'val2'=>$_POST['Mot_de_Passe'], 'val3'=>$date,'val4'=>$type));
		echo('<p>Vous êtes inscrit !</p>');
		}

		?>

		</div>
		

 		<?php 
		include("includes/Menu.php"); 	//inclusion du menu latéral 
		include("includes/Footer.php");	//inclusion du footer 
		?>

		</body>
		
 </html>