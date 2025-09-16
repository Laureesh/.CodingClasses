<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ch3-PHP Arrays-Multidimensional</title>
    <style>h2 { color:blueviolet}</style>
</head>
<body>
    <h1>Ch3 - PHP Multidimensional Arrays</h1>
    <?php
    echo "<h2>Multidimensional Arrays</h2>";
    $countries = [
        ['United States', 'Canada', 'Mexico'],
        ['Honduras', 'Guatemala', 'Costa Rica'],
        ['Jamaica', 'Dominican Republic', 'Haiti']
    ];
    
    echo "<h3>Accessing Individual Elements</h3>";
    echo "[0][1]: ".$countries[0][1] . "<br>"; // Canada
    echo "[1][2]: ".$countries[1][2] . "<br>"; // Costa Rica
    echo "[2][1]: ".$countries[2][0] . "<br>"; // Jamaica

    echo "<h3>Looping with indexes</h3>";
    for ($i = 0; $i < count($countries); $i++) {
        echo "Row $i: ";
        for ($j = 0; $j < count($countries[$i]); $j++) {
            echo "[$j] ".$countries[$i][$j] . ", ";
        }
        // next line
        echo "<br>";
    }
     echo "<h3>Looping with foreach</h3>";
        foreach ($countries as $region => $country) {
            echo "Row $region: ";
            foreach ($country as $keyCountry => $countryName) {
                echo "[$keyCountry] $countryName, ";
            }
            // next line
            echo "<br>";
        }
    ?>
</body>
</html>