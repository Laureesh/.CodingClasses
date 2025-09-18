<?php
    $productsArray = [
        0 => ['Honda Accord', 28450],
        1 => ['Toyota Camry', 25050],
        2 => ['Nissan Altima', 24080],
        3 => ['Lexus RX', 45570],
        4 => ['Tesla X', 104920],
    ];

// create short variable names
$productIndex = (int) $_POST['product'];
$productSelected = $productsArray[$productIndex];
$firstName = $_POST['fName'];
$lastName = $_POST['lName'];
$productName = $productSelected[0];
$productPrice = $productSelected[1];
$document_root = $_SERVER['DOCUMENT_ROOT'];
$date = date('d/m/Y h:i:s'); //date('H:i, js F Y');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tony Car Dealership - Process Order</title>
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
    <?php include "menu.php"; ?>

    <div class="w3-container w3-light-gray">
        <?php

        echo "Order processed at " . date('H:i, jS F Y') . ".<br>";
        echo "Your order is as follows:<br>";

        echo "First name: $firstName<br />";
        echo "Last name: $lastName<br />";
        echo "Item ordered: $productName<br />";

        $salesTax = round(0.06 * $productPrice);
        $grandTotal = $productPrice + $salesTax;

        echo "Unit price: $" . number_format($productPrice, 2) . "<br />";
        echo "6% sales tax: $" . number_format($salesTax, 2) . "<br />";
        echo "Total: $" . number_format($grandTotal, 2) . "<br />";

        $outputString = $date . ";" . $firstName . ";" . $lastName . ";" . $productName . ";" . $grandTotal . "\n";


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

</body>
</html>