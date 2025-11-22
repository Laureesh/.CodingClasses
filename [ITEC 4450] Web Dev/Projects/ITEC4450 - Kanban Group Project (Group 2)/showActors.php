<?php
    include "utilFunctions.php";
    include "connectDatabase.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieFlix - All Actors</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="w3-container w3-black">
        <?php include "movieAdminMainMenu.php"; ?>
        <header class="w3-display-container w3-center">
            <h1><b>MovieFlix</b></h1>
            <h2>All Actors</h2>
        </header>
        <div class="w3-container w3-black">
            <table class="w3-table-all w3-card-4">
                <tr class="w3-black">
                    <th>Actor ID</th>
                    <th>Actor Name</th>
                    <th>Bio</th>
                    <th>Birth Year</th>
                    <th>Movies</th>
                    <th>Photo</th>
                </tr>
                <?php
                $result = $conn->query("
                                        SELECT 
                                            a.actor_id,
                                            a.actor_name,
                                            a.bio,
                                            a.birth_year,
                                            a.photo_url,
                                            GROUP_CONCAT(m.title SEPARATOR ', ') AS movies
                                        FROM actors a
                                        LEFT JOIN movie_actors ma ON a.actor_id = ma.actor_id
                                        LEFT JOIN movies m ON ma.movie_id = m.movie_id
                                        GROUP BY a.actor_id
                                        ORDER BY a.actor_id ASC;
                                    ");
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td class='w3-text-black'>{$row['actor_id']}</td>";
                        echo "<td class='w3-text-black'>{$row['actor_name']}</td>";
                        echo "<td class='w3-text-black'>{$row['bio']}</td>";
                        echo "<td class='w3-text-black'>{$row['birth_year']}</td>";
                        
                        $movies = !empty($row['movies']) ? $row['movies'] : "<i>No movies linked</i>";
                        echo "<td class='w3-text-black'>{$movies}</td>";

                        $photo = !empty($row['photo_url'])
                            ? "<img src='{$row['photo_url']}' style='width:100px;height:auto;border-radius:5px;'>"
                            : "<i>No photo</i>";
                        echo "<td>{$photo}</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='w3-text-black w3-center'>No actors found.</td></tr>";
                }
                $conn->close();
                ?>
            </table>
        </div>
    </div>
</body>
</html>