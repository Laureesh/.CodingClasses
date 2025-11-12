<?php
# to "delete" a cookie, set the expiration date to the past
setcookie("favColor", "", time() - 3600, "/");
setcookie("favAnimal", "", time() - 3600, "/");
setcookie("favSchool", "", time() - 3600, "/");
setcookie("favTeam", "", time() - 3600, "/");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cookie Example</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-cyan.css">
</head>
<body class="w3-theme-l5">
    <div class="w3-container w3-theme-l1 w3-center">
        <h1>Cookie Example</h1>
        <h2>Deleting Cookies</h2>
    </div>
    <div>
        <?php include 'mainMenu.php'; ?>
    </div>
    <div class="w3-container w3-theme-l4">
        <?php
        $list_cookies = ['favColor', 'favAnimal', 'favSchool', 'favTeam'];

        foreach ($list_cookies as $cookie) {
            if (!isset($_COOKIE[$cookie])) {
                echo "Cookie $cookie has been deleted!<br>";
            } else {
                echo "Cookie $cookie is set!<br>";
                echo "Value is: " .$_COOKIE[$cookie] . "<br><br>";
            }
        }
        ?>
    </div>
</body>
</html>