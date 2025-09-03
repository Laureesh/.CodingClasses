<!DOCTYPE html>
<html>
<head>
	<title>Variables & Operators</title>
</head>
<body>
	<h1>Variables & Operators PHP Sample</h1>

	<?php
		//This is comment 1
		#This is comment 2
		/* This is comment 3 */
		
		//Variables are defined the first time they are used
		$indent = "&nbsp; &nbsp; ";
		$mystyle = " style='color:teal;' ";
		$a = 8;
		$b = 4;
		
		echo "<h2 $mystyle>Variables</h2>";
		echo "a = $a<br>";
		echo "b = $b<br>";
		
		echo "<h2 $mystyle>Basic Operations</h2>";
		echo "$a + $b = ".($a+$b)."<br>";
		echo "$a - $b = ".($a-$b)."<br>";
		echo "$a * $b = ".($a*$b)."<br>";
		echo "$a / $b = ".($a/$b)."<br>";
		
		echo "<h2 $mystyle>Increment/Decrement</h2>";
		echo "a = $a<br>";
		echo "b = $b<br>";		
		echo "$indent Post-increment. Value of a = ".($a++)."<br>";
		echo "$indent After Post-increment. Value of a = $a<br>";
		echo "$indent Pre-increment. Value of a = ".(++$a)."<br>";
		echo "$indent After Pre-increment. Value of a = $a<br>";
		
		echo "<h2 $mystyle>Casting</h2>";
		$quantity = 9; //Integer
		$price = 4.52; //float
		$total = $price * $quantity;
		$totalInt = (int)($total);
		$totalIntRounded = (int)($total+.5);
		$payWithCard = $total >= 10;
		
		echo "quantity = $quantity<br>";
		echo "price = $price<br>";
		echo "total = $total<br>";
		echo "total with no cents = $totalInt<br>";
		echo "rounded total with no cents = $totalIntRounded<br>";
		
		if($payWithCard)
			echo "Customer allowed to pay with credit card";
		else
			echo "Customer not allowed to pay with credit card";
		
		//shorter version
		// echo "Customer ".($payWithCard? '':'NOT')." allowed to pay with credit card";
		
		echo "<h2 $mystyle>Constants</h2>";
		define('TAX_RATE', .065);
		define('STUDENT_DISCOUNT', .02);
		define('MILITARY_DISCOUNT', .04);
		
		echo "Tax Rate: ".(TAX_RATE*100)."%<br>";
		echo "Student Discount: ".(STUDENT_DISCOUNT*100)."%<br>";
		echo "Military Discount: ".(MILITARY_DISCOUNT*100)."%<br>";
		
		echo "<h2 $mystyle>Reference Operator</h2>";
		//by value
		$a = 5; $b = 6;
		echo "a = $a<br>";
		echo "b = $b<br>";
		echo "Let's make b = a<br>";
		$b = $a;
		echo "Now, b = a = $a<br>";
		echo "Let's increment b by 1<br>";
		$b++;
		echo "Now b = $b<br>";
		echo "And a = $a. Notice that a kept its original value<br><br>";
		
		//by reference
		$a = 8;
		echo "Let's make a = $a<br>";
		echo "And b = &a<br>";
		$b = &$a;
		echo "Now, b = &a = $b<br>";
		echo "Let's increment b by 1<br>";
		$b++;
		echo "Now b = $b<br>";
		echo "And a = $a. Notice that the value of a also changed<br><br>";		
		
		//break the link
		unset($a);
	?>

</body>
</html>