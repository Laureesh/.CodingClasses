<?php
  // create short variable name
  $document_root = $_SERVER['DOCUMENT_ROOT'];
?>
<!DOCTYPE html>
<html>
  <head>
    <title>View orders</title>
      <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
      <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-amber.css">
  </head>
  <body class="w3-theme">
  <header class="w3-center w3-display-container">
        <h1 class="w3-cursive">Los Pollos Hermanos</h1>
        <h2>Home Page</h2>
        <img src="Los_Pollos_Hermanos_logo.png" class="w3-display-topright w3-container" style="width:100%;max-width:200px">
    </header>
    <?php include "menu.php" ?>
    <div>   
      <?php
		// write your code to display the orders in w3-table format
    $file = "orders.txt";
      $orders = file($file);

      # write your code here
      $number_of_orders = count($orders);
      if ($number_of_orders == 0) {
        echo "<p><strong>No orders pending.<br />
    Please try again later.</strong></p>";
      } else {
        // display orders
        echo "<table class='w3-table w3-striped w3-border'>";
        echo "  <tr class='w3-theme-d5'>";
        echo "    <th>Datetime</th>";
        echo "    <th>Product</th>";
        echo "    <th>Quantity</th>";
        echo "    <th>Total</th>";
        echo "  </tr>";

        // loop through each row
        for ($i = 0; $i < $number_of_orders; $i++) {
          // retrieve current row (current order) from multidimensional array
          $curOrder = explode(";", $orders[$i]);

          // begin table row
          echo "<tr>";
          for ($j = 0; $j < count($curOrder); $j++) {
            echo "<td>" . $curOrder[$j] . "</td>";

            //end table row 
          }
          echo "</tr>";
        }

        echo "</table>";

      }

      ?>
    </div>
    <br><br>
    <footer class="w3-theme-l2">
      Logo from <a href="https://en.wikipedia.org/wiki/Los_Pollos_Hermanos">Wikipedia</a>
    </footer>
  </body>
</html>