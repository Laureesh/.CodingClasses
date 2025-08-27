<!DOCTYPE html>
<html>
<head>	
	<title>Form Received Example</title>
	
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">	
</head>
<body>
	<div class="w3-card-4" style="width:50%">
		<header class="w3-container w3-teal w3-center">
		  <h1>Student Information</h1>
		</header>

		 <div class='container w3-sand'>
		 
			<?php
				if(isset($_POST["fName"]) && isset($_POST["mName"]) && isset($_POST["lName"])) {
				 $fName = $_POST["fName"];
				 $mName = $_POST["mName"];
				 $lName = $_POST["lName"];
				 
				 $classification = $_POST["classification"];
				
				echo "<h3>Form successfully received!</h3>";
				echo "<b>First Name</b>: $fName<br>";					 
				echo "<b>Middle Name</b>: $mName<br>";					 
				echo "<b>Last Name</b>: $lName<br>";					 
				echo "<b>Classification</b>: $classification<br>";					 
				}
			?>			 
		 
		 </div>	
		
	</div>


</body>
</html>