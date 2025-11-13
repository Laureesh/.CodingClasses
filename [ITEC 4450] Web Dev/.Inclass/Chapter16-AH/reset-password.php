<?php
    # initialize the session
    session_start();

    # check if the user is logged in, if not then redirect to login page
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        header("location: login.php");
        exit;
    }

    # include config file
    require_once "config.php";

    # define variables and initialize with empty values
    $new_password = $confirm_password = "";
    $new_password_err = $confirm_password_err = "";

    # processing form data when form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        # validate new password
        if (empty(trim($_POST["new_password"]))) {
            $new_password_err = "Please enter the new password.";     
        } elseif (strlen(trim($_POST["new_password"])) < 6) {
            $new_password_err = "Password must have at least 6 characters.";
        } else {
            $new_password = trim($_POST["new_password"]);
        }

        # validate confirm password
        if (empty(trim($_POST["confirm_password"]))) {
            $confirm_password_err = "Please confirm the password.";
        } else {
            $confirm_password = trim($_POST["confirm_password"]);
            if (empty($new_password_err) && ($new_password != $confirm_password)) {
                $confirm_password_err = "Password did not match.";
            }
        }

        # check input errors before updating the database
        if (empty($new_password_err) && empty($confirm_password_err)) {
            # prepare an update statement
            $sql = "UPDATE users SET password = ? WHERE id = ?";

            if ($stmt = mysqli_prepare($link, $sql)) {
                # bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);

                # set parameters
                $param_password = password_hash($new_password, PASSWORD_DEFAULT);
                $param_id = $_SESSION["id"];

                # attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    # password updated successfully. Destroy the session, and redirect to login page
                    session_destroy();
                    header("location: login.php");
                    exit();
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
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body class="w3-light-grey">
    <div class="wrapper w3-border">
        <h2>Reset Password</h2>
        <p>Please fill in your credentials to reset your password.</p>
        <form method="POST">
            <div class="w3-container <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                <label>New Password</label>
                <input type="password" name="new_password" class="w3-input" value="<?php echo $new_password; ?>">
                <span class="w3-red"><?php echo $new_password_err; ?></span>
            </div>

            <div class="w3-container <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="w3-input" value="<?php echo $confirm_password; ?>">
                <span class="w3-red"><?php echo $confirm_password_err; ?></span>
            </div>

            <div class="w3-container">
                <input type="submit" class="w3-btn w3-purple" value="Submit">
                <a class="w3-btn w3-black" href="welcome.php">Cancel</a>
            </div>
        </form>
    </div>
    
</body>
</html>