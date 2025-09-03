<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dream Vacations Reservations</title>
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
                <h2>Reservations' List</h2>
            </div>
        </header>
        <nav class="w3-bar w3-border w3-light-grey">
            <a href="DreamVacations-bookTrips.php" class="w3-bar-item w3-button">Booking</a>
            <a href="DreamVacations-showReservations.php" class="w3-bar-item w3-button">Show Reservations</a>
        </nav>
        <div class="w3-container">
            <?php
            $document_root = $_SERVER['DOCUMENT_ROOT'];

            $myFile = fopen("bookings.csv", "r") or die("Unable to open file!");

            $outTable = "<table class='w3-table w3-striped w3-border'>";
            $outTable .= "  <tr class='w3-teal'>";
            $outTable .= "      <th>Date</th>";
            $outTable .= "      <th>First Name</th>";
            $outTable .= "      <th>Last Name</th>";
            $outTable .= "      <th>City</th>";
            $outTable .= "      <th>Num Passengers</th>";
            $outTable .= "      <th>Depart</th>";
            $outTable .= "      <th>Return</th>";
            $outTable .= "  </tr>";

            while (!feof($myFile)) {
                // allow access to global variable $outTable
                // global $outTable;

                $curLineArray = fgetcsv($myFile, 0, ',');

                $outTable .= "<tr>";
                $n = is_countable($curLineArray) ? count($curLineArray) : 0;
                
                for ($i = 0; $i < $n; $i++) {
                    $outTable .= "<td>" . $curLineArray[$i] . "</td>";
                }
                $outTable .= "</tr>";
            }
            fclose($myFile);

            $outTable .= "</table>";

            echo $outTable;

            ?>
        </div>
    </div>
</body>

</html>