<?php
include "utilFunctions.php";
include "connectDatabase.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieFlix - Edit Genre</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<div class="w3-container w3-black">
    <?php include "movieAdminMainMenu.php"; ?>
    <header class="w3-display-container w3-center">
        <h1><b>MovieFlix</b></h1>
        <h2>Edit Genre</h2>
    </header>
    <form method="POST" class="w3-container w3-light-grey">
        <fieldset>
            <legend class="w3-large w3-center w3-text-theme"><b>Select Genre to Edit</b></legend>

            <label>Genre</label>
            <select name="genre_id" class="w3-select w3-border" required onchange="this.form.submit()">
                <option value="" disabled selected>Choose a Genre</option>
                <?php
                    $genres = $conn->query("SELECT genre_id, genre_name FROM genres ORDER BY genre_id ASC");
                    while ($g = $genres->fetch_assoc()) {
                        $selected = (isset($_POST['genre_id']) && $_POST['genre_id'] == $g['genre_id']) ? "selected" : "";
                        echo "<option value='{$g['genre_id']}' $selected>{$g['genre_id']} | {$g['genre_name']}</option>";
                    }
                ?>
            </select>
        </fieldset>
    </form>
    <?php
    if (isset($_POST['genre_id'])) {
        $genre_id = mysqli_real_escape_string($conn, $_POST['genre_id']);
        $result = $conn->query("SELECT * FROM genres WHERE genre_id = '$genre_id'");
        $genre = $result->fetch_assoc();
    ?>
        <form method="POST" class="w3-container w3-light-grey w3-margin-top">
            <fieldset>
                <legend class="w3-large w3-center w3-text-theme"><b>Edit Genre Name</b></legend>

                <input type="hidden" name="genre_id" value="<?php echo $genre['genre_id']; ?>">

                <label>Genre Name</label>
                <input type="text" name="genre_name" class="w3-input w3-border" value="<?php echo $genre['genre_name']; ?>" required>
            </fieldset>
            <br><input type="submit" name="update" class="w3-btn w3-black" value="Save Changes">
        </form>
    <?php
    }
    if (isset($_POST['update'])) {
        $id = mysqli_real_escape_string($conn, $_POST['genre_id']);
        $name = mysqli_real_escape_string($conn, trim($_POST['genre_name']));
        $update = "UPDATE genres SET genre_name='$name' WHERE genre_id='$id'";
        if ($conn->query($update)) {
            echo "<div class='w3-panel w3-green w3-round-large w3-margin-top'>
                    <h3>Success!</h3>
                    <p>Genre updated successfully.</p>
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