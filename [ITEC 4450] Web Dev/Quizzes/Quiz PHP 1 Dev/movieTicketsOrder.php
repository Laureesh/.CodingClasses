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
    <form action="movieTicketsReceipt.php" method="POST" class="w3-container w3-sand">
        <label>First Name</label><br>
        <input type="text" name="fName" class="w3-select"><br>
        <label>Last Name</label><br>
        <input type="text" name="lName" class="w3-select"><br>
        <label>Movie Title</label><br>
        <input type="text" name="mTitle" class="w3-select"><br>
        <label>Number of Tickets</label><br>
        <select name="numTickets" class="w3-select">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select><br>
        <input type="submit" value="Submit" class="w3-black w3-btn">
    </form>
</body>

</html>