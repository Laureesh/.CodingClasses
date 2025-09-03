<?php
    // Create short variable names
    $tireqty = $_POST['tireqty'];
    $oilqty = $_POST['oilqty'];
    $sparkqty = $_POST['sparkqty'];
    $sourceIndex = $_POST['find'];
    $sourceArray = ['Regular customer', 'TV advertising', 'Phone directory', 'Word of mouth', 'Social media', 'Search engine'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bob's Auto Parts - Order Results</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body class="w3-sand">
    <div class="w3-container w3-center">
        <h1>Bob's Auto Parts</h1>
        <h2>Order Results</h2>
    </div>
    <div class="w3-container w3-pale-green">
        <?php
            // Display input values
            $tireqty = htmlspecialchars($tireqty);
            $tireqty = (int)$tireqty;

            $oilqty = htmlspecialchars($oilqty);
            $oilqty = (int)$oilqty;

            $sparkqty = htmlspecialchars($sparkqty);
            $sparkqty = (int)$sparkqty;

            $sourceIndex = (int)$sourceIndex;

            echo "<br>Order processed at ";
            echo date('H:i, jS F Y')."<br>";
            echo "<br>Your order is as follows:<br>";
            echo "Number of tires: $tireqty<br>";
            echo "Number of oil bottles: $oilqty<br>";
            echo "Number of spark plugs: $sparkqty<br>";

            echo "Referral Source: ".$sourceArray[$sourceIndex];
            echo "<br>";

            $totalqty = 0;
            $totalqty = $tireqty + $oilqty + $sparkqty;
            echo "Items ordered: $totalqty<br>";
            
            $totalAmount = 0.0;
            define('TIRE_PRICE', 100);
            define('OIL_PRICE', 10);
            define('SPARK_PRICE', 4);
            
            $totalAmount = $tireqty * TIRE_PRICE +
                            $oilqty * OIL_PRICE +
                            $sparkqty * SPARK_PRICE;
            
            echo "Subtotal: $" . number_format($totalAmount, 2) . "<br>";

            $taxRate = 0.10;  // local sales tax rate is 10%
            $totalAmount *= (1.0 + $taxRate);
            echo "Total including tax: $" . number_format($totalAmount, 2)."<br>";
        ?>
    </div>
</body>
</html>