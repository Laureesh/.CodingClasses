<?php
    include "utilFunctions.php";
    include "connectDatabase.php";
    session_start();

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("Location: login.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieFlix - All Members</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="w3-container w3-black">
    <?php include "memberAdminMainMenu.php"; ?>
    <header class="w3-display-container w3-center">
        <h1><b>MovieFlix</b></h1>
        <h2>All Members</h2>
    </header>
    <div class="w3-container w3-black w3-padding-16">
        <table class="w3-table-all w3-card-4">
            <tr class="w3-theme-d3">
                <th>User ID</th>
                <th>Username</th>
                <th>Password (Encrypted)</th>
                <th>Join Date</th>
            </tr>
            <?php
            $sql = "SELECT user_id, username, password, join_date 
                    FROM users 
                    ORDER BY user_id ASC";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td class='w3-text-black'>{$row['user_id']}</td>";
                    echo "<td class='w3-text-black'>" . htc($row['username']) . "</td>";
                    echo "<td class='w3-text-black'><i>(hashed)</i> " . htc($row['password']) . "</td>";
                    echo "<td class='w3-text-black'>{$row['join_date']}</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr>
                        <td colspan='4' class='w3-center w3-text-black'>
                            No members found.
                        </td>
                      </tr>";
            }
            $conn->close();
            ?>
        </table>
    </div>
</div>
</body>
</html>