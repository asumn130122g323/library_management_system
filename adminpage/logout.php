<?php
session_start();

// Destroy session and clear session variables
unset($_SESSION["AID"]);
unset($_SESSION["ID"]);
session_destroy();

// Redirect to index.php after logging out
header("Location: index.php");
exit();  // Stop further execution
?>