<?php
$db = new mysqli("localhost", "root", "", "library_management_system");

// Check for connection errors
if ($db->connect_error) {
    die("Database connection failed: " . $db->connect_error);
}
?>

