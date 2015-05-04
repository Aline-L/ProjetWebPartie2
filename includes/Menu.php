
<aside>
	<h3>Menu</h3>

	<nav>
		<ul>
	<?php

	if(isset($_POST['Deconnexion'])){
		session_destroy();
		echo '<li> vous êtes à présent déconnecté(e) </li>';
	}

	if(isset($_SESSION['Identifiant']) && !(isset($_POST['Deconnexion']))){
		echo '<li> vous êtes connecté(e) sous le pseudo: '.$_SESSION['Identifiant'].'</li>'.
		'<form method="post" action="#" id="Deconnexion">'.
		'<li><input name="Deconnexion" value="Se déconnecter" type="submit"></li>'.
		'</form>';
	}
	else{
		echo '<li><a href="Connexion.php">Se connecter</a></li>'.
		'<li><a href="Inscription.php">S\'inscrire</a></li>';
	}


	?>

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
