<?php
function htc($text) {
    return htmlspecialchars($text);
}

$fName = $lName = $email = $phone = $street = $city = $state = $zip = $regex1 = $regex2 = $regex3 = "";

$errors = array('fName' => '', 'lName' => '', 'email'=> '', 'phone'=> '', 'street'=> '', 'city'=> '', 'state'=> '', 'zip'=> '', 'regex1'=> '', 'regex2'=> '', 'regex3'=> '');

if(isset($_POST['submit'])) {
    // First Name
    if(empty($_POST['fName'])) {
        $errors['fName'] = 'First Name is required';
    } else {
        $fName = $_POST['fName'];
        if(!preg_match('/^[a-zA-Z\s]+$/', $fName)) {
            $errors['fName'] = 'First Name must be letters and spaces only';
        }
    }

    // Last Name
    if(empty($_POST['lName'])) {
        $errors['lName'] = 'Last Name is required';
    } else {
        $lName = $_POST['lName'];
        if(!preg_match('/^[a-zA-Z\s\-]+$/', $lName)) {
            $errors['lName'] = 'Last Name must be letters and spaces only';
        }
    }

    // Email
    if(empty($_POST['email'])) {
        $errors['email'] = 'Email is required';
    } else {
        $email = $_POST['email'];
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email must be a valid email address';
        }
    }

    // Phone Number
    if(empty($_POST['phoneNumber'])) {
        $errors['phone'] = 'Phone Number is required';
    } else {
        $phone = $_POST['phoneNumber'];
        // Valid formats: 123-456-7890, (123) 456-7890, 123.456.7890, 1234567890
        // '/^\d{3}\-\d{3}\-\d{4}$/' or '/^\(?\d{3}\)?[-.\s]?\d{3}[-.\s]?\d{4}$/'
        if(!preg_match('/^\d{3}\-\d{3}\-\d{4}$/', $phone)) {
            $errors['phone'] = 'Phone Number must be a valid US phone number';
        }
    }

    // Street
    if(empty($_POST['street'])) {
        $errors['street'] = 'Street is required';
    } else {
        $street = $_POST['street'];
        /* if(!preg_match('/^[a-zA-Z0-9\s.,#-]+$/', $street)) {
            $errors['street'] = 'Street must be a valid street address';
        }*/
    }

    // City
    if(empty($_POST['city'])) {
        $errors['city'] = 'City is required';
    } else {
        $city = $_POST['city'];
        if(!preg_match('/^[a-zA-Z\s\.\-]+$/', $city)) {
            $errors['city'] = 'City must be letters and spaces only';
        }
    }

    // State
    if(empty($_POST['state'])) {
        $errors['state'] = 'State is required';
    } else {
        $state = $_POST['state'];
        if(!preg_match('/^[a-zA-Z](2)+$/', $state)) {
            $errors['state'] = 'State must be a valid 2-letter US state abbreviation';
        }
    }

    // Zip
    if(empty($_POST['zip'])) {
        $errors['zip'] = 'Zip is required';
    } else {
        $zip = $_POST['zip'];
        if(!preg_match('/^\d{5}(?:-\d{4})+$/', $zip)) {
            $errors['zip'] = 'Zip must be a valid US zip code';
        }
    }

    // Regex1 - All strings containing 'abc'
    if(empty($_POST['regex1'])) {
        $errors['regex1'] = 'This field is required';
    } else {
        $regex1 = $_POST['regex1'];
        // '/aba/'
        if(!preg_match('//', $regex1)) {
            // regex1 must be valid
            $errors['regex1'] = 'Input must contain the substring "abc"';
        }
    }

    // Regex2 - All strings containing 3 consecutive digits all together
    if(empty($_POST['regex2'])) {
        $errors['regex2'] = 'This field is required';
    } else {
        $regex2 = $_POST['regex2'];
        // '/\d{3}/'
        if(!preg_match('//', $regex2)) {
            // regex2 must be valid
            $errors['regex2'] = 'Input must contain at least 3 consecutive digits';
        }
    }

    // Regex3 - All strings containing at least 3 digits, but NOT together
    if(empty($_POST['regex3'])) {
        $errors['regex3'] = 'This field is required';
    } else {
        $regex3 = $_POST['regex3'];
        // '/(?=(?:.*\d){3,})^(?!.*\d{3,}).*$/'
        if(!preg_match('//', $regex3)) {
            // regex3 must be valid
            $errors['regex3'] = 'Input must contain at least 3 digits, but not consecutively';
        }
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regex-Lab Ch4</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="w3-container w3-blue-grey">
        <header>
            <h1>Lab Ch4</h1>
            <h2>Regular Expressions (Regex)</h2>
        </header>

        <form action="regexLabCh4.php" class="w3-container w3-sand" method="post">
            <fieldset>
                <label>First Name</label>
                <input type="text" class="w3-input w3-border" name="fName" value="<?php echo $fName; ?>">
                <div class="w3-red"><?php echo htc($errors['fName']); ?></div>

                <label>Last Name</label>
                <input type="text" class="w3-input w3-border" name="lName" value="<?php echo $lName; ?>">
                <div class="w3-red"><?php echo htc($errors['lName']); ?></div>

                <label>Email</label>
                <input type="text" class="w3-input w3-border" name="email" value="<?php echo $email; ?>">
                <div class="w3-red"><?php echo htc($errors['email']); ?></div>

                <label>Phone Number</label>
                <input type="text" class="w3-input w3-border" name="phoneNumber" value="<?php echo $phone; ?>">
                <div class="w3-red"><?php echo htc($errors['phone']); ?></div>

                <label>Street</label>
                <input type="text" class="w3-input w3-border" name="street" value="<?php echo $street; ?>">
                <div class="w3-red"><?php echo htc($errors['street']); ?></div>

                <label>City</label>
                <input type="text" class="w3-input w3-border" name="city" value="<?php echo $city; ?>">
                <div class="w3-red"><?php echo htc($errors['city']); ?></div>

                <label>State</label>
                <input type="text" class="w3-input w3-border" name="state" value="<?php echo $state; ?>">
                <div class="w3-red"><?php echo htc($errors['state']); ?></div>

                <label>Zip</label>
                <input type="text" class="w3-input w3-border" name="zip" value="<?php echo $zip; ?>">
                <div class="w3-red"><?php echo htc($errors['zip']); ?></div>

                <label>regex1 - All strings containing 'abc'</label>
                <input type="text" class="w3-input w3-border" name="regex1" value="<?php echo $regex1; ?>">
                <div class="w3-red"><?php echo htc($errors['regex1']); ?></div>

                <label>regex2 - All strings containing 3 consecutive digits all together</label>
                <input type="text" class="w3-input w3-border" name="regex2" value="<?php echo $regex2; ?>">
                <div class="w3-red"><?php echo htc($errors['regex2']); ?></div>

                <label>regex3 - All strings containing at least 3 digits, but NOT together</label>
                <input type="text" class="w3-input w3-border" name="regex3" value="<?php echo $regex3; ?>">
                <div class="w3-red"><?php echo htc($errors['regex3']); ?></div>
            </fieldset>
            <br> <input type="submit" name="submit" value="Submit" class="w3-btn w3-blue-grey">
        </form>
        <div class="w3-container w3-sand">
            <?php
            if(isset($_POST['submit']) && !array_filter($errors)) {
                echo "Success!!! All data is valid!<br>";
                echo "<p>First Name: " . htc($fName) . "</p>";
                echo "<p>Last Name: " . htc($lName) . "</p>";
                echo "<p>Email: " . htc($email) . "</p>";
                echo "<p>Phone Number: " . htc($phone) . "</p>";
                echo "<p>Street: " . htc($street) . "</p>";
                echo "<p>City: " . htc($city) . "</p>";
                echo "<p>State: " . htc($state) . "</p>";
                echo "<p>Zip: " . htc($zip) . "</p>";
                echo "<p>Regex1: " . htc($regex1) . "</p>";
                echo "<p>Regex2: " . htc($regex2) . "</p>";
                echo "<p>Regex3: " . htc($regex3) . "</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>