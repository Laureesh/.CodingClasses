<?php
    session_start();
    require "utilFunctions.php";

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("Location: login.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MovieFlix - Add New Member</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<div class="w3-container w3-black">
    <?php include "memberAdminMainMenu.php"; ?>
    <header class="w3-display-container w3-center">
        <h1><b>MovieFlix</b></h1>
        <h2>Add New Member</h2>
    </header>
    <form method="POST" class="w3-container w3-light-grey">
        <fieldset>
            <legend class="w3-large w3-center w3-text-theme"><b>Member Details</b></legend>
            <label>Username</label>
            <input type="text" name="username" class="w3-input w3-border" required>
            <label>Password</label>
            <input type="text" name="password" class="w3-input w3-border" required>
        </fieldset><br>
        <input type="submit" name="submit" class="w3-button w3-black" value="Add Member">
    </form>
    <div class="w3-container w3-light-grey">
        <?php
        if (isset($_POST['submit'])) {
            if (!isset($_POST['username']) || !isset($_POST['password'])) {
                echo "<div class='w3-panel w3-red'><b>Error:</b> Missing fields.</div>";
                exit;
            }

            include "connectDatabase.php";
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $password_raw = $_POST['password'];
            $check = $conn->query("SELECT user_id FROM users WHERE username = '$username'");

            if ($check->num_rows > 0) {
                echo "<div class='w3-panel w3-red'><b>Error:</b> Username already exists.</div>";
            } else {
                $hashed_password = password_hash($password_raw, PASSWORD_DEFAULT);
                $join_date = date("Y-m-d");
                $sql = "INSERT INTO users (username, password, join_date) VALUES ('$username', '$hashed_password', '$join_date')";
                if ($conn->query($sql) === TRUE) {
                    echo "
                    <div class='w3-panel w3-green'>
                        <b>New user added successfully!</b><br>
                        Username: $username<br>
                        Join Date: $join_date
                    </div>";
                } else {
                    echo "<div class='w3-panel w3-red'><b>Error:</b> " . $conn->error . "</div>";
                }
            }
            $conn->close();
        }
        ?>
    </div>
</div>
</body>
</html>