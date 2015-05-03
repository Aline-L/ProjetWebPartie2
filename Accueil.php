<?php session_start(); ?>
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
					<article>
						<h1>Lilly le petit chaton | posté par Aline Legros le 21/03/2015</h1>
						<div class="image_article">
							<img src="images/PhotosChatons/cat01.jpg" alt="chat1">
						</div>
						
						<div class="texte_article">
							<section>
								<h2>Le dédoublement de personnalité de Lilly</h2>
								<p>Célibataire rangé et cadre dynamique d'une société d'évaluation de risques automobiles, Lilly le petit chaton vainc ses problèmes de sommeil en participant à des groupes d'entraide sous de fausses identités. Mais ses insomnies reprennent quand surgit Marla qui, comme lui, assiste en touriste à ces séances...</p>
								<nav>
									<a href="Article01.php"> Lire la suite... </a>
								</nav>
							</section>
							
							<section>
								<h2>Dernier commentaire sur cet article</h2>
								<p><q>Il déchire Lilly le petit chaton!</q> - par Momodu69</p>
							</section>
						</div>
					</article>

					<article>
						<h1>Léon le chaton | posté par Cyril Weller le 21/03/2015</h1>
						<div class="image_article">
							<img src="images/PhotosChatons/cat05.jpg" alt="chat2">
						</div>
						
						<div class="texte_article">
							<section>
								<h2> Léon le chaton à l'école des chat-sorciers </h2>
								<p>Après la mort tragique de ses parents, le petit chaton Léon est recueilli par sa tante Amande et son oncle Albert. Son oncle et sa tante, possédant une haine féroce envers les parents de Léon le chaton, le maltraitent et laissent leur fils Didou l'humilier. Léon le chaton ne sait rien sur ses parents. On lui a toujours dit qu’ils étaient morts dans un accident de voiture...</p>
								<nav>
									<a href="Article02.php"> Lire la suite... </a>
								</nav>
							</section>
							
							<section>
								<h2>Dernier commentaire sur cet article</h2>
								<p><q>Il déchire Léon le chaton!</q> - par Momodu69</p>
							</section>
						</div>
					</article>
			</div>


		<?php 
		include("includes/Menu.php"); 	//inclusion du menu latéral 
		include("includes/Footer.php");	//inclusion du footer 
		?>

		</body>

 </html>
