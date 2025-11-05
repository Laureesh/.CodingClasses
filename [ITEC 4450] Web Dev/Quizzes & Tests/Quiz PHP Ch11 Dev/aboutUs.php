<?php 
	include "utilFunctions.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>727 Subs - About Us</title>	
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-cyan.css">
	<link rel="stylesheet" type="text/css" href="styles.css">
	<style>
		h1 {	
			font-family: 'Stencil Std', sans-serif;
			color: yellow;
		}
		
		h2 {
			color: white;
		}
	</style>
</head>
<body>
	<div class="w3-container w3-theme-d5">
		<header class="w3-container w3-center">
			<h1>727 Subs</h1>
			<h2>About Us</h2>
		</header>
		<?php
			include 'mainMenu.php';
		?>
		
		<div class="w3-container w3-center">
			<div class="w3-card-4" style="width:100%">
				<img src="subSandwich.jpg" alt="Sub" style="width:60%">
				<div class="w3-container w3-center w3-theme-d3">
					<h1>727 Subs</h1>
					<p>Laureesh Volmar</p>
				</div>
			</div>
		</div>
	</div>	
</body>
</html>