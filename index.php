 <?php
	session_start();
?>
 <!DOCTYPE html>
 <html>

 	<?php include ("includes/Head.php"); ?> 

	<body>

		<header>
			<section>
				<h1> Un jour, un chaton</h1>
				<p>
					<em>Ce blog vous fera découvrir chaque jour un nouveau petit chaton.</em>
				</p>	
			</section>
		</header>

			<div id="colonneP">
					
			<?php
				include_once("includes/Connexion.php");
				$bdd=connect();

				$result = $bdd->query('SELECT COUNT(Numero_Article) FROM article');
				$donnee=$result->fetch();
				$donnee= $donnee['COUNT(Numero_Article)'];
			
				if($donnee==0){
					echo("<p>Il n'y a pas encore d'article sur ce blog!</p>");
				}
				else{
									
					$query1 = $bdd->query('SELECT Numero_Article, Titre, Chemin_Resume, Redacteur, Date_Ajout, Chemin_Image FROM article ORDER BY Numero_Article DESC');
					
					while ($donnees = $query1->fetch())
					{
						$num_Article=$donnees['Numero_Article'];
						echo("<article>\n");
							echo('<h1>'.$donnees['Titre'].' | posté par '.$donnees['Redacteur'].' le '.$donnees['Date_Ajout'].'</h1>'."\n");
							echo('<div class="image_article">'."\n");
								echo('<img src="'.$donnees['Chemin_Image'].'" alt="chat" width=auto height=200px>'."\n");
							echo("</div>\n");
											
							echo('<div class="texte_article">'."\n");
								echo("<section>");
									echo('<h2>'.$donnees['Titre'].'</h2>'."\n");
									$fichier=fopen($donnees['Chemin_Resume'],'r');
										if($fichier!=null)
										{
											$ligne=fgets($fichier);
											echo('<p>'."\n");
											while($ligne){
													echo($ligne);
													$ligne=fgets($fichier);
												}
											fclose($fichier);
											echo('</p>'."\n");
										}
										echo('<nav><a href="article.php?id='.$num_Article.'"> Lire la suite... </a></nav>'."\n");
								echo("</section>\n");
												
								echo("<section>\n");
									echo("<h2>Dernier commentaire sur cet article</h2>\n");
											
										$query2 = $bdd->prepare('SELECT Identifiant, Date_Redaction, Contenu FROM commentaire WHERE Numero_Article=? AND Date_Redaction=
														(SELECT MAX(Date_Redaction) FROM commentaire WHERE Numero_Article=?)');
										$query2->execute(array($num_Article,$num_Article));
										$nbCommentaires=$query2->rowCount();
										if($nbCommentaires==0) {
											echo("<p>Il n' y a pas encore de commentaire sur cet article.</p>\n");
											}
										else{
											$commentaire=$query2->fetch();
											echo('<p><q>'.$commentaire['Contenu'].'</q> - par '.$commentaire['Identifiant'].' le '.$commentaire['Date_Redaction'].'</p>'."\n");
											}
										$query2->closeCursor();
								echo("</section>\n");
							echo("</div>\n");
						echo("</article>\n");
						}
						$query1->closeCursor();
					}
				?>


			</div>

		<?php 
		include("includes/Menu.php"); 	//inclusion du menu latéral 
		include("includes/Footer.php");	//inclusion du footer 
		?>

		</body>

 </html>
