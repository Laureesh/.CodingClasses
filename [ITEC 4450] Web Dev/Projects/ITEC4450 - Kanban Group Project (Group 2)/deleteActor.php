<?php include "utilFunctions.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieFlix - Delete Actor</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="w3-container w3-black">
        <?php include "movieAdminMainMenu.php"; ?>
        <header class="w3-display-container w3-center">
            <h1><b>MovieFlix</b></h1>
            <h2>Delete Actor</h2>
        </header>
        <form method="POST" class="w3-container w3-light-grey">
            <fieldset>
                <legend class="w3-large w3-center w3-text-theme"><b>Actor Deletion</b></legend>
                <label>Select Actor to Delete</label>
                <select name="actor_id" class="w3-select w3-border" required>
                    <option value="" disabled selected>Choose an Actor</option>
                    <?php
                        include "connectDatabase.php";
                        $actors = $conn->query("SELECT actor_id, actor_name FROM actors ORDER BY actor_id ASC");
                        if ($actors->num_rows > 0) {
                            while ($actor = $actors->fetch_assoc()) {
                                echo "<option value='{$actor['actor_id']}'>{$actor['actor_id']} | {$actor['actor_name']}</option>";
                            }
                        } else {
                            echo "<option disabled>No actors available</option>";
                        }
                        $conn->close();
                    ?>
                </select>
            </fieldset>
            <br><input type="submit" name="submit" class="w3-btn w3-black" value="Delete Actor">
        </form>
        <div class="w3-container w3-light-grey">
            <?php
                if (isset($_POST['submit'])) {
                    include "connectDatabase.php";
                    $actor_id = mysqli_real_escape_string($conn, $_POST['actor_id']);
                    $checkMovies = $conn->query("SELECT * FROM movie_actors WHERE actor_id = '$actor_id'");
                    if ($checkMovies->num_rows > 0) {
                        echo "<div class='w3-panel w3-yellow w3-round-large'>
                                <b>Warning:</b> This actor is currently linked to one or more movies.<br>
                                Please remove the movie associations first before deleting.
                              </div>";
                    } else {
                        $deleteActor = "DELETE FROM actors WHERE actor_id = '$actor_id'";
                        if ($conn->query($deleteActor) === TRUE) {
                            echo "<div class='w3-panel w3-green w3-round-large'>
                                    <h3>Success!</h3>
                                    <p>Actor deleted successfully.</p>
                                  </div>";
                        } else {
                            echo "<div class='w3-panel w3-red w3-round-large'>
                                    <b>Error deleting actor:</b> " . $conn->error . "
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
