<?php
    include "connectDatabase.php";
    include "utilFunctions.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MovieFlix - All Movie Reviews</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body class="w3-light-grey">
<div class="w3-theme-d1">
    <?php include 'mainMenu.php'; ?>
    <div class="w3-container w3-padding-32">
        <h2 class="w3-center">All Movie Reviews</h2>
        <div class="w3-responsive w3-card w3-padding">
        <?php
        $sql = "
            SELECT r.review_id,
                   m.title AS movie_title,
                   u.username AS reviewer,
                   r.rating,
                   r.review_text,
                   r.review_date
            FROM reviews r
            JOIN movies m ON r.movie_id = m.movie_id
            JOIN users u ON r.user_id = u.user_id
            ORDER BY r.review_date DESC
        ";
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
            echo "<table class='w3-table-all w3-hoverable'>";
            echo "<tr class='w3-black'>
                    <th>ID</th>
                    <th>Movie</th>
                    <th>User</th>
                    <th>Rating</th>
                    <th>Review</th>
                    <th>Date</th>
                  </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htc($row['review_id']) . "</td>";
                echo "<td>" . htc($row['movie_title']) . "</td>";
                echo "<td>" . htc($row['reviewer']) . "</td>";
                echo "<td>" . htc($row['rating']) . "</td>";
                echo "<td>" . htc($row['review_text']) . "</td>";
                echo "<td>" . htc($row['review_date']) . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p class='w3-text-grey w3-center'>No reviews found.</p>";
        }
        $conn->close();
        ?>
        </div>
    </div>
</div>
</body>
</html>