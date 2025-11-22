<?php
    include "utilFunctions.php";
    include "connectDatabase.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieFlix - Show Genres</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<div class="w3-container w3-black">
    <?php include "movieAdminMainMenu.php"; ?>
    <header class="w3-display-container w3-center">
        <h1><b>MovieFlix</b></h1>
        <h2>Show Genres</h2>
    </header>
    <div class="w3-container w3-black">
        <table class="w3-table-all w3-card-4">
            <tr class="w3-black">
                <th>Genre ID</th>
                <th>Genre Name</th>
            </tr>
            <?php
                $result = $conn->query("SELECT * FROM genres ORDER BY genre_name ASC");
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td class='w3-text-black'>{$row['genre_id']}</td>
                                <td class='w3-text-black'>{$row['genre_name']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='2' class='w3-text-black w3-center'>No genres found.</td></tr>";
                }
                $conn->close();
            ?>
        </table>
    </div>
</div>
</body>
</html>