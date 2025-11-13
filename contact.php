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
    <title>Contact Us</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
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
                <li><a href="contact.php">Contact</a></li>
                <li><a href="logout.php"><span class="icon fa fa-sign-out-alt"></span><span class="item-name">Logout</span></a></li>
            </ul>
        </nav>
    </header>

    <section class="contact-section">
        <h2>Contact Us</h2>
        <form action="contact.php" method="POST" class="contact-form">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        
            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="4" required></textarea>
        
            <button type="submit">Send Message</button>
        </form>
        

        <div class="contact-info">
            <p><strong>Phone:</strong> (123) 456-7890</p>
            <p><strong>Email:</strong>UchihaeLibrary@gmail.com</p>
            <p><strong>Address:</strong> No:01 meenabakkam, chennai,tamilnade,india</p>
        </div>

        <div class="map-section">
            <h3>Find Us</h3>
            <!-- Embed Google Maps or another map provider here -->
            <iframe src="https://www.google.com/maps/embed?pb=..." width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </section>

    <footer>
        <p>&copy; 2025 SJS E_Library. All rights reserved.</p>
    </footer>
</body>
</html>
