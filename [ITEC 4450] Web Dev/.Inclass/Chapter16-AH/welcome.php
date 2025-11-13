<?php
    # Initialize the session
    session_start();

    # Check if the user is logged in, if not then redirect him to login page
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        header("location: login.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style>
        body { font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div>
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION['username']) ?></b>. Welcome to our site!</h1>
        This is a protected page so only users that have successfully logged in can access it.
    </div>

    <br>
    <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
    <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
</body>
</html>