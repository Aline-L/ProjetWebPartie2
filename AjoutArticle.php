 <?php
	session_start();
	if(isset($_SESSION['identifiant']))
	{
		$identifiant=$_SESSION['identifiant'];
	}
?>
 <!DOCTYPE html>
 <html>
		<?php include ("includes/Head.php"); ?> 

 		 <body>

 		 <?php include ("includes/Header.php"); ?>
 		<div id="colonneP">
			<h1> Formulaire d'ajout d'article </h1>
			<form action="AjoutArticle.php" method="post" enctype="multipart/form-data">
				<input name="Titre" type="text" placeholder="Titre"/>
				<textarea name="Resume" placeholder="Tapez le résumé de votre article ici" cols="80" rows="10"></textarea>
				<textarea name="Article" placeholder="Tapez votre article complet ici" cols="80" rows="10"></textarea>
				<div>	
					<p>Télecharger une image : </p>
					<input type="file" name="fichier" size="30">
				</div>
				<div>
					<input type="submit" name="soumissionArticle" value="Soumettre">
				</div>
		<?php
			if( isset($_POST['soumissionArticle']) ) // si formulaire soumis
			{
			try 
				{
					$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');
				}
					catch (Exception $e)
				{
					die('Erreur : ' . $e->getMessage());
				}
			    
				$content_dir = './images/';
			    $emplacementTemporaire = $_FILES['fichier']['tmp_name'];

			    if( !is_uploaded_file($emplacementTemporaire) )
			    {
			        echo('<p>Le fichier est introuvable</p>');
			    }
				else{
						// on vérifie maintenant l'extension
						$infosfichier = pathinfo($_FILES['fichier']['name']);
						$type_fichier = $infosfichier['extension'];
						$ext_autorisees= array('png','jpeg','jpg','gif');
						
						if(!in_array($type_fichier,$ext_autorisees)){
							echo('<p>Le fichier n\'est pas valide</p>');
						}
						else{
								//on place l'images dans le dossier "images" du serveur
								$nom_fichier = $_FILES['fichier']['name'];
								move_uploaded_file($emplacementTemporaire, $content_dir . basename($nom_fichier));
								// on créer une instance dans la table Utilisateur
								$date= date('Y-m-d');
								$query=$bdd->prepare('INSERT INTO article(Titre,Resume,Contenu,Redacteur,Date_Ajout,Chemin_Image) VALUES(:val1, :val2, :val3, :val4, :val5, :val6)');
								$query->execute(array('val1'=>$_POST['Titre'], 'val2'=>$_POST['Resume'], 'val3'=>$_POST['Article'],'val4'=>"test", 'val5'=>$date,'val6'=>$content_dir.$nom_fichier));
								echo('<p>Article bien envoyé!</p>');
							}
					}
			}
		?>
			</form>
		</div>

		<?php 
		include("includes/Menu.php"); 	//inclusion du menu latéral 
		include("includes/Footer.php");	//inclusion du footer 
		?>

		</body>
		
 </html>
