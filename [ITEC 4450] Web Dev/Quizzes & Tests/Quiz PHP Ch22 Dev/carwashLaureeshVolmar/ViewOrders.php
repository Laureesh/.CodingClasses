<?php
    # create short variable name
    $document_root = $_SERVER['DOCUMENT_ROOT'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Orders</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-deep-purple.css">
    <style>
        h1 { font-family: 'Trebuchet MS', sans-serif; }
    </style>
</head>
<body class="w3-theme-l4">
    <div class="w3-container w3-center w3-theme-d3">
        <h1>Larry Car Wash</h1>
        <h2>View Orders</h2>
        <img src="Car-High-Quality.png" width="30%" height="20%" class="w3-display-topright" />
    </div>
    <?php include "menu.php"; ?>

    <?php

        $orders = file("orders.txt");

        # format is datetime;tires;oil;spark;total;address
        $number_of_orders = count($orders);
        if ($number_of_orders == 0) {
            echo "<p><strong>No orders pending.<br />
                  Please check back later.</strong></p>";
        } 
        else {
            # display orders
            echo "<table class='w3-table w3-striped w3-border'>";
            echo "  <tr class='w3-theme-d5'>";
            echo "      <th>Datetime</th>";
            echo "      <th>Product</th>";
            echo "      <th>Description</th>";
            echo "      <th class='w3-right-align'>Quantity</th>";
            echo "      <th class='w3-right-align'>Price</th>";
            echo "      <th class='w3-right-align'>Total</th>";
            echo "  </tr>";

            # loop through each row
            for ($i=0; $i < $number_of_orders; $i++) {
                # retrieve current row (current order) from multidimensional array
                $curOrder = explode(";", $orders[$i]);

                # begin table row
                echo "<tr>";
                for ($j=0; $j < count($curOrder); $j++) {
                    if ($j < 3) {
                        echo "<td>" . $curOrder[$j] . "</td>";
                    }
                    else {
                        echo "<td class='w3-right-align'>" . $curOrder[$j] . "</td>";
                    }
                }
                # display total
                $total = floatval($curOrder[3]) * floatval($curOrder[4]);
                echo "<td class='w3-right-align'>" . $total . "</td>";

                # end table row
                echo "</tr>";
            }

            echo "</table>";
        }
    ?>
</body>
</html>