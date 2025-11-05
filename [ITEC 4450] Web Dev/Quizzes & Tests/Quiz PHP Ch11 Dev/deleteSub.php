<?php
   include "utilFunctions.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Sub</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-cyan.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="w3-container w3-theme-d5">
        <header class="w3-display-container w3-center">
            <h1>727 SUBS</h1>
            <h2>Delete Sub</h2>
        </header>

        <?php
            include "mainMenu.php";
        ?>

        <form action="deleteSub.php" method="POST" class="w3-container w3-pale-blue">
            <fieldset>
                <label>Sub</label>
                <select name="sub" class="w3-select">
                    <option value="" disabled selected>Choose sub</option>
                    <?php
                        include "connectDatabase.php";

                        # Only display subs who do NOT have orders
                        # We don't allow to remove subs with orders
                        $sql = "SELECT s.sub_id, s.name, s.ingredients ";
                        $sql .= "FROM sub s ";

                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                $subId = $row['sub_id'];
                                $subName = $row['name'];
                                $ingredients = $row['ingredients'];

                                echo "<option value='$subId'>$subId-$subName|$ingredients</option>";
                            }
                        }
                        $conn->close();
                    ?>
                </select><br>
                <b>NOTE</b>: Only subs can be deleted.
            </fieldset>
            <br><input type="submit" name="submit" class="w3-btn w3-blue-grey" value="Delete Sub">
        </form>
        <div class="w3-container w3-pale-blue">
            <?php
                if (isset($_POST['submit'])) {
                    if (!isset($_POST['sub'])) {
                        echo "You have not selected a sub. Please go back and try again.";
                        exit;     
                    }

                    $sub_id = $_POST['sub'];

                    include "connectDatabase.php";
                    
                    $sql = "DELETE ";
                    $sql .= "FROM sub ";
                    $sql .= "WHERE sub_id = '$sub_id' ";

                    if ($conn->query($sql) === TRUE) {
                        echo "Sub record for sub_id=$sub_id successfully deleted!<br>";
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