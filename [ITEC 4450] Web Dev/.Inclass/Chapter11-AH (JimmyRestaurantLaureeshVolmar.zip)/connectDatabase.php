<?php
    $servername = "localhost"; # phpMyAdmin → TopLeftClickHome → UserAccounts@Top
    $username = "guest";
    $password = "ggcITEC4450@";
    $dbname = "restaurantdb";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>