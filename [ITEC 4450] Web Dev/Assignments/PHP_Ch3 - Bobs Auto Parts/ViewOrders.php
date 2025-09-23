<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bob Auto Parts - View Orders</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body class="w3-sand">
    <div class="w3-container w3-center w3-pale-green">
        <h1>Bob's Auto Parts</h1>
        <h2>View Orders</h2>
    </div>

    <?php include 'menu.php'; ?>

    <?php
    // format is datetime;tires;oil;spark;total;address
    $fileAndPath = "./orders/orders.txt";
    $orders = file($fileAndPath);

    $numberOfOrders = count($orders);
    if ($numberOfOrders == 0) {
        echo "No orders pending. please try again later<br>";
        exit;
    }

    // display orders
    echo "<table class='w3-table w3-table-all w3-border' >";
    echo "  <tr class='w3-teal'>";
    echo "      <th>Datetime</th>";
    echo "      <th>Tires</th>";
    echo "      <th>Oil</th>";
    echo "      <th>Spark Plugs</th>";
    echo "      <th>Total</th>";
    echo "      <th>Address</th>";
    echo "  </tr>";

    // loop through each row
    for($i = 0; $i < $numberOfOrders; $i++) {
        // retrieve current row using ; as delimeter
        $curOrder = explode(';', $orders[$i]);

        // begin table row
        echo "<tr>";

        // display current column
        for($j = 0; $j < count($curOrder); $j++) {
            echo "<td>".$curOrder[$j]."</td>";
        }
        // end table row
        echo "</tr>";
    }
    
    echo "</table>";
    ?>
    </div>
    
</body>
</html>