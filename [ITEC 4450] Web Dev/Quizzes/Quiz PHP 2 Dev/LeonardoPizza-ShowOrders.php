<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dream Vacations Reservations</title>
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
                <h2>All Orders</h2>
            </div>
        </header>
        <nav class="w3-bar w3-border w3-light-grey">
            <a href="LeonardoPizza-Order.php" class="w3-bar-item w3-button">Order</a>
            <a href="LeonardoPizza-ShowOrders.php" class="w3-bar-item w3-button">Show Orders</a>
        </nav>
        <div class="w3-container">
            <?php
            $document_root = $_SERVER['DOCUMENT_ROOT'];

            // open the file for reading
            $myFile = fopen("pizzaOrder.csv", "r") or die("Unable to open file!");

            // create the table and header row
            $outTable = "<table class='w3-table w3-striped w3-border'>";
            $outTable .= "  <tr class='w3-teal'>";
            $outTable .= "      <th>Date/Time</th>";
            $outTable .= "      <th>First Name</th>";
            $outTable .= "      <th>Last Name</th>";
            $outTable .= "      <th>Pizza Name</th>";
            $outTable .= "      <th>Pizza Size</th>";
            $outTable .= "      <th>Total</th>";
            $outTable .= "  </tr>";

            // read each line of the file and add a row to the table
            while (!feof($myFile)) {
                // allow access to global variable $outTable
                // global $outTable;

                // read the current line as an array
                $curLineArray = fgetcsv($myFile, 0, ',');

                // add a new row to the table
                $outTable .= "<tr>";
                // get the number of columns in the current line
                $n = is_countable($curLineArray) ? count($curLineArray) : 0;
                
                // loop through each column and add a cell to the row
                for ($i = 0; $i < $n; $i++) {
                    // add a cell to the row
                    $outTable .= "<td>" . $curLineArray[$i] . "</td>";
                }
                // close the row
                $outTable .= "</tr>";
            }
            // close the file
            fclose($myFile);

            // close the table
            $outTable .= "</table>";

            // display the table
            echo $outTable;

            ?>
        </div>
    </div>
</body>

</html>