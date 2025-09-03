<?php
    // create short variable names
    $tireqty = $_POST['tireqty'];
    $oilqty = $_POST['oilqty'];
    $sparkqty = $_POST['sparkqty'];
    $address = preg_replace('/\t|\R/', ' ', $_POST['address']);
    $document_root = $_SERVER['DOCUMENT_ROOT'];
    $date = date('H:i, jS F Y');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bob's Auto Parts - Process Order</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body class="w3-sand">
    <div class="w3-container w3-center">
        <h1>Bob's Auto Parts</h1>
        <h2>Order Results</h2>
    </div>

    <div class="w3-container w3-light-gray">
        <?php
            echo "Order processed at $date<br>";
            echo "Your order is as follows:<br>";

            $totalqty = 0;
            $totalamount = 0;

            define('TIRE_PRICE', 100);
            define('OIL_PRICE', 10);
            define('SPARK_PRICE', 4);

            $totalqty = $tireqty + $oilqty + $sparkqty;
            echo "<br>Items ordered: $totalqty<br>";

            if ($totalqty == 0) {
                echo "You did not order anything on the previous page!<br>";
            }
            else {
                if ($tireqty > 0) {
                    echo htmlspecialchars($tireqty) . " tires<br>";
                }
                if ($oilqty > 0) {
                    echo htmlspecialchars($oilqty) . " bottles of oil<br>";
                }
                if ($sparkqty > 0) {
                    echo htmlspecialchars($sparkqty) . " spark plugs<br>";
                }

                $totalamount = $tireqty * TIRE_PRICE + $oilqty * OIL_PRICE + $sparkqty * SPARK_PRICE;

                echo "Subtotal: $".number_format($totalamount, 2)."<br>";

                echo "<br>Address to ship to is " . htmlspecialchars($address)."<br>";

                $outputStr = $date."\t".$tireqty." tires \t".$oilqty." oil \t"
                           . $sparkqty." spark plugs\t\$".$totalamount."\t".$address."\n";

                // open file for appending
                $myPath = "orders/";
                @$fp = fopen($myPath."orders.txt", "ab");

                if (!$fp) {
                    echo "<br>Your order could not be processed at this time. Please try later<br>";
                    exit;
                }

                flock($fp, LOCK_EX);
                fwrite($fp, $outputStr, strlen($outputStr));
                flock($fp, LOCK_UN);
                fclose($fp);

                echo "<br>Order written<br>";
            }
        ?>
    </div>
</body>
</html>