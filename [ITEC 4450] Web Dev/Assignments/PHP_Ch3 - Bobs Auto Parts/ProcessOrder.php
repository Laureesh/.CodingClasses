<?php
    // create short variable names
    $tireqty = (int)$_POST['tireqty'];
    $oilqty = (int)$_POST['oilqty'];
    $sparkqty = (int)$_POST['sparkqty'];
    $address = htmlspecialchars($_POST['address']);
    $date = date('m/d/Y h:i:s');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bob's Auto Parts - Order Results</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body class="w3-sand">
    <div class="w3-container w3-center w3-pale-green">
        <h1>Bob's Auto Parts</h1>
        <h2>Order Form</h2>
    </div>

    <?php include 'menu.php'; ?>

    <div class="w3-container w3-light-gray">
        <?php
            echo "Order processed at $date<br>";
            echo "Your order is as follows:<br>";

            $totalqty = $tireqty + $oilqty + $sparkqty;
            $totalAmount = 0.0;

            $pricesArray = [
                'tire' => 100,
                'oil' => 10,
                'spark' => 4
            ];

            echo "Total items ordered: $totalqty<br>";

            if ($totalqty <= 0) {
                echo "You have not ordered anything! Please order something and try again.<br>";
                exit;
            }

            $totalAmount = $tireqty * $pricesArray['tire'] +
                            $oilqty * $pricesArray['oil'] +
                            $sparkqty * $pricesArray['spark'];
            
            echo "Total amount: $".number_format($totalAmount, 2)."<br>";

            $outputStr = "$date;$tireqty;$oilqty;$sparkqty;$totalAmount;$address\n";
            $myPath = "orders/";
            @$fp = fopen($myPath . "orders.txt", 'ab');

            if (!$fp) {
                echo "Your order could not be processed, please try again later.<br>";
                exit;
            }

            flock($fp, LOCK_EX);
            fwrite($fp, $outputStr, strlen($outputStr) + strlen($outputStr));
            flock($fp, LOCK_UN);
            fclose($fp);

            echo "Order written...";
        ?>
    </div>
</body>
</html>