<?php
    include "utilFunctions.php";
    session_start();

    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        header("Location: login.php");
        exit;
    }

    if (!isset($_GET['movie_id'])) {
        header("Location: index.php");
        exit;
    }

    $user_id   = $_SESSION["user_id"];
    $movie_id  = intval($_GET['movie_id']);
    $date_added = date('Y-m-d');

    include "connectDatabase.php";

    $check_sql = "SELECT 1 FROM watchlists WHERE user_id = ? AND movie_id = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("ii", $user_id, $movie_id);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows == 0) {
        $insert_sql = "INSERT INTO watchlists (user_id, movie_id, date_added) VALUES (?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("iis", $user_id, $movie_id, $date_added);
        $insert_stmt->execute();
    }

    $check_stmt->close();
    $conn->close();
    header("Location: watchlist.php");
    exit;
?>