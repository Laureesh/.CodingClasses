<?php 
include "utilFunctions.php"; 
include "connectDatabase.php";
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieFlix - Delete Member</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="w3-container w3-black">
    <?php include "memberAdminMainMenu.php"; ?>
    <header class="w3-display-container w3-center">
        <h1><b>MovieFlix</b></h1>
        <h2>Delete Member</h2>
    </header>
    <form method="POST" class="w3-container w3-light-grey">
        <fieldset>
            <legend class="w3-large w3-center w3-text-theme"><b>Select Member to Delete</b></legend>
            <label>Member</label>
            <select name="user_id" class="w3-select w3-border" required>
                <option value="" disabled selected>Choose a Member</option>
                <?php
                $members = $conn->query("
                    SELECT user_id, username, join_date 
                    FROM users 
                    ORDER BY user_id ASC
                ");
                if ($members->num_rows > 0) {
                    while ($m = $members->fetch_assoc()) {
                        $selected = (isset($_POST['user_id']) && $_POST['user_id'] == $m['user_id']) ? "selected" : "";
                        $display = "{$m['user_id']} | {$m['username']} (Joined: {$m['join_date']})";
                        echo "<option value='{$m['user_id']}' $selected>$display</option>";
                    }
                } else {
                    echo "<option disabled>No members available</option>";
                }
                ?>
            </select>
        </fieldset>
        <br><input type="submit" name="submit" class="w3-btn w3-black" value="Delete Member">
    </form>
    <div class="w3-container w3-light-grey">
        <?php
        if (isset($_POST['submit'])) {
            include "connectDatabase.php";
            $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
            $check = $conn->query("SELECT * FROM users WHERE user_id = '$user_id'");
            if ($check->num_rows === 0) {
                echo "<div class='w3-panel w3-yellow w3-round-large'>
                        <b>Warning:</b> This member does not exist.
                      </div>";
            } else {
                $delete = "DELETE FROM users WHERE user_id = '$user_id'";
                if ($conn->query($delete) === TRUE) {
                    echo "<div class='w3-panel w3-green w3-round-large'>
                            <h3>Success!</h3>
                            <p>Member deleted successfully.</p>
                          </div>";
                } else {
                    echo "<div class='w3-panel w3-red w3-round-large'>
                            <b>Error deleting member:</b> " . $conn->error . "
                          </div>";
                }
            }
            $conn->close();
        }
        ?>
    </div>
</div>
</body>
</html>