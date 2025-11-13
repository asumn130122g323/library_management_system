<?php
session_start();
include "database/database.php";

// Ensure admin is logged in
if (!isset($_SESSION["AID"])) {
    echo "Unauthorized access!";
    exit();
}

// Check if form data exists
if (!isset($_POST["bookId"])) {
    echo "Invalid Request!";
    exit();
}

$id = intval($_POST["bookId"]);
$title = $db->real_escape_string($_POST["bname"]);
$keywords = $db->real_escape_string($_POST["keys"]);

// Fetch current book details
$sql = "SELECT FILE FROM book WHERE BID = $id";
$result = $db->query($sql);
if ($result->num_rows == 0) {
    echo "Book not found!";
    exit();
}

$row = $result->fetch_assoc();
$oldFilePath = $row["FILE"];

// Handle File Upload (if a new file is selected)
$target_dir = "../books/";
$target_file = $oldFilePath; // Default to old file if no new file is uploaded

if (!empty($_FILES["efile"]["name"])) {
    $target_file = $target_dir . basename($_FILES["efile"]["name"]);

    if (move_uploaded_file($_FILES["efile"]["tmp_name"], $target_file)) {
        if (file_exists($oldFilePath)) {
            unlink($oldFilePath);
        }
    } else {
        echo "Error uploading new file!";
        exit();
    }
}

// Update Database
$updateSql = "UPDATE book SET BTITLE='$title', KEYWORDS='$keywords', FILE='$target_file' WHERE BID = $id";

if ($db->query($updateSql) === TRUE) {
    echo "Book details updated successfully!";
} else {
    echo "Error updating book: " . $db->error;
}
?>
