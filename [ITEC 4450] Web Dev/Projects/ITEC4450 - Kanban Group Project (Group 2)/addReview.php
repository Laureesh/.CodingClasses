<?php
    session_start();
    include "connectDatabase.php";
    include "utilFunctions.php";

    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    $user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieFlix - Add a Review</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

<div class="w3-theme-d1">
    <?php include 'mainMenu.php'; ?>
    <div class="w3-container w3-padding-32">
        <h2 class="w3-center">Add a Review</h2>
        <form class="w3-container w3-card w3-theme-d3" action="addReview.php" method="POST" style="max-width:600px; margin:auto;">
            <label><b>Select Movie</b></label>
            <select class="w3-select" name="movie_id" required>
                <option value="" disabled selected>Select a Movie</option>
                <?php
                $sql = "SELECT movie_id, title FROM movies ORDER BY title";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . htc($row['movie_id']) . "'>" . htc($row['title']) . "</option>";
                }
                ?>
            </select>
            <br><br>
            <label><b>Rating (1–5)</b></label>
            <input class="w3-input w3-border" type="number" name="rating" min="1" max="5" required><br>
            <label><b>Your Review</b></label>
            <textarea class="w3-input w3-border" name="review_text" rows="4" required></textarea><br>
            <p><button class="w3-button w3-cyan w3-round-large" type="submit" name="submit">Submit Review</button></p>
        </form>
    </div>
    <div class="w3-container w3-padding">
        <?php
        if (isset($_POST['submit'])) {
            $movie_id     = intval($_POST['movie_id']);
            $rating       = intval($_POST['rating']);
            $review_text  = trim($_POST['review_text']);
            $sql = "
                INSERT INTO reviews (movie_id, user_id, rating, review_text, review_date)
                VALUES (?, ?, ?, ?, NOW())
            ";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iiis", $movie_id, $user_id, $rating, $review_text);
            if ($stmt->execute()) {
                echo "<div class='w3-panel w3-green w3-padding'>Review added successfully!</div>";
            } else {
                echo "<div class='w3-panel w3-red w3-padding'>Error: " . htc($conn->error) . "</div>";
            }
        }
        ?>
    </div>
</div>
</body>
</html>