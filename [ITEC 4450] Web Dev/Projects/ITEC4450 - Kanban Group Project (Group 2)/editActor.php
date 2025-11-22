<?php
include "utilFunctions.php";
include "connectDatabase.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieFlix - Edit Actor</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<div class="w3-container w3-black">
    <?php include "movieAdminMainMenu.php"; ?>
    <header class="w3-display-container w3-center">
        <h1><b>MovieFlix</b></h1>
        <h2>Edit Actor</h2>
    </header>
    <form method="POST" class="w3-container w3-light-grey">
        <fieldset>
            <legend class="w3-large w3-center w3-text-theme"><b>Select Actor to Edit</b></legend>
            <label>Actor</label>
            <select name="actor_id" class="w3-select w3-border" required onchange="this.form.submit()">
                <option value="" disabled selected>Choose an Actor</option>
                <?php
                    $actors = $conn->query("SELECT actor_id, actor_name FROM actors ORDER BY actor_id ASC");
                    while ($actor = $actors->fetch_assoc()) {
                        $selected = (isset($_POST['actor_id']) && $_POST['actor_id'] == $actor['actor_id']) ? "selected" : "";
                        echo "<option value='{$actor['actor_id']}' $selected>{$actor['actor_id']} | {$actor['actor_name']}</option>";
                    }
                ?>
            </select>
        </fieldset>
    </form>

    <?php
    if (isset($_POST['actor_id'])) {
        $actor_id = mysqli_real_escape_string($conn, $_POST['actor_id']);
        $result = $conn->query("SELECT * FROM actors WHERE actor_id = '$actor_id'");
        $actor = $result->fetch_assoc();
    ?>
        <form method="POST" class="w3-container w3-light-grey w3-margin-top">
            <fieldset>
                <legend class="w3-large w3-center w3-text-theme"><b>Edit Actor Details</b></legend>
                <input type="hidden" name="actor_id" value="<?php echo $actor['actor_id']; ?>">
                <label>Actor Name</label>
                <input type="text" name="actor_name" class="w3-input w3-border" value="<?php echo $actor['actor_name']; ?>" required>
                <label>Bio</label>
                <textarea name="bio" class="w3-input w3-border" required><?php echo $actor['bio']; ?></textarea>
                <label>Birth Year</label>
                <input type="number" name="birth_year" class="w3-input w3-border" value="<?php echo $actor['birth_year']; ?>" min="1900" max="2025" required>
                <label>Photo URL</label>
                <input type="text" name="photo_url" class="w3-input w3-border" value="<?php echo $actor['photo_url']; ?>" required>
            </fieldset>
            <br><input type="submit" name="update" class="w3-btn w3-black" value="Save Changes">
        </form>
    <?php
    }
    if (isset($_POST['update'])) {
        $id = mysqli_real_escape_string($conn, $_POST['actor_id']);
        $name = mysqli_real_escape_string($conn, $_POST['actor_name']);
        $bio = mysqli_real_escape_string($conn, $_POST['bio']);
        $year = mysqli_real_escape_string($conn, $_POST['birth_year']);
        $photo = mysqli_real_escape_string($conn, $_POST['photo_url']);
        $update = "UPDATE actors 
                   SET actor_name='$name', bio='$bio', birth_year='$year', photo_url='$photo'
                   WHERE actor_id='$id'";
        if ($conn->query($update)) {
            echo "<div class='w3-panel w3-green w3-round-large w3-margin-top'>
                    <h3>Success!</h3>
                    <p>Actor updated successfully.</p>
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