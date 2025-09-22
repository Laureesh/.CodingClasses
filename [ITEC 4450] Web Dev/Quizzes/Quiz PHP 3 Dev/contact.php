<?php
  // create short variable name
  $document_root = $_SERVER['DOCUMENT_ROOT'];
?>
<!DOCTYPE html>
<html>
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Home</title>
      <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
      <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-khaki.css">

      <!-- Google fonts -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
      <style>
        h1 {
          font-family: 'Tangerine', serif;
          font-size: 50px;
          font-weight: bold;
        }
      </style>
  </head>
  <body class="w3-theme">
   <header class="w3-center w3-display-container">
        <h1>Los Mariachis Mexican Restaurant</h1>
        <h2>Contact Page</h2>
        <img src="taco.png" class="w3-display-topleft w3-container" style="width:100%;max-width:200px">
        <img src="mariachis.png" class="w3-display-topright w3-container" style="width:100%;max-width:200px">
    </header>
    <?php include "menu.php" ?>
    <div>   
      <h2>By Laureesh Volmar</h2>
    </div>
    <br><br>
    <footer class="w3-theme-l2">
      Cliparts from <a href="https://www.clipartmax.com/">Clipartmax</a>
    </footer>
  </body>
</html>