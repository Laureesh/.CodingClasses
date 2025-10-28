<?php
   include "utilFunctions.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Order</title>
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
            <h2>New Order</h2>
        </header>

        <?php
            include "mainMenu.php";
        ?>

        <form action="newOrder.php" method="POST" class="w3-container w3-sand">
            <fieldset>
                <label>Customer</label>
                <select class="w3-select" name="customer">
                    <option value="" disabled selected>Choose Customer</option>
                    <?php
                        include "connectDatabase.php";

                        # select customers who do not have orders
                        $sql = "SELECT c.customer_id, c.firstName, c.lastName ";
                        $sql .= "FROM customer c ";

                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                               $customerId = $row['customer_id'];
                               $customerFirstName = $row['firstName'];
                               $customerLastName = $row['lastName'];

                               echo "<option value='$customerId'>$customerId-$customerLastName, $customerFirstName</option>";
                            }
                        }
                    ?>
                </select><br><br>

                <!-- Dish Selection -->
                 <div class="w3-container w3-khaki w3-padding w3-border-blue-grey w3-leftbar w3-topbar w3-bottombar w3-rightbar">
                    <input name="dishSel" id="dishSel" value="None" type="hidden">
                    <label>Selected Dish(es)</label>
                    <select class="w3-select" name="listDishSel" id="listDishSel">


                    </select><br>
                    <input class="w3-button w3-teal w3-round-large" value="Remove dish" onclick="removeDish()"><br>

                    <label>Available Dishes</label>
                    <select class="w3-select" name="listDishAv" id="listDishAv">
                        
                        <?php
                            include "connectDatabase.php";

                            # select customers who do not have orders
                            $sql = "SELECT d.dish_id, d.name, d.price ";
                            $sql .= "FROM dish d ";

                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                   $dishId = $row['dish_id'];
                                   $dishName = $row['name'];
                                   $dishPrice = $row['price'];

                                   echo "<option value='$dishId'>$dishId-$dishName, $dishPrice</option>";
                                }
                            }
                        ?>
                    </select><br>
                    <input class="w3-button w3-teal w3-round-large" value="Add dish" onclick="addDish()"><br>
                 </div>
                 <!-- End Dish Selection -->
                  <br>
                  <label>Total Price: $</label>
                  <input name="price" id="price" value="" >
            </fieldset>

            <br><input type="submit" name="submit" class="w3-btn w3-blue-grey" value="Add New Order">
        </form>
        <div class="w3-container w3-sand">
            <?php
                if (isset($_POST['submit'])) {
                    if (!isset($_POST['customer']) || !isset($_POST['dishSel']) || !isset($_POST['price'])) {
                        echo "You have not entered all the required information. Please go back and try again.";
                        exit;     
                    }
                    
                    include "connectDatabase.php";

                    # create short variable names
                    $customer_id = mysqli_real_escape_string($conn, $_POST['customer']);
                    $price = mysqli_real_escape_string($conn, $_POST['price']);
                    $dishSel = mysqli_real_escape_string($conn, $_POST['dishSel']);
                    $orderDate = date("Y-m-d");

                    $sql = "INSERT INTO orders (customer_id, totalPrice, date) VALUES ('$customer_id', '$price', '$orderDate')";

                    if ($conn->query($sql) === TRUE) {
                        $order_id = $conn->insert_id;
                        echo "<strong>Order successfully created!</strong><br>";
                        echo "Order ID: $order_id<br>";
                        echo "Created on: $orderDate<br>";
                        echo "Customer ID: $customer_id<br>";
                        echo "Total Price: $price<br>";
                        echo "<hr>";
                        // ------------------------------------------------
                        // -- Create a new record in the dishOrder table --
                        // -- for each dish                              --
                        // ------------------------------------------------
                        // convert string of dishes' id to an array
                        $dishIdArray = explode(",", $dishSel);
                        for($i = 0; $i < count($dishIdArray); $i++) {
                            $curDishId = $dishIdArray[$i];

                            // if the dish_id is empty, do not create row.
                            // ignore and continue looping the rest of the array
                            if (empty($curDishId)) {
                                continue;
                            }
                            $sql = "INSERT INTO dishorder (order_id, dish_id) VALUES ('$order_id', '$curDishId')";
                            
                            if ($conn->query($sql) === TRUE) {
                                echo "Dish ID: $curDishId added successfully!<br>";
                            } else {
                                echo "Error: " . $sql . "<br>" . $conn->error;
                            }
                        } 
                    }
                    else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }
             $conn->close();
            ?>
        </div>
    </div>
    <script>
        function addDish() {
            var listSel = document.getElementById("listDishSel");
            var listAv = document.getElementById("listDishAv");
            var dishSel = document.getElementById("dishSel");

            // Make sure there are items to addDish
            if (listAv.options.length < 1) {
                return;
            }

            var listAvIndex = listAv.selectedIndex;
            var listAvInner = listAv[listAvIndex].innerHTML;
            var listAvVal = listAv[listAvIndex].value;

            listSel.options[listSel.options.length] = new Option(listAvInner, listAvVal);

            listAv[listAvIndex] = null;

            sortSelect(listSel);

            result = "";
            for (i = 0; i < listSel.options.length; i++) {
                result += listSel.options[i].value + ";";
            }
            dishSel.value = result;

            calcTotalPrice();
        }

        function removeDish() {
            var listSel = document.getElementById("listDishSel");
            var listAv = document.getElementById("listDishAv");
            var dishSel = document.getElementById("dishSel");

            // Make sure there are items to removeDish
            if (listSel.options.length < 1) {
                return;
            }

            var listSelIndex = listSel.selectedIndex;
            var listSelInner = listSel[listSelIndex].innerHTML;
            var listSelVal = listSel[listSelIndex].value;

            listAv.options[listAv.options.length] = new Option(listSelInner, listSelVal);

            listSel[listSelIndex] = null;

            sortSelect(listAv);

            result = "";
            for (i = 0; i < listSel.options.length; i++) {
                result += listSel.options[i].value + ";";
            }
            dishSel.value = result;

            calcTotalPrice();
        }

        function calcTotalPrice() {
            var listSel = document.getElementById("listDishSel");
            var priceField = document.getElementById("price");
            var totalPrice = 0;

            for (i = 0; i < listSel.options.length; i++) {
                curPrice = listSel.options[i].innerHTML.split(",")[1];
                curPrice = parseFloat(curPrice);

                totalPrice += curPrice;
            }

            priceOut.value = formatAmt(totalPrice);
        }
    </script>
</body>
</html>