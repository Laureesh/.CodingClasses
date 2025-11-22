<?php
    session_start();
    require "connectDatabase.php";

    if (!isset($_SESSION["loggedin"]) || !isset($_POST['movie_id'])) {
        header("location: history.php");
        exit;
    }

    $user_id = $_SESSION["user_id"];
    $movie_id = intval($_POST["movie_id"]);

    $sql = "DELETE FROM play_history WHERE user_id = ? AND movie_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user_id, $movie_id);
    $stmt->execute();

    header("location: history.php");
    exit;
?>