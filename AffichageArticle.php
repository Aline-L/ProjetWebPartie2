 <!DOCTYPE html>
 <html>

 	<?php include ("includes/Head.php"); ?> 

		<body>

			<?php include ("includes/Header.php"); ?>

				<div id="colonneP">
						<?php 
							if(isset($_GET['id'])){
								$num_Article=$_GET['id'];
								try 
								{
									$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');
								}
									catch (Exception $e)
								{
									die('Erreur : ' . $e->getMessage());
								}
								
								$query1 = $bdd->prepare('SELECT Titre, Chemin_Contenu, Redacteur, Date_Ajout, Chemin_Image FROM article WHERE Numero_Article=?');
								$query1->execute(array($num_Article));
								$donnees=$query1->fetch();
								echo '<article class="pageArticle" >';
									echo '<h1>'.$donnees['Titre'].' | posté par '.$donnees['Redacteur'].' le '.$donnees['Date_Ajout'].'</h1>';
									echo '<img src="'.$donnees['Chemin_Image'].'" alt="chat" width=300px height=300px>';
									echo "<section>";
										echo '<h2>'.$donnees['Titre'].'</h2>';
										$fichier=fopen($donnees['Chemin_Contenu'],'r');
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
									echo "</section>";
								echo"</article>";
								
								echo '<div id="commentairesArticle">';
									echo '<h1>Commentaires</h1>';
									$query2 = $bdd->prepare('SELECT Identifiant, Date_Redaction, Contenu FROM commentaire WHERE Numero_Article=? AND Date_Redaction=
											(SELECT MAX(Date_Redaction) FROM commentaire WHERE Numero_Article=?)');
										$query2->execute(array($num_Article,$num_Article));	
										$nbCommentaires=$query2->rowCount();
										if($nbCommentaires==0){
											echo '<div class="commentaire">';
												echo "<p>Il n' y a pas encore de commentaire sur cet article.</p>";
											echo '</div>';
										}
										else{
												while($commentaire=$query2->fetch()){
													echo '<div class="commentaire">';
														if(isset($commentaire['Contenu'])){
															echo '<p><em>Par '.$commentaire['Identifiant'].' le '.$commentaire['Date_Redaction'].'</em></p>';
															echo '<q>'.$commentaire['Contenu'].'</q>';
														}
													echo '</div>';
											}
										}
							$query2->closeCursor();
							$query1->closeCursor();
							}
						?>

							<form action="Introuvable.php">
									<textarea placeholder="Tapez votre commentaire ici" cols="80" rows="5"></textarea>
									<button>Envoyer</button>
							</form>
						<?php echo'</div>'; ?>

				</div>
			
		<?php 
		include("includes/Menu.php"); 	//inclusion du menu latéral 
		include("includes/Footer.php");	//inclusion du footer 
		?>

		</body>


 </html>
