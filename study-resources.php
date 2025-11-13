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
    <title>Study Resources - E-Books</title>
    <link rel="stylesheet" href="css\study-resources.css">
</head>
<body>
    <header>
        <h1>Study Resources - E-Books</h1>
        <!-- Back to Index Link -->
        <a href="homepage.php" class="back-to-index">Back to Homepage</a>
        <input type="text" id="search" placeholder="Search e-books..." onkeyup="filterBooks()">
    </header>
    
    <section id="ebooks">
        <div class="ebook" data-title="Introduction to HTML">
            <img src="images/html.jpg" alt="Introduction to HTML">
            <h2>Introduction to HTML</h2>
            <p>A beginner's guide to HTML5.</p>
            <a href="studymaterial/html_tutorial.pdf" download>Download</a>
        </div>
        <div class="ebook" data-title="CSS Design Patterns">
            <img src="images/css3 design pattern.jpg" alt="CSS Design Patterns">
            <h2>CSS Design Patterns</h2>
            <p>Learn how to style websites effectively.</p>
            <a href="studymaterial/Pro HTML5 and CSS3 Design Patterns.pdf" download>Download</a>
        </div>
        <div class="ebook" data-title="JavaScript Essentials">
            <img src="images/javascript.jpg" alt="JavaScript Essentials">
            <h2>JavaScript Essentials</h2>
            <p>Master the fundamentals of JavaScript.</p>
            <a href="studymaterial/javascript_tutorial.pdf" download>Download</a>
        </div>
        <div class="ebook" data-title="Python for Beginners">
            <img src="images/python.jpg" alt="Python for Beginners">
            <h2>Python for Beginners</h2>
            <p>An introductory guide to Python programming.</p>
            <a href="studymaterial/Python Programming.pdf" download>Download</a>
        </div>
        <div class="ebook" data-title="Data Structures & Algorithms">
            <img src="images/datastructure&algorithm.jpg" alt="Data Structures & Algorithms">
            <h2>Data Structures & Algorithms</h2>
            <p>Understand fundamental DSA concepts.</p>
            <a href="studymaterial/Data Structures and Algorithms.pdf" download>Download</a>
        </div>
        <div class="ebook" data-title="Machine Learning Basics">
            <img src="images/machinelearning.jpg" alt="Machine Learning Basics">
            <h2>Machine Learning Basics</h2>
            <p>Get started with machine learning.</p>
            <a href="studymaterial/MachinelearningBasicsBook.pdf" download>Download</a>
        </div>
        <div class="ebook" data-title="Web Development with React">
            <img src="images/webreact.jpg" alt="Web Development with React">
            <h2>Web Development with React</h2>
            <p>Learn how to build modern web apps with React.</p>
            <a href="studymaterial/webdevelopment-react.pdf" download>Download</a>
        </div>
        <div class="ebook" data-title="Cybersecurity Fundamentals">
            <img src="images/cybersecurity.jpg" alt="Cybersecurity Fundamentals">
            <h2>Cybersecurity Fundamentals</h2>
            <p>Learn the basics of cybersecurity and protection.</p>
            <a href="studymaterial/Cybersecurity Essentials.pdf" download>Download</a>
        </div>
        <div class="ebook" data-title="Cloud Computing Essentials">
            <img src="images/cloud.jpg" alt="Cloud Computing Essentials">
            <h2>Cloud Computing Essentials</h2>
            <p>Understand cloud computing concepts.</p>
            <a href="studymaterial/Essentials of cloud computing (2015).pdf" download>Download</a>
        </div>
        <div class="ebook" data-title="Artificial Intelligence Guide">
            <img src="images/ai.jpg" alt="Artificial Intelligence Guide">
            <h2>Artificial Intelligence Guide</h2>
            <p>An overview of artificial intelligence fundamentals.</p>
            <a href="studymaterial/artificial_intelligence_tutorial.pdf" download>Download</a>
        </div>
    </section>
    <footer>
        <p>&copy; 2025 Uchiha e-Library. All rights reserved.</p>
    </footer>
    <script>
        function filterBooks() {
            let input = document.getElementById("search").value.toLowerCase();
            let books = document.querySelectorAll(".ebook");
            
            books.forEach(book => {
                let title = book.getAttribute("data-title").toLowerCase();
                book.style.display = title.includes(input) ? "block" : "none";
            });
        }
    </script>
</body>
</html>
