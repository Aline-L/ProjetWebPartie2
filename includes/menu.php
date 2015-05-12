<aside><h3>Utilisateur</h3><nav><ul> 
<?php

//CAS OU L'UTILISATEUR CONNECTE
if(!empty($_SESSION['Identifiant'])){

 	//on affiche que l'utilisateur est connecté
	echo '<li><p><em>Connecté(e) sous le pseudo : </em></p><p>'.$_SESSION['Identifiant'].'</p></li>';

	//on affiche le bouton de déconnexion: envoi en post vers une page pour le raffraichissement de la page
	echo '<form method="post" action="aurevoir.php">
				<li><input name="Deconnexion" value="Se déconnecter" type="submit"></li>
		</form>';
	if(isset($_POST['Deconnexion'])){
		session_destroy();
	}
	

	include_once("./includes/connexion.php");
	$bdd=connect();

	
	$query5=$bdd->prepare('SELECT DATE_FORMAT(Date_Inscription,\'%d/%m/%Y\') AS Date FROM utilisateur WHERE Identifiant = ?');
	$query5->execute(array($_SESSION['Identifiant']));
	$resultat = $query5->fetch();
	echo'<li><em> Inscrit(e) le : </em>'.$resultat['Date'].'</li>';
	$query5->closeCursor();


	//Affichage du nombre d'articles
	$result = $bdd->prepare('SELECT Type AS typeUser FROM utilisateur WHERE Identifiant=:val');
	$result->execute(array('val'=>$_SESSION['Identifiant']));
	$donnee=$result->fetch();
	$typeUtilisateur=strtolower($donnee['typeUser']);
	$result->closeCursor();
	if(strcmp($typeUtilisateur,"webmaster")==0){
		$query6=$bdd->prepare('SELECT COUNT(Numero_Article) FROM article WHERE Redacteur = ?');
		$query6->execute(array($_SESSION['Identifiant']));
		$resultat = $query6->fetch();
		echo'<li><em>Article(s) : </em>'.$resultat[0].'</li>';
		$query6->closeCursor();
	}


	//Affichage du nombre de commentaires 
	$query7=$bdd->prepare('SELECT COUNT(Numero_Commentaire) FROM commentaire WHERE Identifiant = ?');
	$query7->execute(array($_SESSION['Identifiant']));
	$resultat = $query7->fetch();
	echo'<li><em>Commentaire(s) : </em>'.$resultat[0].'</li>';
	$query7->closeCursor();
	}


	// CAS OU L'UTILISATEUR NON CONNECTE
else{
		//on affiche le bouton de connexion : envoi en post vers une page pour le raffraichissement de la page
		echo '<form method="post" action="bonjour.php"><li>

				<input name="Identifiant" type="text" placeholder="Pseudo">
				<input name="Mot_De_Passe" type="password" placeholder="Mot de passe">
				<input name="Connexion" value="Se Connecter" type="submit">

			</li></form>

		<li><a href="inscription.php">S\'inscrire</a></li>';


		// CONNEXION
			 if( isset($_POST['Connexion'])){
						$pseudo = $_POST['Identifiant'];
						$password = $_POST['Mot_De_Passe'];

						include_once("./includes/connexion.php");
						$bdd=connect();

						$query3 = $bdd->prepare('SELECT Identifiant FROM utilisateur WHERE Identifiant = ?');
						$query3->execute(array($pseudo));
						
						if($pseudo=$query3->fetch()) 
									{ 
										$query4 = $bdd->prepare('SELECT Mot_De_Passe FROM utilisateur WHERE Mot_De_Passe = ?');
										$query4->execute(array($password));
										if($password=$query4->fetch()){
														$_SESSION['Identifiant'] = $_POST['Identifiant'];
													}
										else 
											{
												echo ('<p>Mot de passe Incorrect.</p>');
											}
										$query4->closeCursor();	
									}
						else 
							{
								echo ('<p>Identifiants erronés.</p>');
							}
						$query3->closeCursor();	
				}
	}
?>

</ul></nav></aside>


<aside>
	<h3>Menu</h3>
	<nav>
		<ul>
			<li><a href="index.php">Accueil</a></li>
			<li><a href="apropos.php">A propos</a></li>
			<?php
				if(isset($_SESSION['Identifiant'])){
					$result = $bdd->prepare('SELECT Type AS typeUser FROM utilisateur WHERE Identifiant=:val');
					$result->execute(array('val'=>$_SESSION['Identifiant']));
					$donnee=$result->fetch();
					$typeUtilisateur=strtolower($donnee['typeUser']);
					$result->closeCursor();
					if(strcmp($typeUtilisateur,"webmaster")==0){
					echo('<li><a href="ajoutarticle.php">Ajouter un article</a></li>');
					}
				}
			?>
		</ul>
	</nav>
</aside>
				
<aside>
	<h3>Recherche</h3>
	<form method="post" action="recherche.php">
		<input name="Rechercher" type="text" placeholder="Rechercher">
		<input name="Send" value="Go !" type="submit">
	</form>
</aside>

<aside>	
	<h3>Liens externes</h3>
		<nav>
			<ul>
				<li><a href="introuvable.php">Un jour, un poussin</a></li>
				<li><a href="introuvable.php">Un jour, un ecureuil</a></li>
				<li><a href="introuvable.php">Un jour, un fenouil</a></li>
				<li><a href="introuvable.php">Un jour, une loutre</a></li>
			</ul>
		</nav>
</aside>
