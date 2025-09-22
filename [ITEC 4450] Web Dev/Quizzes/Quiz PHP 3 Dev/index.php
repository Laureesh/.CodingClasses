<?php
    $productsArray = [
        0 => ['Beef chimichanga', 14.25],
        1 => ['Chicken burrito', 11.50], 
        2 => ['Chicken enchilada', 12.50], 
        3 => ['Fajita Supreme', 17.50] ,     
        4 => ['Pollo loco', 14.00],
        5 => ['Taco al pastor', 9.50]        
    ];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-khaki.css">

    <!-- Google fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
    <style>
      h1 {
        font-family: 'Tangerine', serif;
        font-size: 50px;
        font-weight: bold;
      }
    </style>
</head>
<body class="w3-theme">
    <header class="w3-center w3-display-container">
        <h1>Los Mariachis Mexican Restaurant</h1>
        <h2>Home Page</h2>
        <img src="taco.png" class="w3-display-topleft w3-container" style="width:100%;max-width:200px">
        <img src="mariachis.png" class="w3-display-topright w3-container" style="width:100%;max-width:200px">
    </header>
    <?php include "menu.php" ?>
    <form action="processOrder.php" method="post" class="w3-theme-l4">

        <label>Select Product</label>        
        <select class="w3-select" name="product">	
            <?php
				# write your code here
                foreach ($productsArray as $key => $value) {
                echo "<option value='$key'> $value[0]</option><br>"; }
            ?>  
        </select>

        <label>Enter quantity</label>  
        <input class="w3-input" type="text" name="quantity" size="3" maxlength="3">

        <input type="submit" name="submit" value = "Submit Order" />
    </form>
    <br>
    <div class="w3-container">
        <table class="w3-table w3-table-all">
            <tr class="w3-theme-d5">
                <th>Item Code</th>
                <th>Description</th>
                <th>Unit Price</th>
            </tr>
            <?php                            
                # write your code here   
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
    <br><br>
    <footer class="w3-theme-l2">
      Cliparts from <a href="https://www.clipartmax.com/">Clipartmax</a>
    </footer>
</body>
</html>