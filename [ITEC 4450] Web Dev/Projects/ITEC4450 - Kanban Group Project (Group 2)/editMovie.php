<?php include "utilFunctions.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieFlix - Edit Movie</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
    <div class="w3-container w3-black">
        <?php include "movieAdminMainMenu.php"; ?>
        <header class="w3-display-container w3-center">
            <h1><b>MovieFlix</b></h1>
            <h2>Edit Movie</h2>
        </header>
        <form method="POST" class="w3-container w3-light-grey">
            <fieldset>
                <legend class="w3-large w3-center w3-text-theme"><b>Select Movie to Edit</b></legend>
                <label>Movie</label>
                <select name="movie_id" class="w3-select w3-border" required onchange="this.form.submit()">
                    <option value="" disabled selected>Choose a Movie</option>
                    <?php
                    include "connectDatabase.php";
                    $movies = $conn->query("SELECT movie_id, title, release_year, director FROM movies ORDER BY movie_id ASC");

                    if ($movies->num_rows > 0) {
                        while ($m = $movies->fetch_assoc()) {
                            $selected = (isset($_POST['movie_id']) && $_POST['movie_id'] == $m['movie_id']) ? "selected" : "";

                            // Format: "1 | Weapons (2024) by Alex Garland"
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
        </form>
        <?php
        include "connectDatabase.php";
        if (isset($_POST['movie_id'])) {
            $movie_id = mysqli_real_escape_string($conn, $_POST['movie_id']);
            $result = $conn->query("SELECT * FROM movies WHERE movie_id = '$movie_id'");
            $movie = $result->fetch_assoc();
            ?>
            <form method="POST" class="w3-container w3-light-grey w3-margin-top">
                <fieldset>
                    <legend class="w3-large w3-center w3-text-theme"><b>Edit Movie Details</b></legend>
                    <input type="hidden" name="movie_id" value="<?php echo $movie['movie_id']; ?>">
                    <label>Title</label>
                    <input type="text" name="title" class="w3-input w3-border" value="<?php echo $movie['title']; ?>" required>
                    <label>Genre</label>
                    <select name="genre_id" class="w3-select w3-border" required>
                        <?php
                        $genres = $conn->query("SELECT genre_id, genre_name FROM genres ORDER BY genre_id ASC");
                        while ($g = $genres->fetch_assoc()) {
                            $selected = ($movie['genre_id'] == $g['genre_id']) ? "selected" : "";
                            echo "<option value='{$g['genre_id']}' $selected>{$g['genre_id']} | {$g['genre_name']}</option>";
                        }
                        ?>
                    </select>
                    <label>Release Year</label>
                    <input type="text" name="release_year" class="w3-input w3-border" value="<?php echo $movie['release_year']; ?>" required>
                    <label>Director</label>
                    <input type="text" name="director" class="w3-input w3-border" value="<?php echo $movie['director']; ?>" required>
                    <label>Description</label>
                    <textarea name="description" class="w3-input w3-border" required><?php echo $movie['description']; ?></textarea>
                    <label>YouTube Trailer URL</label>
                    <input type="text" name="trailer_source" class="w3-input w3-border" value="<?php echo $movie['trailer_source']; ?>" required>
                    <label>Movie Poster URL</label>
                    <input type="text" name="movie_image" class="w3-input w3-border" value="<?php echo $movie['movie_image']; ?>" required>
                </fieldset>
                <br><input type="submit" name="update" class="w3-btn w3-black" value="Save Changes">
            </form>
            <?php
        }
        if (isset($_POST['update'])) {
            $id = mysqli_real_escape_string($conn, $_POST['movie_id']);
            $title = mysqli_real_escape_string($conn, $_POST['title']);
            $genre = mysqli_real_escape_string($conn, $_POST['genre_id']);
            $year = mysqli_real_escape_string($conn, $_POST['release_year']);
            $director = mysqli_real_escape_string($conn, $_POST['director']);
            $desc = mysqli_real_escape_string($conn, $_POST['description']);
            $trailer = mysqli_real_escape_string($conn, $_POST['trailer_source']);
            $movie_image = mysqli_real_escape_string($conn, $_POST['movie_image']);
            $update = "
                UPDATE movies 
                SET title='$title', genre_id='$genre', release_year='$year', director='$director', description='$desc', trailer_source='$trailer', movie_image='$movie_image'
                WHERE movie_id='$id'
                ";
            if ($conn->query($update)) {
                echo "<div class='w3-panel w3-green w3-round-large w3-margin-top'>
                        <h3>Success!</h3>
                        <p>Movie updated successfully.</p>
                    </div>";
            } else {
                echo "<div class='w3-panel w3-red w3-round-large w3-margin-top'>
                        <b>Error:</b> " . $conn->error . "
                    </div>";
            }
        }
        $conn->close();
        ?>
    </div>
</body>
</html>