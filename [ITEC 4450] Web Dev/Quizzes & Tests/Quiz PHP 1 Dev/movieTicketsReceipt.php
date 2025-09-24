<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Tickets Order Form</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>

<body class="w3-sand w3-card-2" style="width:50%">
    <header class="w3-container w3-blue w3-center">
        <h1 class="w3-text-white">Movie Tickets</h1>
    </header>
    <h1>Purchase Successful!</h1>
    <?php
    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $mTitle = $_POST['mTitle'];
    $numTickets = $_POST['numTickets'];
    $pricePerTicket = 8.60;

    $total = $numTickets * $pricePerTicket;

    echo "<hr><b>First Name</b>: $fName<br>";
    echo "<b>Last Name</b>: $lName<br>";
    
    echo "<hr><b>Movie Title</b>: $mTitle<br>";
    echo "<b>Number of Tickets</b>: $numTickets<br>";
    echo "<b>Price Per Ticket</b>: $" . number_format($pricePerTicket, 2) . "<br>";
    echo "<b>Total:</b> $" . number_format($total, 2) . "<br>";
    ?>
</body>
</html>