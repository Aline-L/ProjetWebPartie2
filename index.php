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
						try 
						{
							$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');
						}
							catch (Exception $e)
						{
							die('Erreur : ' . $e->getMessage());
						}
						$result = $bdd->query('SELECT COUNT(Numero_Article) FROM article');
						$donnee= $result->fetch();
<<<<<<< HEAD
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
											echo('<img src="'.$donnees['Chemin_Image'].'" alt="chat" width=300px height=300px>'."\n");
										echo("</div>\n");
										
										echo('<div class="texte_article">'."\n");
											echo("<section>");
												echo('<h2>'.$donnees['Titre'].'</h2>'."\n");
												$fichier=fopen($donnees['Chemin_Resume'],'r');
												if($fichier!=null){
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
=======
						$num_Article=$donnee['MaxNum'];
						if($num_Article==0){
							echo("<p>Il n'y a pas encore d'article sur ce blog!</p>");
						}
						else{
								$query1 = $bdd->query('SELECT Titre, Chemin_Resume, Redacteur, Date_Ajout, Chemin_Image FROM article ORDER BY Numero_Article DESC');
								while ($donnees = $query1->fetch())
								{
									echo "<article>";
										echo '<h1>'.$donnees['Titre'].' | posté par '.$donnees['Redacteur'].' le '.$donnees['Date_Ajout'].'</h1>';
										echo '<div class="image_article">';
											echo '<img src="'.$donnees['Chemin_Image'].'" alt="chat" width=300px height=300px>';
										echo "</div>";
										
										echo '<div class="texte_article">';
											echo "<section>";
												echo '<h2>'.$donnees['Titre'].'</h2>';
												$fichier=fopen($donnees['Chemin_Resume'],'r');
												if($fichier!=null){
													$ligne=fgets($fichier);
													echo '<p>';
													while($ligne){
														echo $ligne;
														$ligne=fgets($fichier);
													}
													fclose($fichier);
													echo '</p>';
												}
												echo '<nav><a href="article.php?id='.$num_Article.'"> Lire la suite... </a></nav>';
											echo "</section>";
											
											echo "<section>";
												echo "<h2>Dernier commentaire sur cet article</h2>";
>>>>>>> origin/master
										
												$query2 = $bdd->prepare('SELECT Identifiant, Date_Redaction, Contenu FROM commentaire WHERE Numero_Article=? AND Date_Redaction=
													(SELECT MAX(Date_Redaction) FROM commentaire WHERE Numero_Article=?)');
												$query2->execute(array($num_Article,$num_Article));
												$nbCommentaires=$query2->rowCount();
												if($nbCommentaires==0) {
<<<<<<< HEAD
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
=======
													echo "<p>Il n' y a pas encore de commentaire sur cet article.</p>";
												}
												else{
													$commentaire=$query2->fetch();
													echo '<p><q>'.$commentaire['Contenu'].'</q> - par '.$commentaire['Identifiant'].' le '.$commentaire['Date_Redaction'].'</p>';
												}
												$query2->closeCursor();
											echo "</section>";
										echo "</div>";
									echo "</article>";
								$num_Article=$num_Article-1;	
>>>>>>> origin/master
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
