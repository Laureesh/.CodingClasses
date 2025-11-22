<?php
    session_start();
    require "connectDatabase.php";
    require "utilFunctions.php";
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("Location: login.php");
        exit;
    }

    $user_id = $_SESSION['user_id'];
    if (!isset($_GET['id'])) {
        die("No movie selected.");
    }

    $movie_id = intval($_GET['id']);
    $sql = "SELECT * FROM movies WHERE movie_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $movie_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        die("Movie not found.");
    }

    $movie = $result->fetch_assoc();
    $youtubeID = extractYouTubeID($movie['trailer_source']);

    // --- SAVE PLAY HISTORY IMMEDIATELY ---
    $sql = "
        INSERT INTO play_history (user_id, movie_id, last_watched)
        VALUES (?, ?, CURDATE())
        ON DUPLICATE KEY UPDATE last_watched = CURDATE()
    ";
    $save = $conn->prepare($sql);
    $save->bind_param("ii", $user_id, $movie_id);
    $save->execute();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MovieFlix - <?php echo htc($movie['title']) . " (" . $movie['release_year'] . ")"; ?></title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        body {
            background-color: #111;
            color: #fff;
            font-family: Arial, sans-serif;
        }
        #playerContainer {
            max-width: 900px;
            margin: auto;
            margin-top: 40px;
        }
        .resume-box {
            margin: 20px auto;
            max-width: 900px;
            background: #222;
            padding: 15px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <?php include "mainMenu.php"; ?>
    <div class="w3-container w3-center">
        <h2><?php echo htc($movie['title']) . " (" . $movie['release_year'] . ")"; ?></h2>
    </div>
    <div id="playerContainer">
        <div id="player"></div>
    </div>
    <script>
        // Load YouTube API
        let tag = document.createElement('script');
        tag.src = "https://www.youtube.com/iframe_api";
        document.head.appendChild(tag);

        function onYouTubeIframeAPIReady() {
            new YT.Player('player', {
                height: '500',
                width: '900',
                videoId: '<?php echo $youtubeID; ?>',
                playerVars: { controls: 1, autoplay: 0 },
            });
        }
    </script>
</body>
</html>