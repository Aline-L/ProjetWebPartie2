<?php
	session_start();
?>
 <!DOCTYPE html>
 <html>

 	<?php include ("includes/Head.php"); ?> 

		<body>

			<?php include ("includes/Header.php"); ?>

				<div id="colonneP">

						<?php
							if(isset($_GET['id']) && (ctype_digit($_GET['id']))){
								$num_Article=$_GET['id'];
								
								include("includes/Connexion.php");
								$bdd=connect();
																
								$query1 = $bdd->prepare('SELECT Titre, Chemin_Contenu, Redacteur, Date_Ajout, Chemin_Image FROM article WHERE Numero_Article=?');
								$query1->execute(array($num_Article));
								$donnees=$query1->fetch();
								if($donnees!=null){
									echo('<article class="pageArticle" >'."\n");
										echo('<h1>'.$donnees['Titre'].' | posté par '.$donnees['Redacteur'].' le '.$donnees['Date_Ajout'].'</h1>'."\n");
										echo('<img src="'.$donnees['Chemin_Image'].'" alt="chat" width=auto height=200px>'."\n");
										echo("<section>\n");
											echo('<h2>'.$donnees['Titre'].'</h2>'."\n");
											$fichier=fopen($donnees['Chemin_Contenu'],'r');
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
										echo("</section>\n");
									echo("</article>");
								}
								else{
									header('Location:index.php');
								}
								$query1->closeCursor();
								
/*---------------------------------------PARTIE COMMENTAIRES---------------------------------------------------------*/
								echo('<div id="commentairesArticle">'."\n");
									echo('<h1>Commentaires</h1>'."\n");
									$query2 = $bdd->prepare('SELECT Identifiant, Date_Redaction, Contenu FROM commentaire WHERE Numero_Article=? AND Date_Redaction=
											(SELECT MAX(Date_Redaction) FROM commentaire WHERE Numero_Article=?)');
										$query2->execute(array($num_Article,$num_Article));	
										$nbCommentaires=$query2->rowCount();
										if($nbCommentaires==0){
											echo('<div class="commentaire">'."\n");
												echo("<p>Il n' y a pas encore de commentaire sur cet article.</p>\n");
											echo('</div>'."\n");
										}
										else{
												while($commentaire=$query2->fetch()){
													echo('<div class="commentaire">'."\n");
														if(isset($commentaire['Contenu'])){
															echo('<p><em>Par '.$commentaire['Identifiant'].' le '.$commentaire['Date_Redaction'].'</em></p>'."\n");
															echo('<q>'.$commentaire['Contenu'].'</q>'."\n");
														}
													echo('</div>'."\n");
											}
										}
							$query2->closeCursor();

							
								if(isset($_SESSION['Identifiant'])){
									echo('<form action="#" method="post">
									<textarea placeholder="Tapez votre commentaire ici" cols="80" rows="5" name="Commentaire"></textarea>
									<input type="submit" name="envoiCommentaire" value="Envoyer">');

									if(isset($_POST['envoiCommentaire'])){
										if(!empty($_POST['Commentaire'])) {
											$date= date('Y-m-d');
											$query2 = $bdd->prepare('INSERT INTO commentaire(Numero_Article, Identifiant, Date_Redaction, Contenu) VALUES (:val1, :val2, :val3, :val4)');
											$query2->execute(array('val1'=>$num_Article, 'val2'=>$identifiant,'val3'=>$date,'val4'=>$_POST['Commentaire']));
											header("Refresh: 0");
										}
									}
								}
								else{
									echo("<p>Connectez-vous ou inscrivez-vous pour laisser un commentaire!</p>\n");
								}

							}
							else{
								header('Location: index.php');
							}
							?>
						</form>	
				</div>
		</div>
			
		<?php 
		include("includes/Menu.php"); 	//inclusion du menu latéral 
		include("includes/Footer.php");	//inclusion du footer 
		?>

		</body>


 </html>
