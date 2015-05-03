<!DOCTYPE html>
 <html>
 
		<?php include ("includes/Head.php"); ?> 

 		 <body>

 		 <?php include ("includes/Header.php"); ?>

 		 <div id="colonneP">
			<form id="Connexion" method="post" action="#">
				<input name="Pseudo" type="text" placeholder="Votre Pseudo">
				<input name="Password" type="password" placeholder="Votre Mot de Passe">
				<div>
					<input name="Connexion" value="Se Connecter" type="submit">
				</div>
			</form>
		</div>


		<?php

 		if( isset($_POST['Connexion']) ){
			try 
			{
				$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');
			}
				catch (Exception $e)
				{
			    die('Erreur : ' . $e->getMessage());
				}

			$pseudo = $_POST['Pseudo'];
			$password = $_POST['Password'];

			$query = $bdd->prepare('SELECT Identifiant FROM Utilisateur WHERE Identifiant = ?');
			$query->execute(array($pseudo));
			
			if($pseudo=$query->fetch()) 
						{ 
							$query2 = $bdd->prepare('SELECT Mot_De_Passe FROM Utilisateur WHERE Mot_De_Passe = ?');
							$query2->execute(array($password));
							if($password=$query2->fetch()) 
										{ 
											/*echo '<p> vous êtes à présent connecté(e) </p>';*/
											session_start();
	 										$_SESSION['Pseudo'] = $_POST['Pseudo'];
										}

							else 
									{
									echo ('<p>Mot de passe Incorrect.</p>');
								}	
						}
			else 
				{
					echo ('<p>Identifiants erronés.</p>');
				}	

		}

		include("includes/Menu.php"); 	//inclusion du menu latéral 
		include("includes/Footer.php");	//inclusion du footer 
		?>

		</body>
		
 </html>