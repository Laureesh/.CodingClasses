<?php
    include "utilFunctions.php";
    include "connectDatabase.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieFlix - All Movies</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<div class="w3-container w3-black">
    <?php include "movieAdminMainMenu.php"; ?>
    <header class="w3-display-container w3-center">
        <h1><b>MovieFlix</b></h1>
        <h2>All Movies</h2>
    </header>
    <div class="w3-container w3-black">
        <table class="w3-table-all w3-card-4">
            <tr class="w3-black">
                <th>Movie ID</th>
                <th>Title</th>
                <th>Genre</th>
                <th>Release Year</th>
                <th>Director</th>
                <th>Actors</th>
                <th>Trailer</th>
                <th>Poster</th>
            </tr>
            <?php
                $sql = "SELECT 
                            m.movie_id, 
                            m.title, 
                            g.genre_name, 
                            m.release_year, 
                            m.director, 
                            m.trailer_source,
                            m.movie_image,
                            GROUP_CONCAT(a.actor_name SEPARATOR ', ') AS actors
                        FROM movies m
                        LEFT JOIN genres g ON m.genre_id = g.genre_id
                        LEFT JOIN movie_actors ma ON m.movie_id = ma.movie_id
                        LEFT JOIN actors a ON ma.actor_id = a.actor_id
                        GROUP BY m.movie_id
                        ORDER BY m.movie_id ASC";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td class='w3-text-black'>{$row['movie_id']}</td>";
                        echo "<td class='w3-text-black'>{$row['title']}</td>";
                        echo "<td class='w3-text-black'>{$row['genre_name']}</td>";
                        echo "<td class='w3-text-black'>{$row['release_year']}</td>";
                        echo "<td class='w3-text-black'>{$row['director']}</td>";

                        $actors = !empty($row['actors']) ? $row['actors'] : "<i>No actors linked</i>";
                        echo "<td class='w3-text-black'>{$actors}</td>";
                        echo "<td class='w3-text-blue'><a href='{$row['trailer_source']}' target='_blank'>Watch Trailer</a></td>";
                        echo "<td class='w3-text-black'><img src='{$row['movie_image']}' alt='Poster' style='height:100px;'></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' class='w3-text-black w3-center'>No movies found.</td></tr>";
                }
                $conn->close();
            ?>
        </table>
    </div>
</div>
</body>
</html>