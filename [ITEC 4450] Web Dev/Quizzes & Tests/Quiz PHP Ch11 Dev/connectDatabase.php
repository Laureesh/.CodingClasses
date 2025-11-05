<?php
	$servername = "localhost";
	$username = "guest";
	$password = "ggcITEC4450@";
	$dbname = "sandwichdb";
					
	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
	}
?>