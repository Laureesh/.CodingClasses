<?php
   include "utilFunctions.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="w3-container w3-blue-grey">
        <header class="w3-display-container w3-center">
            <div class="w3-display-right w3-container">
                <img src="manRiceEat.png" alt="" style="width:20%;">
            </div>

            <h1>Jimmy Take Out</h1>
            <h2>View Orders</h2>
        </header>

        <?php
            include "mainMenu.php";
        ?>

        <div class="w3-container w3-sand">
            <?php
                include "connectDatabase.php";

                // Query to show orders with customer and dish info
                /* $sql = "SELECT 
                            o.order_id AS ID,
                            c.firstName AS firstName,
                            c.lastName AS lastName,
                            o.date AS date,
                            d.name AS dish,
                            o.totalPrice AS totalPrice
                        FROM orders o
                        JOIN customer c ON o.customer_id = c.customer_id
                        JOIN dishorder do ON o.order_id = do.order_id
                        JOIN dish d ON do.dish_id = d.dish_id
                        ORDER BY o.date DESC"; */
                $sql = "SELECT o.order_id, c.customer_id, c.firstName, c.lastName, o.date, d.name, o.totalPrice ";
                $sql .= "FROM customer c, dishorder dor, orders o, dish d ";
                $sql .= "WHERE c.customer_id = o.customer_id AND o.order_id = dor.order_id AND dor.dish_id = d.dish_id ";
                $sql .= "ORDER BY o.order_id ";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<table class='w3-table w3-striped'>";
                    echo "  <tr class='w3-teal'>";
                    echo "      <th>ID</th>";
                    echo "      <th>First Name</th>";
                    echo "      <th>Last Name</th>";
                    echo "      <th>Date</th>";
                    echo "      <th>Dish</th>";
                    echo "      <th>Total Price</th>";
                    echo "  </tr>";

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "  <td>".$row['order_id']."</td>";
                        echo "  <td>".$row['firstName']."</td>";
                        echo "  <td>".$row['lastName']."</td>";
                        echo "  <td>".$row['date']."</td>";
                        echo "  <td>".$row['name']."</td>";
                        echo "  <td>".$row['totalPrice']."</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } 
                else {
                    echo "0 results<br>";
                }
                $conn->close();
            ?>
        </div>
    </div>
</body>
</html>