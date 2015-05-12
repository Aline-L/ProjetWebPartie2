<?php 
session_start();
session_destroy();
?>
<!DOCTYPE html>
 <html>

 		<?php include ("includes/head.php"); ?> 

 	 	<body>

			<?php include ("includes/header.php"); ?>

				<div id="colonneP">
						<section>
							<h1> Au revoir, vous allez nous manquer :( </h1>
						</section>
				</div>
			
		<?php 
		include("includes/menu.php"); 	//inclusion du menu latéral 
		include("includes/footer.php");	//inclusion du footer 
		?>

		</body>

 </html>
