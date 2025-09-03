<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Receive Data Example</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>

<body>
    <div class="w3-card-4" style="width:50%">
        <header class="w3-container w3-teal w3-center">
            <h1>Student Information</h1>
        </header>

        <div class="w3-container w3-sand">
            <?php
            # When using GET method, data is visible in the URL.<br>
            # When using POST method, data is not visible in the URL
            /* Debugging code
            echo "<pre>";
            print_r($_POST);
            echo "</pre>";
            */
            if (isset($_POST['fName']) && isset($_POST['mName']) && isset($_POST['lName'])) {
                $fName = $_POST['fName'];
                $mName = $_POST['mName'];
                $lName = $_POST['lName'];
                $classification = $_POST['classification'];

                echo "<h3>Form Successfully Received!</h3>";
                echo "<b>First Name</b>: $fName<br>";
                echo "<b>Middle Name</b>: $mName<br>";
                echo "<b>Last Name</b>: $lName<br>";
                echo "<b>Classification</b>: $classification<br>";
            }
            else {
                echo "<h3>No data received. Please submit the form first.</h3>";
            }
            ?>

        </div>
    </div>
</body>

</html>