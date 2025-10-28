<?php
   include "utilFunctions.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Customer</title>
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
            <h2>Delete Customer</h2>
        </header>

        <?php
            include "mainMenu.php";
        ?>

        <form action="deleteCustomer.php" method="POST" class="w3-container w3-sand">
            <fieldset>
                <label>Customer</label>
                <select name="customer" class="w3-select">
                    <option value="" disabled selected>Choose customer</option>
                    <?php
                        include "connectDatabase.php";

                        # Only display customers who do NOT have orders
                        # We don't allow to remove customers with orders
                        $sql = "SELECT c.customer_id, c.firstName, c.lastName ";
                        $sql .= "FROM customer c LEFT JOIN orders o ";
                        $sql .= "ON c.customer_id = o.customer_id ";
                        $sql .= "WHERE o.order_id IS NULL ";

                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                $customerId = $row['customer_id'];
                                $customerFirstName = $row['firstName'];
                                $customerLastName = $row['lastName'];

                                echo "<option value='$customerId'>$customerId-$customerLastName, $customerFirstName</option>";
                            }
                        }
                        $conn->close();
                    ?>
                </select><br>
                <b>NOTE</b>: Only customers with no orders can be deleted.
            </fieldset>
            <br><input type="submit" name="submit" class="w3-btn w3-blue-grey" value="Delete Customer">
        </form>
        <div class="w3-container w3-sand">
            <?php
                if (isset($_POST['submit'])) {
                    if (!isset($_POST['customer'])) {
                        echo "You have not selected a customer. Please go back and try again.";
                        exit;     
                    }

                    $customer_id = $_POST['customer'];

                    include "connectDatabase.php";
                    
                    $sql = "DELETE ";
                    $sql .= "FROM customer ";
                    $sql .= "WHERE customer_id = '$customer_id' ";

                    if ($conn->query($sql) === TRUE) {
                        echo "Customer record for customer_id=$customer_id successfully deleted!<br>";
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