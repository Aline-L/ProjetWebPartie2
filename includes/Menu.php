<aside>
	<h3>Menu</h3>

	<nav>
		<ul>
	<?php

	//$connected = true;

	//la variable "connected" est un booléen à "true" si l'utilisateur est connecté et à "false" sinon
	if ($connected){
		echo "<li> vous êtes connecté </li>";
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
			<li><a href="Accueil.php">Accueil</a></li>
			<li><a href="Apropos.php">A propos</a></li>
			<li><a href="AjoutArticle.php">Soumettre un article</a></li>		
		</ul>
	</nav>
</aside>
				
<aside>
	<h3>Recherche</h3>
	<form action="Recherche.php">
		<input name="Rechercher" type="text" placeholder="Rechercher">
	</form>
</aside>

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