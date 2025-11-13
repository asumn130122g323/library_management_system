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
    <title>Library Home</title>
    <link rel="stylesheet" href="css/homepage.css">
    <style>
        .banner {
           background: url("images/banner.jpg") no-repeat center center/cover;
           color: rgb(235, 232, 232); /* Default text color */
           text-align: center;
           padding: 100px 0;
           position: relative;
           text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
         }

    </style>
</head>
<body>
    <header>
      <!-- Google Translate Widget -->
      <div id="google_translate_element"></div>
      <script type="text/javascript">
        function googleTranslateElementInit() {
          new google.translate.TranslateElement({
            pageLanguage: 'en',
            includedLanguages: 'en,es,fr,de,it,pt',
            layout: google.translate.TranslateElement.InlineLayout.SIMPLE
          }, 'google_translate_element');
        }
      </script>
      <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

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

<!-- Search Bar -->
<section class="search-bar">
    <input type="text" id="searchInput" placeholder="Search for books, events, or resources...">
    <button onclick="performSearch()">Search</button>
</section>

<!-- Search Results -->
<section id="searchResults"></section>

    <!-- Banner -->
    <section class="banner">
        <h2>Welcome to Our Library</h2>
        <h3>Welcome, <?php echo htmlspecialchars($_SESSION["NAME"]); ?>!</h3>
        <p>Discover books, events, and more!</p>
    </section>

    <!-- Quick Links -->
    <section class="quick-links">
        <a href="translate/translate.php" class="card">Translate</a>
        <a href="events.php" class="card">📅 Events</a>
        <a href="books.php" class="card">📖 Books</a>
        <a href="study-resources.php" class="card">💻 Study Resources</a>
        <a href="audiobooks.php" class="card">📚 Audiobooks</a>
        <a href="trivalquiz.php" class="card">Quiz</a>
        <a href="management.php" class="card">management</a>
    </section>

    <!-- Events Section -->
    <section class="events">
        <h2>Upcoming Events</h2>
        <div class="event">
            <h3>Board of Trustees Meeting</h3>
            <p>January 8, 2025 - 7:00 PM</p>
        </div>
        <div class="event">
            <h3>Book Genre Bingo</h3>
            <p>January 6 - February 28</p>
        </div>
        <div class="event">
            <h3>Kids Craft Kit - Bumble Bee Heart</h3>
            <p>February 1 - February 28</p>
        </div>
        <a href="#">View All Events</a>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-info">
            <p>📍 No:01 Meenabakkam, Chennai, Tamil Nadu, India</p>
            <p>📞 1234567890 | 📧 UchihaeLibrary@gmail.com</p>
            <p>&copy; 2025 Uchiha e-Library. All rights reserved.</p>
        </div>
    </footer>

<script>
// Sample Data (Books, Events, Services)
const data = [
    { type: "event", name: "Board of Trustees Meeting", date: "January 8, 2025" },
    { type: "event", name: "Book Genre Bingo", date: "January 6 - February 28" },
    { type: "event", name: "Kids Craft Kit - Bumble Bee Heart", date: "February 1 - February 28" },
    { type: "book", name: "The Great Gatsby" },
    { type: "book", name: "Harry Potter and the Sorcerer’s Stone" },
    { type: "service", name: "Computer Access" },
    { type: "service", name: "Library Card Registration" }
];

// Function to Perform Search
function performSearch() {
    let input = document.getElementById("searchInput").value.toLowerCase();
    let resultsContainer = document.getElementById("searchResults");
    resultsContainer.innerHTML = ""; // Clear previous results

    if (input.trim() === "") {
        resultsContainer.innerHTML = "<p>Please enter a search term.</p>";
        return;
    }

    let results = data.filter(item => item.name.toLowerCase().includes(input));

    if (results.length === 0) {
        resultsContainer.innerHTML = "<p>No results found.</p>";
        return;
    }

    results.forEach(item => {
        let resultItem = document.createElement("div");
        resultItem.classList.add("result-item");

        // Add item type (event, book, service) and format accordingly
        let type = item.type.charAt(0).toUpperCase() + item.type.slice(1); // Capitalize first letter
        resultItem.innerHTML = `
            <strong>${item.name}</strong> 
            <span class="item-type">(${type})</span>
            ${item.date ? `<p>${item.date}</p>` : ""}`;
        
        resultsContainer.appendChild(resultItem);
    });
}
</script>
</body>
</html>
