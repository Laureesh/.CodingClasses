<?php
   include "utilFunctions.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Dish</title>
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
            <h2>New Dish</h2>
        </header>

        <?php
            include "mainMenu.php";
        ?>

        <form action="newDish.php" method="POST" class="w3-container w3-sand">
            <fieldset>
                <label>Dish Name</label>
                <input type="text" name="dishName" class="w3-input w3-border">

                <label>Ingredients</label>
                <input type="text" name="ingredients" class="w3-input w3-border">

                <label>Price</label>
                <input type="text" name="price" class="w3-input w3-border">
            </fieldset>
            <br><input type="submit" name="submit" class="w3-btn w3-blue-grey" value="Add New Dish">
        </form>
        <div class="w3-container w3-sand">
            <?php
                if (isset($_POST['submit'])) {
                    if (!isset($_POST['dishName']) || !isset($_POST['ingredients']) || !isset($_POST['price'])) {
                        echo "You have not entered all the required information. Please go back and try again.";
                        exit;     
                    }
                    
                    include "connectDatabase.php";

                    # create short variable names
                    $dishName = mysqli_real_escape_string($conn, $_POST['dishName']);
                    $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);
                    $price = mysqli_real_escape_string($conn, $_POST['price']);

                    $sql = "INSERT INTO dish (name, ingredients, price) VALUES ('$dishName', '$ingredients', '$price')";

                    if ($conn->query($sql) === TRUE) {
                        $dish_id = $conn->insert_id;
                        echo "<strong>New dish created successfully!</strong><br>";
                        echo "Dish ID: $dish_id<br>";
                        echo "Dish Name: $dishName<br>";
                        echo "Ingredients: $ingredients<br>";
                        echo "Price: $price<br>";
                    }

                    $conn->close();
                }
            ?>
        </div>
    </div>
</body>
</html>