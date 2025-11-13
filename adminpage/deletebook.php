<?php
session_start();
include "database/database.php"; // Ensure correct database connection

// Redirect to login if the admin is NOT logged in
if (!isset($_SESSION["AID"])) {
    header("Location: index.php");
    exit();
}

// Check if ID is provided in the URL
if (isset($_GET["id"])) {
    $id = intval($_GET["id"]); // Sanitize the ID to avoid SQL injection

    // Fetch the file path before deleting the book record
    $sql = "SELECT FILE FROM book WHERE BID = $id";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $filePath = $row["FILE"];

        // Delete the file from the server
        if (file_exists($filePath)) {
            unlink($filePath); // Deletes the book file from the server
        }

        // Delete the record from the database
        $deleteSql = "DELETE FROM book WHERE BID = $id";
        if ($db->query($deleteSql) === TRUE) {
            $_SESSION["message"] = "Book deleted successfully!";
        } else {
            $_SESSION["message"] = "Error deleting book: " . $db->error;
        }
    } else {
        $_SESSION["message"] = "Book not found!";
    }
}

// Redirect back to the view books page
header("Location: viewbook.php");
exit();
?>
