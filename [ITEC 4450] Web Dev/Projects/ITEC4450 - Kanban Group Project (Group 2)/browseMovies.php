<?php include "connectDatabase.php"; ?>
<?php include "utilFunctions.php"; ?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MovieFlix - All Movies</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body class="w3-light-grey">
<?php include "mainMenu.php"; ?>
<div class="w3-container w3-center">
    <h2>All Movies</h2>
    <table class="w3-table-all w3-hoverable">
        <tr class="w3-black">
            <th>Title</th>
            <th>Genre</th>
            <th>Release Year</th>
            <th>Director</th>
            <th>Actors</th>
            <th>Options</th>
        </tr>
        <?php
        $query = "
            SELECT 
                m.movie_id,
                m.title,
                m.release_year,
                m.director,
                g.genre_name,
                GROUP_CONCAT(DISTINCT a.actor_name SEPARATOR ', ') AS actors
            FROM movies m
            JOIN genres g ON m.genre_id = g.genre_id
            LEFT JOIN movie_actors ma ON m.movie_id = ma.movie_id
            LEFT JOIN actors a ON ma.actor_id = a.actor_id
            GROUP BY m.movie_id
            ORDER BY m.release_year DESC
        ";
        $result = $conn->query($query);
        while ($row = $result->fetch_assoc()) {
            $actorList = $row['actors'] ?: "No actors listed";
            echo "
            <tr>
                <td>{$row['title']}</td>
                <td>{$row['genre_name']}</td>
                <td>{$row['release_year']}</td>
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
        ?>
    </table>
</div>
</body>
</html>