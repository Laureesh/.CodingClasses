<?php 
include "connectDatabase.php"; 
include "utilFunctions.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>MovieFlix - Movies by Genre</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>

<body class="w3-light-grey">

<?php include "mainMenu.php"; ?>

<div class="w3-container w3-center">
    <h2>Movies by Genre</h2>
    <form method="POST">
        <select name="genre_id" class="w3-select w3-border w3-margin" required>
            <option value="" disabled selected>Select a Genre</option>
            <?php
                $genres = $conn->query("
                    SELECT genre_id, genre_name
                    FROM genres
                    ORDER BY genre_name
                ");
                while ($g = $genres->fetch_assoc()) {
                    echo "<option value='{$g['genre_id']}'>
                            {$g['genre_id']} | {$g['genre_name']}
                        </option>";
                }
            ?>
        </select>
        <button class="w3-button w3-black">Show Movies</button>
    </form>
    <br>
    <?php
    if (isset($_POST['genre_id'])) {
        $id = intval($_POST['genre_id']);
        $genreQuery = $conn->prepare("
            SELECT genre_name 
            FROM genres 
            WHERE genre_id = ?
        ");
        $genreQuery->bind_param("i", $id);
        $genreQuery->execute();
        $genreName = $genreQuery->get_result()->fetch_assoc()['genre_name'] ?? "Unknown Genre";

        echo "<h3 class='w3-margin-top'>Showing all <b>$genreName</b> movies:</h3>";

        $sql = "
            SELECT 
                m.movie_id,
                m.title,
                m.director,
                m.release_year,
                g.genre_name,
                GROUP_CONCAT(DISTINCT a.actor_name SEPARATOR ', ') AS actors
            FROM movies m
            JOIN genres g ON m.genre_id = g.genre_id
            LEFT JOIN movie_actors ma ON m.movie_id = ma.movie_id
            LEFT JOIN actors a ON ma.actor_id = a.actor_id
            WHERE m.genre_id = $id
            GROUP BY m.movie_id
            ORDER BY m.release_year DESC
        ";

        $movies = $conn->query($sql);
        if ($movies->num_rows > 0) {
            echo "
            <table class='w3-table-all w3-hoverable w3-margin-top'>
                <tr class='w3-black'>
                    <th>Title</th>
                    <th>Genre</th>
                    <th>Release Year</th>
                    <th>Director</th>
                    <th>Actors</th>
                    <th>Options</th>
                </tr>
            ";
            while ($m = $movies->fetch_assoc()) {
                $actorList = $m['actors'] ?: "No actors listed";
                echo "
                <tr>
                    <td>{$m['title']}</td>
                    <td>{$m['genre_name']}</td>
                    <td>{$m['release_year']}</td>
                    <td>{$m['director']}</td>
                    <td>{$actorList}</td>
                    <td>
                        <a class='w3-button w3-cyan w3-small'
                           onclick='playMovie({$m['movie_id']})'>
                           Play
                        </a>
                        <button class='w3-button w3-green w3-small'
                                onclick='addToWatchlist({$m['movie_id']})'>
                                + Watchlist
                        </button>
                    </td>
                </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No movies found for the <b>$genreName</b> genre.</p>";
        }
    }
    ?>
</div>
</body>
</html>