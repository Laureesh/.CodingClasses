<?php include "utilFunctions.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieFlix - Delete Movie</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<div class="w3-container w3-black">
    <?php include "movieAdminMainMenu.php"; ?>
    <header class="w3-display-container w3-center">
        <h1><b>MovieFlix</b></h1>
        <h2>Delete Movie</h2>
    </header>
    <form method="POST" class="w3-container w3-light-grey">
        <fieldset>
            <legend class="w3-large w3-center w3-text-theme"><b>Movie Deletion</b></legend>

            <label>Select Movie to Delete</label>
            <select name="movie_id" class="w3-select w3-border" required>
                <option value="" disabled selected>Choose a Movie</option>
                <?php
                    include "connectDatabase.php";
                    $movies = $conn->query("SELECT movie_id, title, release_year, director FROM movies ORDER BY movie_id ASC");

                    if ($movies->num_rows > 0) {
                        while ($m = $movies->fetch_assoc()) {
                            $selected = (isset($_POST['movie_id']) && $_POST['movie_id'] == $m['movie_id']) ? "selected" : "";
                            $display = "{$m['movie_id']} | {$m['title']} ({$m['release_year']}) by {$m['director']}";
                            echo "<option value='{$m['movie_id']}' $selected>$display</option>";
                        }
                    } else {
                        echo "<option disabled>No movies available</option>";
                    }
                    $conn->close();
                ?>
            </select>
        </fieldset>
        <br><input type="submit" name="submit" class="w3-btn w3-black" value="Delete Movie">
    </form>
    <div class="w3-container w3-light-grey">
        <?php
            if (isset($_POST['submit'])) {
                include "connectDatabase.php";
                $movie_id = mysqli_real_escape_string($conn, $_POST['movie_id']);
                $check = $conn->query("SELECT * FROM movie_actors WHERE movie_id = '$movie_id'");
                if ($check->num_rows > 0) {
                    echo "<div class='w3-panel w3-yellow w3-round-large'>
                            <b>Warning:</b> This movie is currently linked to one or more actors.<br>
                            Please remove actor associations first before deleting.
                          </div>";
                } else {
                    $delete = "DELETE FROM movies WHERE movie_id = '$movie_id'";
                    if ($conn->query($delete) === TRUE) {
                        echo "<div class='w3-panel w3-green w3-round-large'>
                                <h3>Success!</h3>
                                <p>Movie deleted successfully.</p>
                              </div>";
                    } else {
                        echo "<div class='w3-panel w3-red w3-round-large'>
                                <b>Error deleting movie:</b> " . $conn->error . "
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