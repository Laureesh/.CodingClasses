<?php
$productsArray = [
    0 => ['Bok Choy', 3],
    1 => ['Spinach', 2.5],
    2 => ['Chicken', 3.5],
    3 => ['Beef', 4],
    4 => ['Shrimp', 4.5],
    ];

// create short variable names
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
    <title>Order Results</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Pacifico">

    <style>
        .w3-pacifico { font-family: "Pacifico", serif; }

        h1 { font-family: "Pacifico", serif; }
    </style>
</head>
<body class="w3-pale-red">
    <div class="w3-container w3-center w3-pink ">
        <h1>Dim Sum Kingdom</h1>
        <h2>Order Results</h2>
        <img src="DimSum3.png" width="10%" height="10%" class="w3-display-topright" />
    </div>
    <?php include "menu.php"; ?>

    <div class="w3-container w3-light-gray">
        <?php

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
    <div class="w3-container w3-theme-l2 w3-tiny">
        Image source: <a href='https://www.stickpng.com/'>Stick PNG</a>
    </div>

</body>
</html>