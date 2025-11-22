<?php include "utilFunctions.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieFlix - Assign Actor to Movie</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="w3-container w3-black">
        <?php include "movieAdminMainMenu.php"; ?>
        <header class="w3-display-container w3-center">
            <h1><b>MovieFlix</b></h1>
            <h2>Assign Actor to Movie</h2>
        </header>
        <form method="POST" class="w3-container w3-light-grey">
            <fieldset>
                <legend class="w3-large w3-center w3-text-theme"><b>Assign Details</b></legend>
                <label>Select Movie</label>
                <select name="movie_id" class="w3-select w3-border" required>
                    <option value="" disabled selected>Choose a Movie</option>
                    <?php
                        include "connectDatabase.php";
                        $movies = $conn->query("SELECT movie_id, title FROM movies ORDER BY movie_id ASC");
                        while ($m = $movies->fetch_assoc()) {
                            echo "<option value='{$m['movie_id']}'>{$m['movie_id']} | {$m['title']}</option>";
                        }
                        $conn->close();
                    ?>
                </select>
                <label>Select Actor</label>
                <select name="actor_id" class="w3-select w3-border" required>
                    <option value="" disabled selected>Choose an Actor</option>
                    <?php
                        include "connectDatabase.php";
                        $actors = $conn->query("SELECT actor_id, actor_name FROM actors ORDER BY actor_id ASC");

                        while ($actor = $actors->fetch_assoc()) {
                            echo "<option value='{$actor['actor_id']}'>{$actor['actor_id']} | {$actor['actor_name']}</option>";
                        }
                        $conn->close();
                    ?>
                </select>
            </fieldset>
            <br><input type="submit" name="submit" class="w3-btn w3-black" value="Assign Actor">
        </form>

        <div class="w3-container w3-grey">
            <?php
            if (isset($_POST['submit'])) {
                include "connectDatabase.php";

                $movie_id = mysqli_real_escape_string($conn, $_POST['movie_id']);
                $actor_id = mysqli_real_escape_string($conn, $_POST['actor_id']);

                $check = $conn->query("SELECT * FROM movie_actors WHERE movie_id = '$movie_id' AND actor_id = '$actor_id'");

                if ($check->num_rows > 0) {
                    echo "This actor is already assigned to that movie.";
                } else {
                    $sql = "INSERT INTO movie_actors (movie_id, actor_id) VALUES ('$movie_id', '$actor_id')";
                    if ($conn->query($sql) === TRUE) {
                        echo "<b>Actor assigned successfully!</b><br>";
                        echo "Movie ID: $movie_id<br>";
                        echo "Actor ID: $actor_id<br>";
                    } else {
                        echo "Error: " . $conn->error;
                    }
                }
                $conn->close();
            }
            ?>
        </div>
    </div>
</body>

</html>