<!DOCTYPE html>
<html>
<head>
	<title>Variables & Operators PHP sample 2</title>
	
</head>
<body>

	<h1>Variables & Operators PHP sample 2</h1>

	<?php
		$style = "style='color:red' ";
		//comparison operators
		$a = 5; 
		$b = 5;
		
		//compare values
		echo "<h3 $style>Compare values</h3>";
		echo "a = $a, b = $b<br>";
		if($a == $b)
			echo "a == b<br>a and b have the same value<br>";
		else
			echo "a != b<br>a and b do not have the same value<br>";
		
		$x = 7;
		$y = "7";
		$z = 7;
		echo "<h3 $style>Compare values and types</h3>";
		echo "x = $x, y = $y, z = $z<br>";
		echo "type of x is ".gettype($x)."<br>";
		echo "type of y is ".gettype($y)."<br>";
		echo "type of z is ".gettype($z)."<br>";
		
		if($x == $y)
			echo "x == y<br>x and y have the same value<br>";
		else
			echo "x != y<br>x and y do not have the same value<br>";
		
		echo "<br>";
		
		if($x === $y)
			echo "x === y<br>x and y have the same value and type<br>";
		else
			echo "x !== y<br>x and y do not have the same value or type<br>";
		
		echo "<br>";

		if($x === $z)
			echo "x === z<br>x and z have the same value and type<br>";
		else
			echo "x !== z<br>x and z do not have the same value or type<br>";		
		
		echo "<h3 $style>Logical Operators</h3>";
		$waterTemperature = 290; //in Kelvin
		$boilingPoint = 373.2;
		$freezingPoint = 273.2;
		
		echo "Temperature in Kelvin<br>";
		echo "BoilingPoint: $boilingPoint<br>";
		echo "FreezingPoint: $freezingPoint<br>";		
		echo "Water Temperature: $waterTemperature<br>";
		
		if(($waterTemperature > $freezingPoint) && ($waterTemperature < $boilingPoint))
			echo "Water is in liquid state<br>";	//both conditions are true
		else
			if($waterTemperature <= $freezingPoint)
				echo "Water is frozen<br>";
			else
				echo "Water is vapor (gas)<br>";
			
		echo "<br>";	
		
		//other logical operators such as || (or), ! (not), xor, etc. work the same
		//as in Java
		echo "<h3 $style>The Ternary Operator</h3>";
		//the ternary operator is used as a short if statement
		$age = 25;
		echo "Linda is $age years old. She is ";
		echo $age > 20? "adult<br>" : "underage<br>";
		
		echo "<h3 $style>The Error Supression Operator</h3>";
		$a = 25; $b = 0;
		
		echo "$a / $b = <br>";
		echo @($a / $b);	//The divide by zero error has been suppressed
		
		echo "<h3 $style>The Execution Operator</h3>";
		//use backticks
		$out = `dir`;
		
		echo "<pre>$out</pre>";
	?>

</body>
</html>