<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dream Vacations Booking</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        h1,
        h2 {
            text-shadow: 1px 1px 0 #444;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }
    </style>
</head>

<body>
    <div class="w3-container w3-sand">
        <header class="w3-display-container w3-blue-gray" style="height:130px;">
            <div class="w3-display-topmiddle" style="text-align:center;">
                <h1>Leonardo Pizza</h1>
                <h2>Order</h2>
            </div>
        </header>
        <nav class="w3-bar w3-border w3-light-grey">
            <a href="LeonardoPizza-Order.php" class="w3-bar-item w3-button">Order</a>
            <a href="LeonardoPizza-ShowOrders.php" class="w3-bar-item w3-button">Show Orders</a>
        </nav>
        <form class="w3-container" method="POST">
            <label>First name</label>
            <input type="text" class="w3-input" name="fName">

            <label>Last name</label>
            <input type="text" class="w3-input" name="lName">

            <label>Pizza Name</label>
            <select name="pizzaName" class="w3-select">
                <option value="GardenFresh">Garden Fresh</option>
                <option value="Hawaiian">Hawaiian</option>
                <option value="Pepperoni">Pepperoni</option>
                <option value="Sausage">Sausage</option>
            </select>

            <label>Size</label>
            <select name="pizzaSize" class="w3-select">
                <option value="Small">Small</option>
                <option value="Medium">Medium</option>
                <option value="Large">Large</option>
            </select>

            <input type="submit" value="Submit" name="submit" class="w3-btn w3-green">

            <br><br>
            <table class="w3-table w3-striped w3-border">
                <tr class="w3-blue-gray">
                    <th>Pizza Name</th>
                    <th>Small</th>
                    <th>Medium</th>
                    <th>Large</th>
                </tr>
                <tr>
                    <td>Garden Fresh</td>
                    <td>8</td>
                    <td>9</td>
                    <td>10</td>
                </tr>
                <tr>
                    <td>Hawaiian</td>
                    <td>8</td>
                    <td>9.5</td>
                    <td>10</td>
                </tr>
                <tr>
                    <td>Pepperoni</td>
                    <td>8</td>
                    <td>9</td>
                    <td>10</td>
                </tr>
                <tr>
                    <td>Sausage</td>
                    <td>8</td>
                    <td>9</td>
                    <td>10.5</td>
                </tr>
            </table>
        </form>
        <div class="w3-container">
            <?php

            // Function to get pizza price based on name and size
            function getPizzaPrice($pizzaName, $pizzaSize) {
                $prices = array(
                    "GardenFresh" => array("Small" => 8, "Medium" => 9, "Large" => 10),
                    "Hawaiian"  => array("Small" => 8, "Medium" => 9.5, "Large" => 10),
                    "Pepperoni"  => array("Small" => 8, "Medium" => 9, "Large" => 10),
                    "Sausage"  => array("Small" => 8, "Medium" => 9, "Large" => 10.5),
                );
                if (isset($prices[$pizzaName][$pizzaSize])) {
                    return $prices[$pizzaName][$pizzaSize];
                } else {
                    return 0;
                }
            }

            if (isset($_POST['submit'])) {
                if (empty($_POST['fName']) || empty($_POST['lName']) || empty($_POST['pizzaName']) || empty($_POST['pizzaSize'])) {
                    echo "Some fields are empty. Please complete the form and try again<br>";
                    exit;
                }

                $allPizzas = array(
                    "GardenFresh" => "Garden Fresh",
                    "Hawaiian" => "Hawaiian",
                    "Pepperoni" => "Pepperoni",
                    "Sausage" => "Sausage",
                );

                $fName = $_POST['fName'];
                $lName = $_POST['lName'];
                $pizzaName = $_POST['pizzaName'];
                $pizzaSize = $_POST['pizzaSize'];

                echo "<div class='w3-container w3-pale-green'>";
                echo "<h3>Order Successful!</h3>";
                echo "<b>Placed on: " . date('Y-m-d H:i:s') . "</b><br>";
                echo "<b>First Name: $fName</b><br>";
                echo "<b>Last Name: $lName</b><br>";
                echo "<b>Pizza Name: " . $allPizzas[$pizzaName] . "</b><br>";
                echo "<b>Pizza Size: $pizzaSize</b><br>";
                echo "<b>Total: $" . getPizzaPrice($pizzaName, $pizzaSize) . "</b><br>";

                #write to file
                $outputStr = date('Y-m-d H:i:s') . ','; # order date
                $outputStr .= $fName . ",";
                $outputStr .= $lName . ",";
                $outputStr .= $pizzaName . ",";
                $outputStr .= $pizzaSize . ",";
                $outputStr .= getPizzaPrice($pizzaName, $pizzaSize) . ",";
                $outputStr .= PHP_EOL;

                $fileName = "pizzaOrder.csv";
                @$fp = fopen($fileName, 'a');

                if (!$fp) {
                    echo "<p><strong>Your order could not be processed at this time. Please try again later</strong></p>";
                    exit;
                }

                #lock the file
                flock($fp, LOCK_EX);

                #write to file
                fwrite($fp, $outputStr, strlen($outputStr));

                #unlock the file
                flock($fp, LOCK_UN);

                #close the file
                fclose($fp);
            }
            ?>
        </div>
    </div>
</body>

</html>