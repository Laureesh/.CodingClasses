<?php include "utilFunctions.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieFlix - Delete Genre</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="w3-container w3-black">
        <?php include "movieAdminMainMenu.php"; ?>
        <header class="w3-display-container w3-center">
            <h1><b>MovieFlix</b></h1>
            <h2>Delete Genre</h2>
        </header>
        <form method="POST" class="w3-container w3-light-grey">
            <fieldset>
                <legend class="w3-large w3-center w3-text-theme"><b>Genre Deletion</b></legend>
                <label>Select Genre to Delete</label>
                <select name="genre_id" class="w3-select w3-border" required>
                    <option value="" disabled selected>Choose a Genre</option>
                    <?php
                    include "connectDatabase.php";
                    $genres = $conn->query("SELECT genre_id, genre_name FROM genres ORDER BY genre_id ASC");
                    if ($genres->num_rows > 0) {
                        while ($genre = $genres->fetch_assoc()) {
                            echo "<option value='{$genre['genre_id']}'>{$genre['genre_id']} | {$genre['genre_name']}</option>";
                        }
                    } else {
                        echo "<option disabled>No genres available</option>";
                    }
                    $conn->close();
                    ?>
                </select>
            </fieldset>
            <br><input type="submit" name="submit" class="w3-btn w3-black" value="Delete Genre">
        </form>
        <div class="w3-container w3-light-grey">
            <?php
            if (isset($_POST['submit'])) {
                include "connectDatabase.php";
                $genre_id = mysqli_real_escape_string($conn, $_POST['genre_id']);
                $check = $conn->query("SELECT * FROM movies WHERE genre_id = '$genre_id'");
                if ($check->num_rows > 0) {
                    echo "<div class='w3-panel w3-yellow w3-round-large'>
                            <b>Warning:</b> This genre is currently linked to one or more movies.<br>
                            Please reassign or delete those movies first.
                          </div>";
                } else {
                    $delete = "DELETE FROM genres WHERE genre_id = '$genre_id'";
                    if ($conn->query($delete) === TRUE) {
                        echo "<div class='w3-panel w3-green w3-round-large'>
                                <h3>Success!</h3>
                                <p>Genre deleted successfully.</p>
                              </div>";
                    } else {
                        echo "<div class='w3-panel w3-red w3-round-large'>
                                <b>Error deleting genre:</b> " . $conn->error . "
                              </div>";
                    }
                }
                $conn->close();
            }
            ?>
        </div>
    </div>
</body>
</html>