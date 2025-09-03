<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Send Data Example</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>

<body>
    <div class="w3-card-4" style="width:50%">
        <header class="w3-container w3-teal w3-center">
            <h1>Student Information</h1>
        </header>

        <form action="form-ReceiveData.php" class="w3-container" method="POST">
            First Name <input type="text" name="fName"><br>
            Middle Name <input type="text" name="mName"><br>
            Last Name <input type="text" name="lName"><br>
            Classification
            <select name="classification">
                <option value="freshman">Freshman</option>
                <option value="sophomore">Sophomore</option>
                <option value="junior">Junior</option>
                <option value="senior">Senior</option>
                <option value="grad">Graduate Student</option>
            </select><br>
            <input type="submit" value="Submit">
        </form>
    </div>
</body>

</html>