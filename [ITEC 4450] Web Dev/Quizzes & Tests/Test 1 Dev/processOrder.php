<?php
    $productsArray = [
      0 => ['Grilled chicken', 12.50], 
      1 => ['Chicken tenders', 5.50], 
      2 => ['Chicken parmesan', 14.25],
      3 => ['Chicken sandwich', 8]      
  ];

  // retrieve POST paramaters and store values in php variablea

  $date = date('d/m/Y h:i:s'); //date('H:i, jS F Y');  
?>
<!DOCTYPE html>
<html>
  <head>
  <title>Order Results</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-amber.css">   
	</style>    
  </head>
  <body class="w3-theme">
  <header class="w3-center w3-display-container">
        <h1 class="w3-cursive">Los Pollos Hermanos</h1>
        <h2>Order Results</h2>
        <img src="Los_Pollos_Hermanos_logo.png" class="w3-display-topright w3-container" style="width:100%;max-width:200px">
    </header>
    <?php include "menu.php" ?>   
    
    <div class="w3-container w3-theme-l2">
    <?php




    ?>
    </div>
    <br><br>
    <footer class="w3-theme-l2">
      Logo from <a href="https://en.wikipedia.org/wiki/Los_Pollos_Hermanos">Wikipedia</a>
    </footer>
 
  </body>
</html>

