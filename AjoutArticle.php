 <?php
	session_start();
	if(isset($_SESSION['Identifiant']))
	{
		$identifiant=$_SESSION['Identifiant'];
	}
	else
	{
		header("Location: Connexion.php");
	}
?>
 <html>
		<?php include ("includes/Head.php"); ?> 

 		 <body>

 		 <?php include ("includes/Header.php"); ?>
 		<div id="colonneP">
			<h1> Formulaire d'ajout d'article </h1>
			<form id="soumissionArticle" action="AjoutArticle.php" method="post" enctype="multipart/form-data">
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
			</form>
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
				// on récupère le "Type" (user/webmaster) de l'utilisateur
				$result = $bdd->prepare('SELECT Type AS typeUser FROM utilisateur WHERE Identifiant=:val');
				$result->execute(array('val'=>$identifiant));
				$donnee=$result->fetch();
				$typeUtilisateur=$donnee['typeUser'];
				$result->closeCursor();
				
				// on teste si l'utilisateur est bien de type "webmaster"
				$typeUtilisateur2=strtolower($typeUtilisateur);
				$emplacementTemporaire = $_FILES['fichier']['tmp_name'];
				if(strcmp($typeUtilisateur2,"webmaster")==0){
				/* NE FONCTIONNE PAS */
					if(!isset($_POST['Titre']) OR !isset($_POST['Article']) OR !isset($_POST['Resume'])){
							echo("<p>Veuillez renseigner les champs</p>\n");
						}
					else{
						if( !is_uploaded_file($emplacementTemporaire) ){
							echo('<p>Le fichier est introuvable</p>'."\n");
						}
						else{
							
								// on vérifie maintenant l'extension
									$infosfichier = pathinfo($_FILES['fichier']['name']);
									$type_fichier = $infosfichier['extension'];
									$ext_autorisees= array('png','jpeg','jpg','gif');
									
									if(!in_array($type_fichier,$ext_autorisees)){
										echo('<p>Le fichier n\'est pas valide</p>'."\n");
									}
									
									else{
											//on place l'images dans le dossier "images" du serveur
											$nom_fichier = $_FILES['fichier']['name'];
											$content_dir = './imagesArticles/';
											move_uploaded_file($emplacementTemporaire, $content_dir . basename($nom_fichier));
														
											//on créér 2 fichiers txt : l'un contenant le résumé, l'autre l'article ;
											$result = $bdd->query("SELECT MAX(Numero_Article) AS MaxNum FROM article ");
											$donnee= $result->fetch();
											$maxNumArticle=$donnee['MaxNum'];
											$numNouvelArticle=$maxNumArticle+1;
														
											$cheminContenu='.\articles\article'.$numNouvelArticle.'.txt';
											$fichier=fopen($cheminContenu,'w');
											if($fichier!=null){
												fputs($fichier,$_POST['Article']);
												fclose($fichier);
											}
														
											$cheminResume='.\resumes\resume'.$numNouvelArticle.'.txt';
											$fichier=fopen($cheminResume,'w');
											if($fichier!=null){
												fputs($fichier,$_POST['Resume']);
												fclose($fichier);
											}
											
											// on créer une instance dans la table Utilisateur
											$date= date('Y-m-d');
											$query2=$bdd->prepare('INSERT INTO article(Numero_Article,Titre,Chemin_Resume,Chemin_Contenu,Redacteur,Date_Ajout,Chemin_Image) VALUES(:val1, :val2, :val3, :val4, :val5, :val6, :val7)');
											$query2->execute(array('val1'=>$numNouvelArticle,'val2'=>$_POST['Titre'], 'val3'=>$cheminResume, 'val4'=>$cheminContenu,'val5'=>$identifiant, 'val6'=>$date,'val7'=>$content_dir.$nom_fichier));
											echo('<p>Article bien envoyé!</p>'."\n");
										}
							
							
							}
					
						}
				}
				else{// cas où l'utilisateur est de type "user"
					echo("<p> Vous n'êtes pas autorisé(e) à ajouter un article.</p>\n");
				}
			}
		?>
			
		</div>

		<?php 
		include("includes/Menu.php"); 	//inclusion du menu latéral 
		include("includes/Footer.php");	//inclusion du footer 
		?>

		</body>
		
 </html>
