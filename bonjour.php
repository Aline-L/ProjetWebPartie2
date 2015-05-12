<?php
	session_start();
	if(isset($_SESSION['Identifiant'])){ 
	$identifiant=$_SESSION['Identifiant'];
	}
?>
 <!DOCTYPE html>
 <html>

 		<?php include ("includes/head.php"); ?> 

 	 	<body>

			<?php include ("includes/header.php"); ?>

				<div id="colonneP">
						<section>
							<h1> Vous êtes à présent connecté(e) </h1>
						</section>
				</div>
			
		<?php 
		include("includes/menu.php"); 	//inclusion du menu latéral 
		include("includes/footer.php");	//inclusion du footer 
		?>

		</body>

 </html>
