<?php
    $productsArray = [
      0 => ['Beef chimichanga', 14.25],
      1 => ['Chicken burrito', 11.50], 
      2 => ['Chicken enchilada', 12.50], 
      3 => ['Fajita Supreme', 17.50] ,     
      4 => ['Pollo loco', 14.00],
      5 => ['Taco al pastor', 9.50]        
  ];

  // create short variable names
  # write your code here
$productIndex = (int) $_POST['product'];
$productSelected = $productsArray[$productIndex];
$productName = $productSelected[0];
$productPrice = $productSelected[1];
$quantity = (int) $_POST['quantity'];
$document_root = $_SERVER['DOCUMENT_ROOT'];
$date = date('d/m/Y h:i:s'); //date('H:i, js F Y');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Results</title>
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
        <h2>Order Results</h2>
        <img src="taco.png" class="w3-display-topleft w3-container" style="width:100%;max-width:200px">
        <img src="mariachis.png" class="w3-display-topright w3-container" style="width:100%;max-width:200px">
    </header>
    <?php include "menu.php" ?>   
    
    <div class="w3-container w3-theme-l2">
    <?php
		# write your code here
    if ($quantity <= 0) {
            echo "You did not order anything on the previous page!<br />";
            exit;
        }

        echo "Order processed at " . date('H:i, jS F Y') . ".<br>";
        echo "Your order is as follows:<br>";

        echo "Item ordered: $productName<br />";
        echo "Quantity: " . $quantity . "<br />";
        echo "Unit price: $productPrice<br />";

        $totalAmount = $quantity * $productPrice;

        echo "Total: $" . number_format($totalAmount, 2) . "<br />";

        $outputString = $date.";".$productName.";".$quantity.";".$totalAmount."\n";

        // open file for appending
        @$fp = fopen("orders.txt", 'ab');

        if (!$fp) {
            echo "<p><strong> Your order could not be processed at this time.
            Please try again later.</strong></p>";
            exit;
        }

        flock($fp, LOCK_EX);
        fwrite($fp, $outputString, strlen($outputString));
        flock($fp, LOCK_UN);
        fclose($fp);

        echo "<p>Order written.</p>";
    ?>
    </div>
    <br><br>
    <footer class="w3-theme-l2">
      Cliparts from <a href="https://www.clipartmax.com/">Clipartmax</a>
    </footer>
 
  </body>
</html>

