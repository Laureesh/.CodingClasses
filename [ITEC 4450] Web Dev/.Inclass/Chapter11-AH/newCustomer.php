<?php
   include "utilFunctions.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Customer</title>
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
            <h2>New Customer</h2>
        </header>

        <?php
            include "mainMenu.php";
        ?>

        <form action="newCustomer.php" method="POST" class="w3-container w3-sand">
            <fieldset>
                <label>First Name</label>
                <input type="text" name="fName" class="w3-input w3-border">
                <!-- <... class="w3-input w3-border" required> -->
                 <!-- could add required attribute to input fields to enforce client-side validation -->

                <label>Last Name</label>
                <input type="text" name="lName" class="w3-input w3-border">

                <label>Address</label>
                <input type="text" name="address" class="w3-input w3-border">

                <label>City</label>
                <input type="text" name="city" class="w3-input w3-border">

                <label>State</label>
                <input type="text" name="state" class="w3-input w3-border">

                <label>Zip</label>
                <input type="text" name="zip" class="w3-input w3-border">
            </fieldset>
            <br><input type="submit" name="submit" class="w3-btn w3-blue-grey" value="Add New Customer">
        </form>
        <div class="w3-container w3-sand">
            <?php
                if (isset($_POST['submit'])) {
                    // empty(trim($_POST['fName'])) 
                    if (!isset($_POST['fName']) || !isset($_POST['lName']) || !isset($_POST['address']) || !isset($_POST['city']) || !isset($_POST['state']) || !isset($_POST['zip'])) {
                        echo "You have not entered all the required information. Please go back and try again.";
                        exit;     
                    }
                    
                    include "connectDatabase.php";

                    # create short variable names
                    $fName = mysqli_real_escape_string($conn, $_POST['fName']);
                    $lName = mysqli_real_escape_string($conn, $_POST['lName']);
                    $address = mysqli_real_escape_string($conn, $_POST['address']);
                    $city = mysqli_real_escape_string($conn, $_POST['city']);
                    $state = mysqli_real_escape_string($conn, $_POST['state']);
                    $zip = mysqli_real_escape_string($conn, $_POST['zip']);

                    $sql = "INSERT INTO customer (firstName, lastName, address, city, state, zip) VALUES ('$fName', '$lName', '$address', '$city', '$state', '$zip')";

                    if ($conn->query($sql) === TRUE) {
                        $customer_id = $conn->insert_id;
                        echo "<b>Customer created successfully!</b><br>";
                        echo "Customer ID: $customer_id<br>";
                        echo "First Name: $fName<br>";
                        echo "Last Name: $lName<br>";
                        echo "Address: $address<br>";
                        echo "City: $city<br>";
                        echo "State: $state<br>";
                        echo "Zip: $zip<br>";
                    }

                    $conn->close();
                }
            ?>
        </div>
    </div>
</body>
</html>