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
    <title>Research | Uchiha e-Library</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Link to your external CSS -->
</head>
<body>

    <!-- Header Section -->
    <header>
        <div class="logo">
            <h1>E-Library</h1>
        </div>
        <nav>
            <ul>
                <li><a href="homepage.php">Home</a></li>
                <li><a href="events.php">Events</a></li>
                <li><a href="books.php">Books & Media</a></li>
                <li><a href="services.php">Services</a></li>
                <li><a href="research.php">Research</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="logout.php"><span class="icon fa fa-sign-out-alt"></span><span class="item-name">Logout</span></a></li>
            </ul>
        </nav>
    </header>

    <!-- Research Content Section -->
    <section class="research">
        <h2>Research Resources</h2>
        <p>Welcome to the Research section of our library. Here, you will find valuable resources for your academic and personal research needs.</p>

        <!-- Research Categories -->
        <div class="research-categories">
            <div class="category-card">
                <h3>Databases</h3>
                <p>Access a variety of research databases for academic journals, articles, and reports.</p>
                <a href="#">Learn More</a>
            </div>
            <div class="category-card">
                <h3>eBooks</h3>
                <p>Browse through thousands of eBooks across different subjects for your research needs.</p>
                <a href="#">Explore eBooks</a>
            </div>
            <div class="category-card">
                <h3>Research Guides</h3>
                <p>Get started with your research using our detailed guides and tips for each subject.</p>
                <a href="#">See Guides</a>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer>
        <p>📍 No:01 meenabakkam, chennai,tamilnade,india</p>
        <p>📞1234567890| 📧 sjselibrary.com</p>
        <p>&copy; 2025 Uchiha e-Library. All rights reserved.</p>
    </footer>

</body>
</html>
