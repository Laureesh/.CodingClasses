<?php
    # include config file
    require_once "config.php";

    # define variables and initialize with empty values
    $username = $password = $confirm_password = "";
    $username_err = $password_err = $confirm_password_err = "";

    # processing form data when form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        # validate username
        if (empty(trim($_POST["username"]))) {
            $username_err = "Please enter a username.";
        } else {
            # prepare a select statement
            $sql = "SELECT id FROM users WHERE username = ?";

            if ($stmt = mysqli_prepare($link, $sql)) {
                # bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_username);

                # set parameters
                $param_username = trim($_POST["username"]);

                # attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    # store result
                    mysqli_stmt_store_result($stmt);

                    if (mysqli_stmt_num_rows($stmt) == 1) {
                        $username_err = "This username is already taken.";
                    } else {
                        $username = trim($_POST["username"]);
                    }
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }

            # close statement
            mysqli_stmt_close($stmt);

        }

        # validate password
        if (empty(trim($_POST["password"]))) {
            $password_err = "Please enter a password.";
        } elseif (strlen(trim($_POST["password"])) < 6) {
            $password_err = "Password must have at least 6 characters.";
        } else {
            $password = trim($_POST["password"]);
        }

        # validate confirm password
        if (empty(trim($_POST["confirm_password"]))) {
            $confirm_password_err = "Please confirm password.";
        } else {
            $confirm_password = trim($_POST["confirm_password"]);
            if (empty($password_err) && ($password != $confirm_password)) {
                $confirm_password_err = "Password did not match.";
            }
        }

        # check input errors before inserting in database
        if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {

            # prepare an insert statement
            $sql = "INSERT INTO users (username, password) VALUES (?, ?)";

            if ($stmt = mysqli_prepare($link, $sql)) {
                # bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

                # set parameters
                $param_username = $username;
                $param_password = password_hash($password, PASSWORD_DEFAULT); # creates a password hash

                # attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    # redirect to login page
                    header("location: login.php");
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }

            # close statement
            mysqli_stmt_close($stmt);
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
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style type="text/css">
        body { font: 14px sans-serif; }
        .wrapper { width: 350px; padding: 20px; }
    </style>
</head>
<body class="w3-light-grey">
    <div class="wrapper w3-sand w3-border">
        <h2>Sign Up</h2>
        <p>Please fill in your credentials to create an account.</p>
        <form method="POST">
            <div class="w3-container <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="w3-input w3-border" value="<?php echo $username; ?>">
                <span class="w3-red"><?php echo $username_err; ?></span>
            </div>

            <div class="w3-container <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="w3-input" value="<?php echo $password; ?>">
                <span class="w3-red"><?php echo $password_err; ?></span>
            </div>

            <div class="w3-container <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="w3-input" value="<?php echo $confirm_password; ?>">
                <span class="w3-red"><?php echo $confirm_password_err; ?></span>
            </div>

            <div class="w3-container">
                <input type="submit" class="w3-btn w3-purple" value="Submit">
                <input type="reset" class="w3-btn w3-black" value="Reset">
            </div>
            <br> Already have an account? <a href="login.php">Login here!</a>
        </form>
    </div>
    
</body>
</html>