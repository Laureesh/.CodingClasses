<?php 
    include "connectDatabase.php"; 
    include "utilFunctions.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MovieFlix - Search Movies</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body class="w3-light-grey">
<?php include "mainMenu.php"; ?>
<div class="w3-container w3-center">
    <h2>Search Movies</h2>
    <form method="GET">
        <input type="text" name="query" 
               class="w3-input w3-border w3-margin"
               placeholder="Search by title, genre, or director">
        <button class="w3-button w3-black">Search</button>
    </form><br>
    <?php
    if (!empty($_GET['query'])) {
        $search = $conn->real_escape_string($_GET['query']);
        $sql = "
            SELECT 
                m.movie_id,
                m.title,
                g.genre_name,
                m.director,
                m.release_year,
                GROUP_CONCAT(DISTINCT a.actor_name SEPARATOR ', ') AS actors
            FROM movies m
            JOIN genres g ON m.genre_id = g.genre_id
            LEFT JOIN movie_actors ma ON m.movie_id = ma.movie_id
            LEFT JOIN actors a ON ma.actor_id = a.actor_id
            WHERE m.title LIKE '%$search%'
               OR g.genre_name LIKE '%$search%'
               OR m.director LIKE '%$search%'
            GROUP BY m.movie_id
        ";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "
            <table class='w3-table-all w3-hoverable'>
                <tr class='w3-black'>
                    <th>Title</th>
                    <th>Genre</th>
                    <th>Release Year</th>
                    <th>Duration</th>
                    <th>Director</th>
                    <th>Actors</th>
                    <th>Options</th>
                </tr>";
            while ($row = $result->fetch_assoc()) {
                $actorList = $row['actors'] ?: "No actors listed";
                echo "
                <tr>
                    <td>{$row['title']}</td>
                    <td>{$row['genre_name']}</td>
                    <td>{$row['release_year']}</td>
                    <td>{$duration}</td>
                    <td>{$row['director']}</td>
                    <td>{$actorList}</td>
                    <td>
                        <a class='w3-button w3-cyan w3-small'
                           onclick='playMovie({$row['movie_id']})'>
                           Play
                        </a>
                        <button class='w3-button w3-green w3-small'
                                onclick='addToWatchlist({$row['movie_id']})'>
                                + Watchlist
                        </button>
                    </td>
                </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No movies found.</p>";
        }
    }
    ?>
</div>
</body>
</html>