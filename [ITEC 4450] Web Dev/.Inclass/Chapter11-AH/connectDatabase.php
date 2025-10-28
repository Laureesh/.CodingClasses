<?php
    $servername = "localhost"; # phpMyAdmin → Top-Left Click Home → User Accounts at the top
    $username = "guest"; # Add user account | Host: localhost | Username: guest
    $password = "ggcITEC4450@"; # Password: "ggcITEC4450@" | Global privileges: ALL PRIVILEGES
    $dbname = "restaurantdb";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>