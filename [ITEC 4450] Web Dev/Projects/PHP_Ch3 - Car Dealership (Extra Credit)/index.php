<?php
    $productsArray = [
        0 => ['Honda Accord', 28450],
        1 => ['Toyota Camry', 25050],
        2 => ['Nissan Altima', 24080],
        3 => ['Lexus RX', 45570],
        4 => ['Tesla X', 104920],
    ];
    $GLOBALS['productsArray'] = $productsArray;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tony Car Dealership - Order Form</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Pacifico">

    <style>
        .w3-pacifico { font-family: 'Pacifico', cursive; }

        h1 { font-family: 'Pacifico', serif; }
    </style>
</head>
<body class="w3-light-gray">
    <div class="w3-container w3-center w3-dark-gray">
        <h1 >Tony Car Dealership</h1>
        <h2>Order Form</h2>
        <img src="carClipart.png" width="10%" height="10%" class="w3-display-topright" />
    </div>
    <?php include 'menu.php'; ?>
    <form action="processOrder.php" method="post">

        <label>First Name</label>
        <input class="w3-input" type="text" name="fName">
        <label>Last Name</label>
        <input class="w3-input" type="text" name="lName">

        <label>Select Product</label>
        <select class="w3-select" name="product">
            <?php
            foreach ($productsArray as $key => $value) {
                echo "<option value='$key'> $value[0]</option><br>"; }
            ?>
        </select>

        <input type="submit" value="Submit Order" />
    </form>
    <div class="w3-container">
        <table class="w3-table w3-table-all">
            <tr class="w3-blue-gray">
                <th>Item Code</th>
                <th>Description</th>
                <th>Unit Price</th>
            </tr>
            <?php
                foreach ($productsArray as $key => $value) {
                    echo "<tr>";
                    echo "<td>$key</td>";
                    echo "<td>{$value[0]}</td>";
                    echo "<td>$" . number_format($value[1], 2) . "</td>";
                    echo "</tr>";
                }
            ?>
        </table>
    </div>
</body>
</html>