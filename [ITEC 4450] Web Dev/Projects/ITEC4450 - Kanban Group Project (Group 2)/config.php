<?php
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'guest');
    define('DB_PASSWORD', 'ggcITEC4450@');
    define('DB_NAME', 'moviedb');

    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
?>