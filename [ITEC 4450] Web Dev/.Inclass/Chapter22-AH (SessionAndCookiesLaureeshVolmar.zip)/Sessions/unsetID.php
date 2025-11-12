<?php
# begins session and allows access to the $_SESSION superglobal array
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unset ID</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-cyan.css">
</head>
<body class="w3-theme-l5">
    <div class="w3-container w3-theme-l1 w3-center">
        <h1>Session Example</h1>
        <h2>Unset ID</h2>
    </div>
    <div>
        <?php include 'mainMenu.php'; ?>
    </div>
    <div class="w3-container w3-theme-l4">
        <?php
            # unset the session variable with the name 'id'
            unset($_SESSION['id']);
        ?>
    </div>
</body>
</html>