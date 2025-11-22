<?php include "utilFunctions.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieFlix - Unassign Actor from Movie</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="w3-container w3-black">
        <?php include "movieAdminMainMenu.php"; ?>
        <header class="w3-display-container w3-center">
            <h1><b>MovieFlix</b></h1>
            <h2>Unassign Actor from Movie</h2>
        </header>
        <form method="POST" class="w3-container w3-light-grey">
            <fieldset>
                <legend class="w3-large w3-center w3-text-theme"><b>Unassign Details</b></legend>
                <label>Select Movie</label>
                <select name="movie_id" class="w3-select w3-border" required onchange="this.form.submit()">
                    <option value="" disabled selected>Choose a Movie</option>
                    <?php
                        include "connectDatabase.php";
                        $movies = $conn->query("SELECT movie_id, title FROM movies ORDER BY movie_id ASC");
                        while ($m = $movies->fetch_assoc()) {
                            $selected = (isset($_POST['movie_id']) && $_POST['movie_id'] == $m['movie_id']) ? "selected" : "";
                            echo "<option value='{$m['movie_id']}' $selected>{$m['movie_id']} | {$m['title']}</option>";
                        }
                        $conn->close();
                    ?>
                </select>
                <?php
                if (isset($_POST['movie_id'])) {
                    include "connectDatabase.php";
                    $movie_id = mysqli_real_escape_string($conn, $_POST['movie_id']);
                    $actors = $conn->query("
                        SELECT a.actor_id, a.actor_name
                        FROM movie_actors ma
                        JOIN actors a ON ma.actor_id = a.actor_id
                        WHERE ma.movie_id = '$movie_id'
                        ORDER BY a.actor_id ASC
                    ");
                    echo '<label>Select Actor</label>';
                    echo '<select name="actor_id" class="w3-select w3-border" required>';
                    echo '<option value="" disabled selected>Choose an Actor</option>';
                    while ($a = $actors->fetch_assoc()) {
                        echo "<option value='{$a['actor_id']}'>{$a['actor_id']} | {$a['actor_name']}</option>";
                    }
                    echo '</select>';
                    $conn->close();
                }
                ?>
            </fieldset>
            <br><input type="submit" name="unassign" class="w3-btn w3-black" value="Unassign Actor">
        </form>
        <div class="w3-container w3-grey">
            <?php
            if (isset($_POST['unassign'])) {
                include "connectDatabase.php";
                $movie_id = mysqli_real_escape_string($conn, $_POST['movie_id']);
                $actor_id = mysqli_real_escape_string($conn, $_POST['actor_id']);
                $check = $conn->query("SELECT * FROM movie_actors WHERE movie_id = '$movie_id' AND actor_id = '$actor_id'");
                if ($check->num_rows === 0) {
                    echo "<b>This actor is not currently assigned to that movie.</b>";
                } else {
                    $delete = "DELETE FROM movie_actors WHERE movie_id = '$movie_id' AND actor_id = '$actor_id'";
                    if ($conn->query($delete) === TRUE) {
                        echo "<div class='w3-panel w3-green w3-round-large'>";
                        echo "<b>Actor unassigned successfully!</b><br>";
                        echo "Movie ID: $movie_id<br>";
                        echo "Actor ID: $actor_id<br>";
                        echo "</div>";
                    } else {
                        echo "<div class='w3-panel w3-red w3-round-large'>";
                        echo "<b>Error:</b> " . $conn->error;
                        echo "</div>";
                    }
                }
                $conn->close();
            }
            ?>
        </div>
    </div>
</body>
</html>