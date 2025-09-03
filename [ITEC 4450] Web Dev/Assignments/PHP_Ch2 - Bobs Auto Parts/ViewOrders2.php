<?php
    $document_root = $_SERVER['DOCUMENT_ROOT'];

    // shorthand for htmlspecialchars
    function hsc($text) {
        return htmlspecialchars(string: $text);
    }

    // convert array to table row
    function toTableRow($myArray) {
        // retrieve number of elements of $myArray
        $n = is_countable(value: $myArray)? count($myArray) : 0;

        // begin row
        $result = "<tr>";

        // loop through all elements of $myArray and add a column for each one
        for ($i = 0; $i < $n; $i++) {
            $result .= "<td>".hsc($myArray[$i])."</td>";
        }

        // end row
        $result .= "</tr>";

        return $result;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bob's Auto Parts - Customer Orders</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body class="w3-sand">
    <div class="w3-container w3-center">
        <h1>Bob's Auto Parts</h1>
        <h2>Customer Orders</h2>
    </div>

    <div class="w3-container w3-light-gray">
        <?php
            $path = "orders/";
            @$fp = fopen($path."orders.txt", "rb");
            
            if (!$fp) {
                echo "<br>No orders pending. Please try again later";
                exit;
            }

            flock( $fp, LOCK_SH ); // lock the file for reading

            echo "<table class='w3-table w3-table-all'> ";
            echo "  <tr class='w3-blue-gray'> ";
            echo "      <th>Date</th>";
            echo "      <th>Num tires</th>";
            echo "      <th>Num oil</th>";
            echo "      <th>Num sparks</th>";
            echo "      <th>Total</th>";
            echo "      <th>Address</th>";
            echo "  </tr>";

            // loop through all the file rows
            while (!feof($fp)) {
                $order = fgetcsv($fp,0,"\t");

                echo toTableRow($order);
            }

            echo "</table>";

            echo "<hr />";
            echo "Final position of the file pointer is ".(ftell($fp));
            echo "<br>";
            rewind($fp);
            echo "After rewind, the position of the file pointer is ".(ftell($fp));

            flock( $fp, LOCK_UN ); // unlock the file
            fclose($fp);
        ?>
    </div>
</body>
</html>