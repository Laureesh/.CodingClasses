<?php
   include "utilFunctions.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Dish</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="w3-container w3-blue-grey">
        <header class="w3-display-container w3-center">
            <div class="w3-display-right w3-container">
                <img src="manRiceEat.png" style="width:20%;">
            </div>

            <h1>Jimmy Take Out</h1>
            <h2>Delete Dish</h2>
        </header>

        <?php
            include "mainMenu.php";
        ?>

        <form action="deleteDish.php" method="POST" class="w3-container w3-sand">
            <fieldset>
                <label>Dish</label>
                <select name="dish" class="w3-select">
                    <option value="" disabled selected>Choose dish</option>
                    <?php
                        include "connectDatabase.php";

                        # select dishes that are not part of any order
                        $sql = "SELECT d.* ";
                        $sql .= "FROM dish d LEFT JOIN dishorder ";
                        $sql .= "ON dishorder.dish_id = d.dish_id ";
                        $sql .= "WHERE dishorder.order_id IS NULL ";

                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                $dishId = $row['dish_id'];
                                $dishName = $row['name'];

                                echo "<option value='$dishId'>$dishId-$dishName</option>";
                            }
                        }
                        $conn->close();
                    ?>
                </select><br>
                <b>NOTE</b>: Only dishes with no orders can be deleted.
            </fieldset>
            <br><input type="submit" name="submit" class="w3-btn w3-blue-grey" value="Delete Dish">
        </form>
        <div class="w3-container w3-sand">
            <?php
                if (isset($_POST['submit'])) {
                    if (!isset($_POST['dish'])) {
                        echo "You have not entered all the required details. Please go back and try again.";
                        exit;     
                    }

                    $dish_id = $_POST['dish'];

                    include "connectDatabase.php";
                    
                    $sql = "DELETE ";
                    $sql .= "FROM dish ";
                    $sql .= "WHERE dish_id = '$dish_id' ";

                    if ($conn->query($sql) === TRUE) {
                        echo "Dish record for dish_id=$dish_id successfully deleted!<br>";
                    } else {
                        echo "Error: $sql<br>".$conn->error;
                    }
                    $conn->close();

                    # refresh current page to update the dropdown list
                    header("Refresh:0");
                }
            ?>
        </div>
    </div>
</body>
</html>