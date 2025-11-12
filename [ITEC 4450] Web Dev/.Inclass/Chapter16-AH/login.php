<?php
# initialize the size
session_start();

# check if the user is already logged in, if yes then redirect to welcome page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: welcome.php");
    exit;
}

# include config file
require_once "config.php";

# define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

# processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    # check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }

    # check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    # validate credentials
    if (empty($username_err) && empty($password_err)) {
        # prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            # bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            # set parameters
            $param_username = $username;

            # attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                # store result
                mysqli_stmt_store_result($stmt);

                # check if username exists, if yes then verify password
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    # bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            # password is correct, so start a new session
                            session_start();

                            # store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            # redirect user to welcome page
                            header("location: welcome.php");
                        } else {
                            # display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else {
                    # display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            # close statement
            mysqli_stmt_close($stmt);
        }
    }

    # close connection
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        body { font: 14px sans-serif; }
        .wrapper { width: 350px; padding: 20px; }
    </style>
</head>
<body class="w3-light-grey">
    <div class="wrapper w3-border">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form method="POST">
            <div class="w3-container <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="w3-input w3-border" value="<?php echo $username; ?>">
                <span class="w3-red"><?php echo $username_err; ?></span>
            </div>

            <div class="w3-container <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="w3-input">
                <span class="w3-red"><?php echo $password_err; ?></span>
            </div>

            <div class="w3-container">
                <input type="submit" class="w3-btn w3-purple" value="Login">
            </div>
            <br> Don't have an account? <a href="register.php">Sign up now!</a>
        </form>
    </div>
    
</body>
</html>