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
    <title>MovieFlix - Edit Member</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="w3-container w3-black">
    <?php include "memberAdminMainMenu.php"; ?>
    <header class="w3-display-container w3-center">
        <h1><b>MovieFlix</b></h1>
        <h2>Edit Member</h2>
    </header>
    <form method="POST" class="w3-container w3-light-grey">
        <fieldset>
            <legend class="w3-large w3-center w3-text-theme"><b>Select Member to Edit</b></legend>
            <label>Member</label>
            <select name="user_id" class="w3-select w3-border" required onchange="this.form.submit()">
                <option value="" disabled selected>Choose a Member</option>
                <?php
                $members = $conn->query("SELECT user_id, username FROM users ORDER BY user_id ASC");
                while ($m = $members->fetch_assoc()) {
                    $selected = (isset($_POST['user_id']) && $_POST['user_id'] == $m['user_id']) ? "selected" : "";
                    echo "<option value='{$m['user_id']}' $selected>{$m['user_id']} | {$m['username']}</option>";
                }
                ?>
            </select>
        </fieldset>
    </form>
    <?php
    if (isset($_POST['user_id'])) {
        $uid = mysqli_real_escape_string($conn, $_POST['user_id']);
        $result = $conn->query("SELECT * FROM users WHERE user_id = '$uid'");
        $member = $result->fetch_assoc();
    ?>
        <form method="POST" class="w3-container w3-light-grey w3-margin-top">
            <fieldset>
                <legend class="w3-large w3-center w3-text-theme"><b>Edit Member Details</b></legend>
                <input type="hidden" name="user_id" value="<?php echo $member['user_id']; ?>">
                <label>Username</label>
                <input type="text" name="username" class="w3-input w3-border" value="<?php echo htc($member['username']); ?>" required>
                <label>New Password (leave blank to keep current)</label>
                <input type="text" name="password" class="w3-input w3-border">
            </fieldset>
            <br>
            <input type="submit" name="update" class="w3-btn w3-black" value="Save Changes">
        </form>
    <?php
    }
    if (isset($_POST['update'])) {
        $uid  = mysqli_real_escape_string($conn, $_POST['user_id']);
        $uname = mysqli_real_escape_string($conn, $_POST['username']);
        $pass = trim($_POST['password']);
        if ($pass !== "") {
            $hashed = password_hash($pass, PASSWORD_DEFAULT);
            $update = "UPDATE users SET username='$uname', password='$hashed' WHERE user_id='$uid'";
        } else {
            $update = "UPDATE users SET username='$uname' WHERE user_id='$uid'";
        }
        if ($conn->query($update)) {
            echo "<div class='w3-panel w3-green w3-round-large w3-margin-top'>
                    <h3>Success!</h3>
                    <p>Member updated successfully.</p>
                  </div>";
        } else {
            echo "<div class='w3-panel w3-red w3-round-large w3-margin-top'>
                    <b>Error:</b> " . $conn->error . "
                  </div>";
        }
    }
    $conn->close();
    ?>
</div>
</body>
</html>