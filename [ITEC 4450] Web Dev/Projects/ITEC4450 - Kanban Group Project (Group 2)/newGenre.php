<?php include "utilFunctions.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieFlix - Add New Genre</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="w3-container w3-black">
        <?php include "movieAdminMainMenu.php"; ?>
        <header class="w3-display-container w3-center">
            <h1><b>MovieFlix</b></h1>
            <h2>Add New Genre</h2>
        </header>
        <form method="POST" class="w3-container w3-light-grey">
            <fieldset>
                <legend class="w3-large w3-center w3-text-theme"><b>Genre Details</b></legend>
                <label>Genre Name</label>
                <input type="text" name="genre_name" class="w3-input w3-border" required>
            </fieldset>
            <br><input type="submit" name="submit" class="w3-btn w3-black" value="Add New Genre">
        </form>
        <div class="w3-container w3-light-grey">
            <?php
            if (isset($_POST['submit'])) {
                if (!isset($_POST['genre_name'])) {
                    echo "You have not entered all the required information. Please go back and try again.";
                    exit;
                }

                include "connectDatabase.php";
                $genre_name = mysqli_real_escape_string($conn, $_POST['genre_name']);
                $sql = "INSERT INTO genres (genre_name) VALUES ('$genre_name')";

                if ($conn->query($sql) === TRUE) {
                    echo "<div class='w3-panel w3-green'>
                            <b>Genre added successfully!</b><br>
                            Genre ID: " . $conn->insert_id . "<br>
                            Genre Name: " . ($genre_name) . "
                        </div>";
                } else {
                    echo "<div class='w3-panel w3-red'>
                            <b>Error:</b> " . $conn->error . "
                        </div>";
                }
                $conn->close();
            }
            ?>
        </div>
    </div>
</body>
</html>