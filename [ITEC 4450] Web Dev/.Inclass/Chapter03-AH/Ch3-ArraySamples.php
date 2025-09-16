<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ch3-PHP Arrays</title>
    <style>h2 { color:blueviolet}</style>
</head>
<body>
    <h1>Ch3 - PHP Arrays</h1>
    <?php
    echo "<h2>Numerically Indexed</h2>";
    $burgerArray = array("Burger King", "Five Guys", "Krystal's", "McDonald's", "Wendy's");
    $mexicanFoodArray = ['Chipotle', 'Del Taco', 'Taco Bell', 'On the border', 'El Ranchero', 'La Bamba', 'Willys'];
    $pizzaArray = ['Papa Johns', 'Pizza Hut', 'Dominos', 'Riverside', 'Little Caesar'];

    $numbers = range(1, 10);
    $odds = range(1, 10, 2);
    $letters = range('a', 'z');

    echo "<h3>Convert to string and display</h3>";
    echo implode(", ", $burgerArray) . "<br>";
    echo implode(", ", $mexicanFoodArray) . "<br>";
    echo implode(", ", $pizzaArray) . "<br>";
    echo implode(", ", $numbers) . "<br>";
    echo implode(", ", $odds) . "<br>";
    echo implode(", ", $letters) . "<br>";

    echo "<h3>Access individual elements</h3>";
    echo "First burger chain: $burgerArray[0]<br>";
    echo "Second burger chain: $burgerArray[1]<br>";
    echo "Last burger chain: ".end($burgerArray)."<br>";

    echo "<h3>Adding elements</h3>";
    echo "Appending 'Sonic' and 'White Castle' to the end<br>";
    array_push($burgerArray, 'Sonic', 'White Castle');
    echo implode(", ", $burgerArray) . "<br>";

    echo "Insert 'Frontera' and 'Los Amigos' at index 2<br>";
    $newMexicanArray = ['Frontera', 'Los Amigos'];
    array_splice($mexicanFoodArray, 2, 0, $newMexicanArray);
    echo implode(", ", $mexicanFoodArray) . "<br>";

    echo "<h3>Looping</h3>";
    echo "Using a looping variable<br>";
    for ($i = 0; $i < count($pizzaArray); $i++) {
        echo $pizzaArray[$i]. ", ";
    }
    echo "<br><br>Using foreach<br>";
    foreach ($burgerArray as $burger) {
        echo $burger.", ";
    }

    echo "<h2>Associative Arrays</h2>";
    $ageArray = array("Heather"=>20, "Clarissa"=>21, "Ken"=>19, "Marcus"=>18);
    echo "Heather: ".$ageArray['Heather']."<br>";
    echo "Clarissa: ".$ageArray['Clarissa']."<br>";
    echo "Ken: ".$ageArray['Ken']."<br>";
    echo "Marcus: ".$ageArray['Marcus']."<br>";

    echo "<h3>Looping</h3>";
    echo "Using foreach<br>";
    foreach ($ageArray as $name => $age) {
        echo "$name is $age years old.<br>";
    }

    echo "<h3>Calculate sum and average age</h3>";
    $totalAge = array_sum($ageArray);
    $averageAge = $totalAge / count($ageArray);
    echo "Total age: $totalAge<br>";
    echo "Average age: $averageAge<br>";
    ?>
</body>
</html>