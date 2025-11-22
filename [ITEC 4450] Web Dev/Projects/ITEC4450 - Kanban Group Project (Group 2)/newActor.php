<?php include "utilFunctions.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieFlix - Add New Actor</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="w3-container w3-black">
        <?php include "movieAdminMainMenu.php"; ?>
        <header class="w3-display-container w3-center">
            <h1><b>MovieFlix</b></h1>
            <h2>Add New Actor</h2>
        </header>
        <form method="POST" class="w3-container w3-light-grey">
            <fieldset>
                <legend class="w3-large w3-center w3-text-theme"><b>Actor Details</b></legend>
                <label>Actor Name</label>
                <input type="text" name="actor_name" class="w3-input w3-border" required>
                <label>Bio</label>
                <textarea name="bio" class="w3-input w3-border" required></textarea>
                <label>Birth Year</label>
                <input type="number" name="birth_year" class="w3-input w3-border" min="1900" max="2025" required>
                <label>Photo URL</label>
                <input type="text" name="photo_url" class="w3-input w3-border" required>
            </fieldset>
            <br><input type="submit" name="submit" class="w3-btn w3-black" value="Add New Actor">
        </form>
        <div class="w3-container w3-light-grey">
            <?php
                if (isset($_POST['submit'])) {
                    if (!isset($_POST['actor_name']) || !isset($_POST['bio']) || !isset($_POST['birth_year']) || !isset($_POST['photo_url'])) {
                        echo "You have not entered all the required information. Please go back and try again.";
                        exit;
                    }
                    include "connectDatabase.php";
                    $actor_name = mysqli_real_escape_string($conn, $_POST['actor_name']);
                    $bio = mysqli_real_escape_string($conn, $_POST['bio']);
                    $birth_year = mysqli_real_escape_string($conn, $_POST['birth_year']);
                    $photo_url = mysqli_real_escape_string($conn, $_POST['photo_url']);
                    $sql = "INSERT INTO actors (actor_name, bio, birth_year, photo_url) VALUES ('$actor_name', '$bio', '$birth_year', '$photo_url')";
                    if ($conn->query($sql) === TRUE) {
                        $actor_id = $conn->insert_id;
                        echo "<b>Actor added successfully!</b><br>";
                        echo "Actor ID: $actor_id<br>";
                        echo "Name: $actor_name<br>";
                        echo "Bio: $bio<br>";
                        echo "Birth Year: $birth_year<br>";
                        echo "Photo URL: $photo_url<br>";
                    }
                    $conn->close();
                }
            ?>
        </div>
    </div>
</body>
</html>