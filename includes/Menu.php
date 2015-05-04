<?php	

	echo '<aside><h3>Utilisateur</h3><nav><ul>';
 
 	if(isset($_SESSION['Identifiant'])){ 

	echo '<li> Connecté(e) sous le pseudo: '.$_SESSION['Identifiant'].'</li>'.
	'<form method="post" action="#" id="Deconnexion">'.
	'<li><input name="Deconnexion" value="Se déconnecter" type="submit"></li>'.
	'</form>';
	
	try 
	{
		$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');
	}
		catch (Exception $e)
				{
			    die('Erreur : ' . $e->getMessage());
				}

	//Affichage de la date d'inscription 

	$query=$bdd->prepare('SELECT * FROM utilisateur WHERE Identifiant = ?');
	$query->execute(array($_SESSION['Identifiant']));
	$resultat = $query->fetch();

	echo'<li> Inscrit le '.$resultat['Date_Inscription'].'</li>';

	$query->closeCursor();

	//Affichage du nombre d'articles
	$query1=$bdd->prepare('SELECT COUNT(Numero_Article) FROM article WHERE Redacteur = ?');
	$query1->execute(array($_SESSION['Identifiant']));
	$resultat = $query1->fetch();

	echo'<li> Articles: '.$resultat[0].'</li>';

	$query1->closeCursor();

	//Affichage du nombre de commentaires 
	$query2=$bdd->prepare('SELECT COUNT(Numero_Commentaire) FROM commentaire WHERE Identifiant = ?');
	$query2->execute(array($_SESSION['Identifiant']));
	$resultat = $query2->fetch();

	echo'<li> Commentaires: '.$resultat[0].'</li>';

	$query2->closeCursor();

	if(isset($_POST['Deconnexion'])){
		session_destroy();
		//echo '<li> vous êtes à présent déconnecté(e) </li>';
		header("Refresh: 1 ");
	}
}

	else{
		echo '<li><a href="Connexion.php">Se connecter</a></li>'.
		'<li><a href="Inscription.php">S\'inscrire</a></li>';
	}
	

	echo '</ul></nav></aside>';

?>

<aside>
	<h3>Menu</h3>

	<nav>
		<ul>

	</li>		
		</ul>
	</nav>

	<nav>
		<ul>
			<li><a href="index.php">Accueil</a></li>
			<li><a href="Apropos.php">A propos</a></li>
			<li><a href="AjoutArticle.php">Ajouter un article</a></li>		
		</ul>
	</nav>
</aside>
				
<aside>
	<h3>Recherche</h3>
	<form method="post" action="Recherche.php">
		<input name="Rechercher" type="text" placeholder="Rechercher">
		<input name="Send" value="Go !" type="submit">
	</form>
</aside>

<?php
if (isset($_POST['Send'])){
	$_SESSION['Recherche'] = $_POST['Rechercher'];
	header('Recherche.php');
	header("Refresh: 0");

}

?>

<aside>	
	<h3>Liens externes</h3>
		<nav>
			<ul>
				<li><a href="Introuvable.php">Un jour, un poussin</a></li>
				<li><a href="Introuvable.php">Un jour, un ecureuil</a></li>
				<li><a href="Introuvable.php">Un jour, un fenouil</a></li>
				<li><a href="Introuvable.php">Un jour, une loutre</a></li>
			</ul>
		</nav>
</aside>
