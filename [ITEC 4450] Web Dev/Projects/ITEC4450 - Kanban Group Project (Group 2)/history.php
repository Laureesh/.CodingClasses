<?php
    session_start();
    include "connectDatabase.php";
    include "utilFunctions.php";
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        header("location: login.php");
        exit;
    }

    $user_id = $_SESSION["user_id"];
?>
<!DOCTYPE html>
<html>
<head>
    <title>MovieFlix - Viewing History</title>
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
    </style>
</head>
<body>
<div class="w3-theme-d1">
    <?php include "mainMenu.php"; ?>
    <div class="w3-container w3-padding-32">
        <h1>Viewing History</h1>
        <?php
        // Pull all history items
        $sql = "
            SELECT 
                m.movie_id,
                m.title,
                m.release_year,
                m.movie_image,
                g.genre_name,
                ph.last_watched,
                GROUP_CONCAT(DISTINCT a.actor_name SEPARATOR ', ') AS actors
            FROM play_history ph
            JOIN movies m ON ph.movie_id = m.movie_id
            JOIN genres g ON m.genre_id = g.genre_id
            LEFT JOIN movie_actors ma ON m.movie_id = ma.movie_id
            LEFT JOIN actors a ON ma.actor_id = a.actor_id
            WHERE ph.user_id = ?
            GROUP BY m.movie_id
            ORDER BY ph.last_watched DESC
        ";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            echo "<div class='w3-panel w3-theme-d3'>
                    <p>You haven’t watched anything yet.</p>
                    <a href='browseMovies.php' class='w3-button w3-cyan'>Browse Movies</a>
                  </div>";
        } else {
            echo "<div class='w3-row-padding'>";
            while ($row = $result->fetch_assoc()) {
                $actors = $row["actors"] ? $row["actors"] : "No listed actors";
                echo "
                <div class='w3-col m3 w3-margin-bottom'>
                    <div class='w3-card-4 w3-theme-d3 movie-card'>
                        <img src='{$row['movie_image']}' class='movie-poster'>
                        <div class='w3-container'>
                            <h4>{$row['title']} ({$row['release_year']})</h4>
                            <p><strong>Genre:</strong> {$row['genre_name']}</p>
                            <p class='actor-list'><strong>Starring:</strong> $actors</p>
                            <p class='w3-tiny'>Last Watched: {$row['last_watched']}</p>
                            <div class='w3-row'>
                                <div class='w3-half'>
                                    <button class='w3-button w3-cyan w3-block'
                                            onclick='playMovie({$row['movie_id']})'>
                                            Play
                                    </button>
                                </div>
                                <div class='w3-half'>
                                    <form method='POST' action='removeHistory.php'>
                                        <input type='hidden' name='movie_id' value='{$row['movie_id']}'>
                                        <button class='w3-button w3-red w3-block'>Remove</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>";
            }
            echo "</div>";
        }
        ?>
    </div>
</div>
</body>
</html>
