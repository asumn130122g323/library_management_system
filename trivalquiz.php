<?php
session_start(); // Start session
include "adminpage/database/database.php"; // Ensure correct database connection

// Redirect if user is not logged in
if (!isset($_SESSION["ID"])) {
    header("Location: index.php");
    exit(); // Stop script execution
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Trivia Quiz</title>
    <link rel="stylesheet" href="games\Trivia Quiz.css">
</head>
<body>
    <header>
        <h1>Library Trivia Quiz</h1>
         <!-- Back to Index Link -->
         <a href="homepage.php" class="back-to-index">Back to Homepage</a>
    </header>
    <section>
    <div class="quiz-container">
        <h1>Library Trivia Quiz</h1>
        <div id="quiz" class="quiz">
            <!-- Questions will be inserted here dynamically -->
        </div>
        <button onclick="submitQuiz()">Submit Answers</button>
        <div id="result"></div>
        <!-- Restart Button (hidden initially) -->
        <button id="restartButton" onclick="restartGame()" style="display:none;">Restart Game</button>
    </div>
    </section>
    <footer>
        <p>&copy; 2025 Uchiha e-Library. All rights reserved.</p>
    </footer>
    <script src="games/Trivia Quiz.js"></script>
</body>
</html>
