<?php
    // Create short variable names
    $tireqty = $_GET['tireqty'];
    $oilqty = $_GET['oilqty'];
    $sparkqty = $_GET['sparkqty'];
    $sourceIndex = $_GET['find'];
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

            echo "Referral Source: $sourceIndex<br>";
            switch ($sourceIndex) {
                case 0: echo "Regular customer"; break;
                case 1: echo "TV advertising"; break;
                case 2: echo "Phone directory"; break;
                case 3: echo "Word of mouth"; break;
                case 4: echo "Social media"; break;
                case 5: echo "Search engine"; break;
            }
            echo "<br>";
        ?>
    </div>
</body>
</html>