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
    <title>Study Resources - Audiobooks</title>
    <link rel="stylesheet" href="css/audiobooks.css">
</head>
<body>
    <header>
        <h1>Study Resources - Audiobooks</h1>
        <a href="homepage.php" class="back-to-index">Back to Homepage</a>
        <input type="text" id="search" placeholder="Search audiobooks..." onkeyup="filterAudiobooks()">
    </header>

    <section id="audiobooks">
        <!-- The Jungle Book -->
        <div class="audiobook" data-title="The Jungle Book Rudyard Kipling">
            <div class="flip-card">
                <div class="flip-card-inner">
                    <!-- Front Side -->
                    <div class="flip-card-front">
                        <img src="images/Jungle_Book_1003.jpg" alt="The Jungle Book">
                        <h2>The Jungle Book</h2>
                    </div>
                    <!-- Back Side -->
                    <div class="flip-card-back">
                        <h3>The Jungle Book</h3>
                        <p>by Rudyard Kipling (1865 - 1936)</p>
                        <p>A collection of fables using animals to teach moral lessons.</p>
                        <audio controls>
                            <source src="audiobooks/jungle book.mp3" type="audio/mpeg">
                        </audio>
                        <a href="audiobooks/jungle book.mp3" download>Download</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Snow White -->
        <div class="audiobook" data-title="Snow White and the Seven Dwarfs">
            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img src="images/snow white.jpg" alt="Snow White">
                        <h2>Snow White</h2>
                    </div>
                    <div class="flip-card-back">
                        <h3>Snow White and the Seven Dwarfs</h3>
                        <p>by Jessie Braham White</p>
                        <p>A classic fairy tale about a princess, an evil queen, and seven dwarfs.</p>
                        <audio controls>
                            <source src="audiobooks/snow white.mp3" type="audio/mpeg">
                        </audio>
                        <a href="audiobooks/snow white.mp3" download>Download</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Power of Concentration -->
        <div class="audiobook" data-title="Power of Concentration">
            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img src="images/powerofconcentration.jpg" alt="Power of Concentration">
                        <h2>Power of Concentration</h2>
                    </div>
                    <div class="flip-card-back">
                        <h3>Power of Concentration</h3>
                        <p>by William Walker Atkinson</p>
                        <p>A guide to strengthening focus and mental discipline.</p>
                        <audio controls>
                            <source src="audiobooks/powerofconcentration.mp3" type="audio/mpeg">
                        </audio>
                        <a href="audiobooks/powerofconcentration.mp3" download>Download</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2025 Uchiha e-Library. All rights reserved.</p>
    </footer>

    <script>
        let debounceTimer;
        function filterAudiobooks() {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                let input = document.getElementById("search").value.toLowerCase();
                let books = document.querySelectorAll(".audiobook");

                books.forEach(book => {
                    let title = book.getAttribute("data-title").toLowerCase();
                    book.style.display = title.includes(input) ? "block" : "none";
                });
            }, 300);
        }
    </script>
</body>
</html>
