<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Variables & Operators PHP</title>
</head>

<body>
    <h1>Variables & Operators PHP sample</h1>

    <?php
    // Comment 1
    # Comment 2
    /* Comment 3 */

    # variables are defined the first time you use them
    $indent = "&nbsp; &nbsp;";
    $a = 8;
    $b = 4;

    echo "<h2>Variables</h2>";
    echo "a = $a<br>";
    echo "b = $b<br>";
    # XAMPP > Admin > localhost/dashboard/ > localhost/itec4450/
    echo "<h2>Basic Operators</h2>";
    echo "$a + $b = " . ($a + $b) . "<br>";
    echo "$a - $b = " . ($a - $b) . "<br>";
    echo "$a * $b = " . ($a * $b) . "<br>";
    echo "$a / $b = " . ($a / $b) . "<br>";

    echo "<h2>Increment/Decrement Operators</h2>";
    echo "a = $a<br>";
    echo "b = $b<br>";
    echo "$indent Post-increment. Value of a = " . ($a++) . "<br>";
    echo "$indent After post-increment, value of a = $a<br>";

    echo "$indent Pre-increment. Value of a = " . (++$a) . "<br>";
    echo "$indent After pre-increment, value of a = $a<br>";

    echo "$indent Post-decrement. Value of b = " . ($b--) . "<br>";
    echo "$indent After post-decrement, value of b = $b<br>";

    echo "$indent Pre-decrement. Value of b = " . (--$b) . "<br>";
    echo "$indent After pre-decrement, value of b = $b<br>";

    echo "<h2>Type conversion and casting</h2>";
    $quantity = 9; # integer
    $price = 4.52; # float
    $total = $quantity * $price;
    $totalInt = (int) $total; # cast to integer
    $paidWithCard = $total >= 10;

    echo "Quantity = $quantity<br>";
    echo "Price = $price<br>";
    echo "Total = quantity * price<br>";
    echo "Total = $total<br>";
    echo "Total with no cents = $totalInt<br>";

    if ($paidWithCard) {
        echo "You are allowed to pay with credit card<br>";
    }
    else {
        echo "You have to pay cash<br>";
    }
    echo "<h2>Constants</h2>";
    define("TAX_RATE", 0.065);
    define("STUDENT_DISCOUNT", 0.02);
    define("MILITARY_DISCOUNT", 0.04);
    define("PI", 3.14159);

    echo "Tax rate: " . (TAX_RATE * 100) . "%<br>";
    echo "Student discount: " . (STUDENT_DISCOUNT * 100) . "%<br>";
    echo "Military discount: " . (MILITARY_DISCOUNT * 100) . "%<br>";
    echo "Value of PI: " . PI . "<br>";

    echo "<h2>Reference Operator</h2>";
    $a = $$b = 6;
    echo "a = $a<br>";
    echo "Let's make b = a<br>";
    $b = $a;
    echo "NOW, b = a = $b<br>";
    echo "Let's increment b by 1<br>";
    $b++;
    echo "NOW, b = $b<br>";
    echo "a = $a. Notice that a kept its original value<br><br>";

    #-------
    echo "Let's use the reference operator (&)<br>";
    $a = 10;
    echo "Let's make a = $a<br>";
    echo "And lets make b = &a<br>";
    $b = &$a;
    echo "b = $b<br>";
    echo "Let's increment b by 1<br>";
    $b++;
    echo "NOW, b = $b<br>";
    echo "And a = $a. Notice that the value of a has also changed<br>";

    echo "This is because now a and b point to the same memory location.<br>";
    echo "If you change the value of one, the other will also change.<br>";

    echo "If you want to break that link, you can use the unset() function.<br>";
    unset($a);

    ?>
</body>

</html>