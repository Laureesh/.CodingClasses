<?php
    include "utilFunctions.php";
    session_start();

    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        header("location: login.php");
        exit;
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>MovieFlix - My Watchlist</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        .movie-poster {
            width: 100%;
            height: 400px;
            object-fit: contain;
            background-color: #000;
        }
        .movie-card {
            height: auto;
            display: flex;
            flex-direction: column;
        }
        .movie-card .w3-container {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        .movie-card .w3-container .w3-row {
            margin-top: auto;
        }
        .actor-list {
            font-size: 12px;
            color: #ccc;
            margin-top: 5px;
        }
        .movie-description {
            font-size: 14px;
            line-height: 1.4;
            margin: 10px 0;
            color: #e0e0e0;
        }
    </style>
</head>
<body>
    <div class="w3-theme-d1">
        <?php include 'mainMenu.php'; ?>
        <div class="w3-container w3-padding-32">
            <h1>My Watchlist</h1>
            <?php
            $user_id = $_SESSION["user_id"];
            include "connectDatabase.php";
            $sql = "SELECT m.movie_id, m.title, m.release_year, g.genre_name, m.description, m.movie_image, w.date_added, 
                           GROUP_CONCAT(DISTINCT a.actor_name SEPARATOR ', ') as actors
                    FROM watchlists w 
                    JOIN movies m ON w.movie_id = m.movie_id 
                    JOIN genres g ON m.genre_id = g.genre_id 
                    LEFT JOIN movie_actors ma ON m.movie_id = ma.movie_id 
                    LEFT JOIN actors a ON ma.actor_id = a.actor_id 
                    WHERE w.user_id = '$user_id' 
                    GROUP BY m.movie_id
                    ORDER BY w.date_added DESC";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                echo "<div class='w3-row-padding'>";
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='w3-col m3 w3-margin-bottom'>";
                    echo "  <div class='w3-card-4 w3-theme-d3 movie-card'>";
                    echo "    <img src='" . $row['movie_image'] . "' class='movie-poster' alt='" . $row['title'] . "'>";
                    echo "    <div class='w3-container'>";
                    echo "      <h4>" . $row['title'] . " (" . $row['release_year'] . ")</h4>";
                    echo "      <p><strong>Genre:</strong> " . $row['genre_name'] . "</p>";
                    echo "      <p class='actor-list'><strong>Starring:</strong> " . (isset($row['actors']) ? $row['actors'] : 'No actors listed') . "</p>";
                    echo "      <p class='movie-description'>" . (isset($row['description']) ? $row['description'] : "No description available") . "</p>";
                    echo "      <p class='w3-tiny'>Added: " . $row['date_added'] . "</p>";
                    echo "      <div class='w3-row'>";
                    echo "        <div class='w3-half'>";
                    echo "          <button class='w3-button w3-cyan w3-block' onclick='playMovie(" . $row['movie_id'] . ")'>Play</button>";
                    echo "        </div>";
                    echo "        <div class='w3-half'>";
                    echo "          <button class='w3-button w3-red w3-block' onclick='removeFromWatchlist(" . $row['movie_id'] . ")'>Remove</button>";
                    echo "        </div>";
                    echo "      </div>";
                    echo "    </div>";
                    echo "  </div>";
                    echo "</div>";
                }
                echo "</div>";
            } else {
                echo "<div class='w3-panel w3-theme-d3'>";
                echo "<p>Your watchlist is empty. Start adding movies to watch later!</p>";
                echo "<a href='browseMovies.php' class='w3-button w3-cyan'>Browse Movies</a>";
                echo "</div>";
            }
            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>