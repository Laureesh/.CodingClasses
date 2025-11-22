<?php
    session_start();
    include "utilFunctions.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>MovieFlix - Movie Streaming</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('cinema-bg.jpg');
            background-size: cover;
            background-position: center;
            height: 60vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        }

        .search-box {
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 10px;
            backdrop-filter: blur(10px);
        }

        .movie-poster {
            width: 100%;
            height: 400px;
            object-fit: contain;
            background-color: #000;
        }

        .movie-card {
            height: 600px;
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
        <?php include 'mainMenu.php'; ?>
        <div class="hero-section">
            <div class="search-box">
                <?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true): ?>
                    <h1>Welcome back, <?php echo htmlspecialchars($_SESSION["username"]); ?>!</h1>
                <?php else: ?>
                    <h1>Welcome to MovieFlix</h1>
                <?php endif; ?>
                <p>Stream thousands of movies and TV shows</p>
                <input type="text" class="w3-input w3-border w3-round-large"
                    placeholder="Search movies, actors, genres..." style="width: 400px; display: inline-block;">
                <button class="w3-button w3-cyan w3-round-large">Search</button>
            </div>
        </div>

        <div class="w3-container w3-padding-32">
            <h2>Featured Movies</h2>
            <?php
                include "connectDatabase.php";
                // Pull 12 featured movies (random or newest)
                $sql = "
                SELECT m.movie_id, m.title, m.release_year, m.movie_image, g.genre_name,
                    GROUP_CONCAT(a.actor_name SEPARATOR ', ') AS actors
                FROM movies m
                JOIN genres g ON m.genre_id = g.genre_id
                LEFT JOIN movie_actors ma ON m.movie_id = ma.movie_id
                LEFT JOIN actors a ON ma.actor_id = a.actor_id
                GROUP BY m.movie_id
                ORDER BY m.release_year DESC
                LIMIT 12
                ";
                $featured = $conn->query($sql);
            ?>
            <div class="w3-row-padding">
                <?php while ($row = $featured->fetch_assoc()): ?>
                    <div class="w3-col m3 w3-margin-bottom">
                        <div class="w3-card-4 w3-theme-d3 movie-card">
                            <img src="<?php echo $row['movie_image']; ?>" class="movie-poster" alt="<?php echo htmlspecialchars($row['title']); ?>">
                            <div class="w3-container">
                                <h4><?php echo $row['title']." (".$row['release_year'].")"; ?></h4>
                                <p><strong>Genre:</strong> <?php echo $row['genre_name']; ?></p>
                                <p class="actor-list"><strong>Starring: </strong><?php echo $row['actors'] ?: "No actors listed"; ?></p>
                                <div class="w3-row">
                                    <div class="w3-half">
                                        <button class="w3-button w3-cyan w3-block" onclick="playMovie(<?php echo $row['movie_id']; ?>)">Play</button>
                                    </div>
                                    <div class="w3-half">
                                        <button class="w3-button w3-green w3-block" onclick="addToWatchlist(<?php echo $row['movie_id']; ?>)">+ Watchlist</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</body>
</html>