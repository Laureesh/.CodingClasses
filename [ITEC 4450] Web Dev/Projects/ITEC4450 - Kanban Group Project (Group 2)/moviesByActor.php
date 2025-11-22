<?php 
    include "connectDatabase.php"; 
    include "utilFunctions.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MovieFlix - Movies by Actor</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body class="w3-light-grey">
<?php include "mainMenu.php"; ?>
<div class="w3-container w3-center">
    <h2>Movies by Actor</h2>
    <form method="POST">
        <select name="actor_id" class="w3-select w3-border w3-margin" required>
            <option value="" disabled selected>Select an Actor</option>
            <?php
            $actors = $conn->query("
                SELECT actor_id, actor_name
                FROM actors
                ORDER BY actor_name
            ");
            while ($a = $actors->fetch_assoc()) {
                echo "<option value='{$a['actor_id']}'>{$a['actor_name']}</option>";
            }
            ?>
        </select>
        <button class="w3-button w3-black">Show Movies</button>
    </form>
    <br>
    <?php
    if (isset($_POST['actor_id'])) {
        $actor_id = intval($_POST['actor_id']);
        $actorQuery = $conn->prepare("
            SELECT actor_name 
            FROM actors 
            WHERE actor_id = ?
        ");
        $actorQuery->bind_param("i", $actor_id);
        $actorQuery->execute();
        $actorName = $actorQuery->get_result()->fetch_assoc()['actor_name'] ?? "Unknown Actor";

        echo "<h3 class='w3-margin-top'>Showing movies starring <b>$actorName</b>:</h3>";

        $query = "
            SELECT 
                m.movie_id,
                m.title,
                m.director,
                m.release_year,
                g.genre_name,
                GROUP_CONCAT(DISTINCT a.actor_name SEPARATOR ', ') AS actors
            FROM movie_actors ma
            JOIN movies m ON ma.movie_id = m.movie_id
            JOIN genres g ON m.genre_id = g.genre_id
            LEFT JOIN movie_actors ma2 ON m.movie_id = ma2.movie_id
            LEFT JOIN actors a ON ma2.actor_id = a.actor_id
            WHERE ma.actor_id = $actor_id
            GROUP BY m.movie_id
            ORDER BY m.release_year DESC
        ";

        $movies = $conn->query($query);
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
            echo "<p>No movies found for <b>$actorName</b>.</p>";
        }
    }
    ?>
</div>
</body>
</html>