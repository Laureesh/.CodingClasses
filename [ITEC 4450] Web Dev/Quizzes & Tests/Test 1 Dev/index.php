<?php
    $productsArray = [
        0 => ['Grilled chicken', 12.50], 
        1 => ['Chicken tenders', 5.50], 
        2 => ['Chicken parmesan', 14.25],
        3 => ['Chicken sandwich', 8]      
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
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-amber.css">
</head>
<body class="w3-theme">
    <header class="w3-center w3-display-container">
        <h1 class="w3-cursive">Los Pollos Hermanos</h1>
        <h2>Home Page</h2>
        <img src="Los_Pollos_Hermanos_logo.png" class="w3-display-topright w3-container" style="width:100%;max-width:200px">
    </header>
    <?php include "menu.php" ?>
    <form action="processOrder.php" method="post" class="w3-theme-l4">

        <label>Select Product</label>        
        <select class="w3-select" name="product">	
            <?php
				// Enter your code here to display the drop-down list of products
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
                // Enter your code here to display the table rows with item code, description and unit price
            ?>               
        </table>        
    </div>
    <br><br>
    <footer class="w3-theme-l2">
      Logo from <a href="https://en.wikipedia.org/wiki/Los_Pollos_Hermanos">Wikipedia</a>
    </footer>
</body>
</html>