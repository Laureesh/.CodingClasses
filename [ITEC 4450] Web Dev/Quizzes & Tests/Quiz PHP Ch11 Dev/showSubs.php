<?php
   include "utilFunctions.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Subs</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-cyan.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="w3-container w3-theme-d5">
        <header class="w3-display-container w3-center">
            <h1>727 SUBS</h1>
            <h2>Show Subs</h2>
        </header>

        <?php
            include "mainMenu.php";
        ?>

        <div class="w3-container w3-pale-blue">
            <?php
                include "connectDatabase.php";

                $sql = "SELECT * ";
                $sql .= "FROM sub ";
                $sql .= "ORDER BY sub_id ";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<table class ='w3-table w3-striped'>";
                    echo "  <tr class='w3-teal'>";
                    echo "      <th>ID</th>";
                    echo "      <th>Name</th>";
                    echo "      <th>Ingredients</th>";
                    echo "      <th>Price</th>";
                    echo "  </tr>";

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "  <td>".$row['sub_id']."</td>";
                        echo "  <td>".$row['name']."</td>";
                        echo "  <td>".$row['ingredients']."</td>";
                        echo "  <td>".$row['price']."</td>";
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