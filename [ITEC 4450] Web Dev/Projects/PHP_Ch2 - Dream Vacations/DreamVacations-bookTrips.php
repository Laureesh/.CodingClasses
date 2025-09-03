<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dream Vacations Booking</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        h1,
        h2 {
            text-shadow: 1px 1px 0 #444;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }
    </style>
</head>

<body>
    <div class="w3-container w3-sand">
        <header class="w3-display-container w3-green" style="height:130px;">

            <div class="w3-display-topright">
                <img src="planeSmall.png">
            </div>

            <div class="w3-display-topmiddle" style="text-align:center;">
                <h1>Dream Vacations</h1>
                <h2>Trip Booking</h2>
            </div>
        </header>
        <nav class="w3-bar w3-border w3-light-grey">
            <a href="DreamVacations-bookTrips.php" class="w3-bar-item w3-button">Booking</a>
            <a href="DreamVacations-showReservations.php" class="w3-bar-item w3-button">Show Reservations</a>
        </nav>
        <form class="w3-container" method="POST">
            <label>First name</label>
            <input type="text" class="w3-input" name="fName">

            <label>Last name</label>
            <input type="text" class="w3-input" name="lName">

            <label>Destination</label>
            <select name="destination" class="w3-select">
                <option value="PEK">Beijing-PEK</option>
                <option value="CAI">Cairo-CAI</option>
                <option value="JFK">New York-JFK</option>
                <option value="CDG">Paris-CFG</option>
                <option value="NRT">Tokyo-NRT</option>
                <option value="GIG">Rio de Janeiro-GIG</option>
            </select>

            <label>Number of passengers</label>
            <select name="numberOfPassengers" class="w3-select">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>

            <label>Date from</label>
            <input type="date" class="w3-input" name="dateFrom">

            <label>Date to</label>
            <input type="date" class="w3-input" name="dateTo">

            <input type="submit" value="submit" name="submit" class="w3-btn w3-green">
        </form>
        <div class="w3-container">
            <?php

            if (isset($_POST['submit'])) {
                echo "<br>Form submitted!<br>";

                if (empty($_POST['fName']) || empty($_POST['lName']) || empty($_POST['destination']) || empty($_POST['numberOfPassengers']) || empty($_POST['dateFrom']) || empty($_POST['dateTo'])) {
                    echo "Some fields are empty. Please complete the form and try again<br>";
                    exit;
                }

                $allDestinations = array(
                    "PEK" => "Beijing",
                    "CAI" => "Cairo",
                    "JFK" => "New York",
                    "CDG" => "Paris",
                    "NRT" => "Tokyo",
                    "GIG" => "Rio de Janeiro"
                );

                $fName = $_POST['fName'];
                $lName = $_POST['lName'];
                $destination = $_POST['destination'];
                $numPassengers = $_POST['numberOfPassengers'];
                $dateFrom = $_POST['dateFrom'];
                $dateTo = $_POST['dateTo'];

                echo "<h3>Booking Successful!</h3>";
                echo "<b>First Name:</b> $fName<br>";
                echo "<b>Last Name:</b> $lName<br>";
                echo "<b>Destination:</b> " . $allDestinations[$destination] . " ($destination)<br>";
                echo "<b>Number of Passengers:</b> $numPassengers<br>";
                echo "<b>Begin Date:</b> $dateFrom<br>";
                echo "<b>End Date:</b> $dateTo<br>";

                #write to file
                $outputStr = date('Y-m-d H:i:s') . ','; # booking date
                $outputStr .= $fName . ",";
                $outputStr .= $lName . ",";
                $outputStr .= $destination . ",";
                $outputStr .= $numPassengers . ",";
                $outputStr .= $dateFrom . ",";
                $outputStr .= $dateTo . PHP_EOL;

                $fileName = "bookings.csv";
                @$fp = fopen($fileName, 'a');

                if (!$fp) {
                    echo "<p><strong>Your order could not be processed at this time. Please try again later</strong></p>";
                    exit;
                }

                #lock the file
                flock($fp, LOCK_EX);

                #write to file
                fwrite($fp, $outputStr, strlen($outputStr));

                #unlock the file
                flock($fp, LOCK_UN);

                #close the file
                fclose($fp);
            }
            ?>
        </div>
    </div>
</body>

</html>