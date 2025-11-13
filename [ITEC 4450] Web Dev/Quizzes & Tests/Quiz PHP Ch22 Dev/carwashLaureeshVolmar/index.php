<?php
    # student code
    # begin session
    session_start();

    $productsArray = [
        0 => ['Basic', 'Exterior machine wash', 10],
        1 => ['Tire Shine', 'Basic + tire shine', 20],
        2 => ['Hot Wax', 'Basic + interior hand wash', 25],
        3 => ['Ceramic Sea Gloss', 'Hot Wax + Glossy finish', 40]
    ];

    # student code
    # Write code below to store $productsArray into a session variable called productsArray
    $_SESSION['productsArray'] = $productsArray;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-deep-purple.css">
    <style>
        h1 { font-family: 'Trebuchet MS', sans-serif; }
    </style>
</head>
<body class="w3-theme-l4">
    <div class="w3-container w3-center w3-theme-d3">
        <h1>Larry Car Wash</h1>
        <h2>Order Form</h2>
        <img src="Car-High-Quality.png" width="30%" height="20%" class="w3-display-topright" />
    </div>
    <?php include "menu.php"; ?>
    <form action="ProcessOrder.php" method="post">

        <label>Select Product</label>
        <select class="w3-select" name="product">
            <?php
                # student code
                # loop through $productsArray to create a dropdown list of car wash types
                foreach($productsArray as $key => $value) {
                    echo "<option value='$key'>$value[0]</option>";
                }
            ?>
        </select>

        <label>Enter quantity</label>
        <input class="w3-input" type="text" name="quantity" size="3" maxlength="3">

        <input type="submit" value="Submit Order" />
    </form>
    <div class="w3-container">
        <table class="w3-table w3-table-all">
            <tr class="w3-theme-d5">
                <th>Item Code</th>
                <th>Name</th>
                <th>Description</th>
                <th>Unit Price</th>
            </tr>
            <?php
                foreach($productsArray as $key => $value) {
                    echo "<tr>";
                    echo "<td>$key</td>";
                    echo "<td>$value[0]</td>";
                    echo "<td>$value[1]</td>";
                    echo "<td>$" . number_format($value[2], 2) . "</td>";
                    echo "</tr>";
                }
            ?>
        </table>
    </div>
    <footer>
        <a href="http://clipart-library.com/clipart/Car-High-Quality-PNG.htm">Clipart-art Library</a>
    </footer>
</body>
</html>