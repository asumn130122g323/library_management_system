<?php
session_start();
include "adminpage/database/database.php";

if (!isset($_SESSION["ID"])) {
    die("Unauthorized access.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_id = intval($_POST["book_id"]);
    $user_id = $_SESSION["ID"];
    $comment = trim($_POST["mess"]);

    if (!empty($comment)) {
        $sql = "INSERT INTO comment (BID, SID, COMM, LOGS) VALUES (?, ?, ?, NOW())";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("iis", $book_id, $user_id, $comment);
        
        if ($stmt->execute()) {
            header("Location: comment.php?id=$book_id");
            exit();
        } else {
            echo "<p class='error'>Error submitting comment.</p>";
        }
    } else {
        echo "<p class='error'>Comment cannot be empty.</p>";
    }
}
?>
