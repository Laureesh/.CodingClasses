<?php
    session_start();
    include "connectDatabase.php";
    include "utilFunctions.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>MovieFlix - Edit Review</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<div class="w3-theme-d1">
    <?php include 'mainMenu.php'; ?>
    <div class="w3-container w3-padding-32">
        <h2 class="w3-center">Edit Review</h2>
        <form class="w3-container w3-card w3-theme-d3" action="editReview.php" method="POST" style="max-width:600px; margin:auto;">
            <label><b>Select Review</b></label>
            <select class="w3-select" name="review_id" required>
                <option value="" disabled selected>Select a Review</option>
                <?php
                    $sql = "
                        SELECT r.review_id, r.review_text, m.title
                        FROM reviews r
                        JOIN movies m ON r.movie_id = m.movie_id
                        ORDER BY r.review_date DESC
                    ";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        $preview = substr($row['review_text'], 0, 30);
                        echo "<option value='" . htc($row['review_id']) . "'>
                                #" . htc($row['review_id']) . " | " . htc($row['title']) . " - " . htc($preview) . "...
                            </option>";
                    }
                ?>
            </select><br><br>
            <label><b>New Rating (1–5)</b></label>
            <input class="w3-input w3-border" type="number" min="1" max="5" name="rating" required><br>
            <label><b>New Review</b></label>
            <textarea class="w3-input w3-border" name="review_text" rows="4" required></textarea><br>
            <p><button class="w3-button w3-cyan w3-round-large" type="submit" name="submit">Update Review</button></p>
        </form>
        <div class="w3-container w3-padding">
        <?php
            if (isset($_POST['submit'])) {

                $review_id    = intval($_POST['review_id']);
                $rating       = intval($_POST['rating']);
                $review_text  = trim($_POST['review_text']);

                // Secure update query
                $sql = "
                    UPDATE reviews 
                    SET rating = ?, review_text = ?
                    WHERE review_id = ?
                ";

                $stmt = $conn->prepare($sql);
                $stmt->bind_param("isi", $rating, $review_text, $review_id);

                if ($stmt->execute()) {
                    echo "<div class='w3-panel w3-green w3-padding'>Review updated successfully!</div>";
                } else {
                    echo "<div class='w3-panel w3-red w3-padding'>Error: " . htc($conn->error) . "</div>";
                }
            }
        ?>
        </div>
    </div>
</div>
</body>
</html>