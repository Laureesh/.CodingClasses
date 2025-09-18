<?php
  // create short variable name
  $document_root = $_SERVER['DOCUMENT_ROOT'];
?>
<!DOCTYPE html>
<html>
<head>
  <title>Tony Car Dealership - View Orders</title>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

  <!-- Google Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Pacifico">

  <style>
    .w3-pacifico { font-family: "Pacifico", serif; }

    h1 { font-family: "Pacifico", serif; }
  </style>
</head>
<body class="w3-light-gray">
    <div class="w3-container w3-center w3-dark-gray">
        <h1 >Tony Car Dealership</h1>
        <h2>Process Order</h2>
        <img src="carClipart.png" width="10%" height="10%" class="w3-display-topright" />
    </div>
<?php include 'menu.php'; ?>

  <?php

  $orders = file("orders.txt");

  // format is datetime;tires;oil;spark;total;address
  $number_of_orders = count($orders);
  if ($number_of_orders == 0) {
    echo "<p><strong>No orders pending.<br />
    Please try again later.</strong></p>";
  }
  else {
    // display orders
    echo "<table class='w3-table w3-striped w3-border'>";
    echo "  <tr class='w3-blue-gray'>";
    echo "    <th>Datetime</th>";
    echo "    <th>First Name</th>";
    echo "    <th>Last Name</th>";
    echo "    <th>Product</th>";
    echo "    <th>Total</th>";
    echo "  </tr>";

    // loop through each row
    for ($i=0; $i<$number_of_orders; $i++) {
      // retrieve current row (current order) from multidimensional array
      $curOrder = explode(";", trim($orders[$i]));

      // begin table row
      for($j = 0; $j < count($curOrder); $j++) {
        // Format the last field (total) as currency
        if ($j == 4) {
          echo "<td>".number_format((float)$curOrder[$j], 0)."</td>";
        } else {
          echo "<td>".$curOrder[$j]."</td>";
        }
      }
      echo "</tr>";
    }

    echo "</table>";
    
  }

  ?>
</div>
</body>
</html>