<?php
   include "utilFunctions.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Customers</title>
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
            <h2>Show Customers</h2>
        </header>

        <?php
            include "mainMenu.php";
        ?>

        <div class="w3-container w3-sand">
            <?php
                include "connectDatabase.php";

                $sql = "SELECT * ";
                $sql .= "FROM customer ";
                $sql .= "ORDER BY lastName, firstName ";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<table class ='w3-table w3-striped'>";
                    echo "  <tr class='w3-teal'>";
                    echo "      <th>ID</th>";
                    echo "      <th>First Name</th>";
                    echo "      <th>Last Name</th>";
                    echo "      <th>Address</th>";
                    echo "      <th>City</th>";
                    echo "      <th>State</th>";
                    echo "      <th>Zip</th>";
                    echo "  </tr>";

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "  <td>".$row['customer_id']."</td>";
                        echo "  <td>".$row['firstName']."</td>";
                        echo "  <td>".$row['lastName']."</td>";
                        echo "  <td>".$row['address']."</td>";
                        echo "  <td>".$row['city']."</td>";
                        echo "  <td>".$row['state']."</td>";
                        echo "  <td>".$row['zip']."</td>";
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