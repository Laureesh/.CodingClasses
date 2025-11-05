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
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-cyan.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="w3-container w3-theme-d5">
        <header class="w3-display-container w3-center">
            <h1>727 SUBS</h1>
            <h2>New Sub</h2>
        </header>

        <?php
            include "mainMenu.php";
        ?>

        <form action="newSub.php" method="POST" class="w3-container w3-pale-blue">
            <fieldset>
                <label>Name</label>
                <input type="text" name="subName" class="w3-input w3-border">

                <label>Ingredients</label>
                <input type="text" name="ingredients" class="w3-input w3-border">

                <label>Bread Type</label>
                <select name="breadType" class="w3-select">
                    <option value="" disabled selected>Choose bread type</option>
                    <option value="White">White</option>
                    <option value="Wheat">Wheat</option>
                    <option value="Italian">Italian</option>
                    <option value="Sourdough">Sourdough</option>
                </select><br>

                <label>Price</label>
                <input type="text" name="price" class="w3-input w3-border">
            </fieldset>
            <br><input type="submit" name="submit" class="w3-btn w3-blue-grey" value="Add New Sub">
        </form>
        <div class="w3-container w3-pale-blue">
            <?php
                if (isset($_POST['submit'])) {
                    if (!isset($_POST['subName']) || !isset($_POST['ingredients']) || !isset($_POST['breadType']) || !isset($_POST['price'])) {
                        echo "You have not entered all the required information. Please go back and try again.";
                        exit;     
                    }
                    
                    include "connectDatabase.php";

                    # create short variable names
                    $subName = mysqli_real_escape_string($conn, $_POST['subName']);
                    $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);
                    $breadType = mysqli_real_escape_string($conn, $_POST['breadType']);
                    $price = mysqli_real_escape_string($conn, $_POST['price']);

                    $sql = "INSERT INTO sub (name, ingredients, breadType, price) VALUES ('$subName', '$ingredients', '$breadType', '$price')";

                    if ($conn->query($sql) === TRUE) {
                        $sub_id = $conn->insert_id;
                        echo "<strong>New sub created successfully!</strong><br>";
                        echo "Sub ID: $sub_id<br>";
                        echo "Sub Name: $subName<br>";
                        echo "Ingredients: $ingredients<br>";
                        echo "Bread Type: $breadType<br>";
                        echo "Price: $price<br>";
                    }

                    $conn->close();
                }
            ?>
        </div>
    </div>
</body>
</html>