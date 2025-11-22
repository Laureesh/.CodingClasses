<?php
    include "utilFunctions.php";
    session_start();

    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        header("Location: login.php");
        exit;
    }

    if (!isset($_GET['movie_id'])) {
        header("Location: watchlist.php");
        exit;
    }

    $user_id  = $_SESSION["user_id"];
    $movie_id = intval($_GET['movie_id']);

    include "connectDatabase.php";

    $sql = "DELETE FROM watchlists WHERE user_id = ? AND movie_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user_id, $movie_id);
    $stmt->execute();

    $stmt->close();
    $conn->close();

    header("Location: watchlist.php");
    exit;
?>