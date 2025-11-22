<?php
    include "connectDatabase.php";
    include "utilFunctions.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>MovieFlix - View Reviews by Movie</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<div class="w3-theme-d1">
    <?php include 'mainMenu.php'; ?>
    <div class="w3-container w3-padding-32">
        <h2 class="w3-center">View Reviews by Movie</h2>
        <form class="w3-container w3-card w3-theme-d3" method="GET" action="viewReview.php" style="max-width:600px; margin:auto;">
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
            <p><button class="w3-button w3-cyan w3-round-large" type="submit">View Reviews</button></p>
        </form>
        <?php
        if (isset($_GET['movie_id'])) {
            $movie_id = intval($_GET['movie_id']);
            $sql = "
                SELECT r.rating, r.review_text, r.review_date, m.title, u.username
                FROM reviews r
                JOIN movies m ON r.movie_id = m.movie_id
                JOIN users u ON r.user_id = u.user_id
                WHERE r.movie_id = ?
                ORDER BY r.review_date DESC
            ";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $movie_id);
            $stmt->execute();
            $result = $stmt->get_result();
            echo "<div class='w3-container w3-padding-16'>";
            if ($result->num_rows > 0) {
                $first = $result->fetch_assoc();
                echo "<h3>Reviews for: <b>" . htc($first['title']) . "</b></h3><hr>";
                echo "<div class='w3-card w3-margin w3-padding w3-theme-d3'>";
                echo "<b>" . htc($first['username']) . "</b> - Rating: " . htc($first['rating']) . "/5<br>";
                echo "<p>" . htc($first['review_text']) . "</p>";
                echo "<small>" . htc($first['review_date']) . "</small>";
                echo "</div>";

                while ($row = $result->fetch_assoc()) {
                    echo "<div class='w3-card w3-margin w3-padding w3-theme-d3'>";
                    echo "<b>" . htc($row['username']) . "</b> - Rating: " . htc($row['rating']) . "/5<br>";
                    echo "<p>" . htc($row['review_text']) . "</p>";
                    echo "<small>" . htc($row['review_date']) . "</small>";
                    echo "</div>";
                }
            } else {
                echo "<p>No reviews yet for this movie.</p>";
            }
            echo "</div>";
        }
        ?>
    </div>
</div>
</body>
</html>