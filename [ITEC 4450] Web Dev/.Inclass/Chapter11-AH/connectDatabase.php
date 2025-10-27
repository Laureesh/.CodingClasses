<?php
    $servername = "localhost";
    $username = "root"; // root but was guest
    $password = ""; // No Password but was ggcITEC4450@
    $dbname = "restaurantdb";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>