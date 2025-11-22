<?php
    // Initialize the session
    session_start();

    // Check if the user is logged in, otherwise redirect to login page
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
    }

    // Include config file
    require_once "config.php";

    // Define variables and initialize with empty values
    $new_password = $confirm_password = "";
    $new_password_err = $confirm_password_err = "";

    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        // Validate new password
        if(empty(trim($_POST["new_password"]))){
            $new_password_err = "Please enter the new password.";
        } elseif(strlen(trim($_POST["new_password"])) < 6){
            $new_password_err = "Password must have atleast 6 characters.";
        } else{
            $new_password = trim($_POST["new_password"]);
        }

        // Validate confirm password
        if(empty(trim($_POST["confirm_password"]))){
            $confirm_password_err = "Please confirm the password.";
        } else{
            $confirm_password = trim($_POST["confirm_password"]);
            if(empty($new_password_err) && ($new_password != $confirm_password)){
                $confirm_password_err = "Password did not match.";
            }
        }

        // Check input errors before updating the database
        if(empty($new_password_err) && empty($confirm_password_err)){

            // Prepare an update statement
            $sql = "UPDATE users SET password = ? WHERE user_id = ?";

            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);

                // Set parameters
                $param_password = password_hash($new_password, PASSWORD_DEFAULT);
                $param_id = $_SESSION["user_id"];

                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Password updated successfully. Destroy the session, and redirect to login page
                    session_destroy();
                    header("location: login.php");
                    exit();
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }

        // Close connection
        mysqli_close($link);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MovieFlix - Reset Password</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        .reset-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 30px;
        }
    </style>
</head>
<body class="w3-theme-d1">
    <?php include 'mainMenu.php'; ?>
    <div class="reset-container w3-card-4 w3-theme-d3">
        <h2 class="w3-center">Reset Password</h2>
        <p class="w3-center">Please fill out this form to reset your password.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="w3-container <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                <label>New Password</label>
                <input type="password" name="new_password" class="w3-input w3-border" value="<?php echo $new_password; ?>">
                <span class="w3-text-red"><?php echo $new_password_err; ?></span>
            </div>
            <div class="w3-container <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="w3-input w3-border">
                <span class="w3-text-red"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="w3-container w3-margin-top">
                <input type="submit" class="w3-button w3-cyan w3-block" value="Reset Password">
                <a class="w3-button w3-gray w3-block w3-margin-top" href="index.php">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>