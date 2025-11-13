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
    <title>Library Events</title>
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
                <li><a href="logout.php"><span class="icon fa fa-sign-out-alt"></span><span class="item-name">Logout</span></a></li>
            </ul>
        </nav>
    </header>

    <!-- Search Bar for Events -->
    <section class="search-bar">
        <input type="text" id="eventSearchInput" placeholder="Search events...">
        <button onclick="searchEvents()">Search</button>
    </section>

    <!-- Event Categories -->
    <section class="categories">
        <button onclick="filterEvents('all')">All</button>
        <button onclick="filterEvents('kids')">Kids</button>
        <button onclick="filterEvents('adult')">Adult</button>
        <button onclick="filterEvents('research')">Research</button>
    </section>

    <!-- Events List -->
    <section class="events-list" id="eventsList">
        <!-- Events will be dynamically loaded here -->
    </section>

    <footer>
        <p>&copy; 2025 Uchiha e-Library. All rights reserved.</p>
    </footer>

<script>
// Sample Event Data
    const events = [
    { title: "Board of Trustees Meeting", date: "January 8, 2025 - 7:00 PM", category: "adult", description: "Discuss library policies and developments." },
    { title: "Book Genre Bingo", date: "January 6 - February 28", category: "kids", description: "Join a fun reading challenge for kids!" },
    { title: "Kids Craft Kit - Bumble Bee Heart", date: "February 1 - February 28", category: "kids", description: "Pick up a craft kit to make at home." },
    { title: "Genealogy Research Workshop", date: "March 10, 2025 - 5:00 PM", category: "research", description: "Learn how to trace your family history." }
];

// Function to Display Events
function displayEvents(filter = "all") {
    let eventsList = document.getElementById("eventsList");
    eventsList.innerHTML = ""; // Clear previous events

    let filteredEvents = filter === "all" ? events : events.filter(event => event.category === filter);

    filteredEvents.forEach(event => {
        let eventCard = document.createElement("div");
        eventCard.classList.add("event-card");
        eventCard.innerHTML = `
            <h3>${event.title}</h3>
            <p><strong>Date:</strong> ${event.date}</p>
            <p>${event.description}</p>
        `;
        eventsList.appendChild(eventCard);
    });
}

// Function to Search Events
function searchEvents() {
    let input = document.getElementById("eventSearchInput").value.toLowerCase();
    let filteredEvents = events.filter(event => event.title.toLowerCase().includes(input));

    let eventsList = document.getElementById("eventsList");
    eventsList.innerHTML = "";

    if (filteredEvents.length === 0) {
        eventsList.innerHTML = "<p>No events found.</p>";
        return;
    }

    filteredEvents.forEach(event => {
        let eventCard = document.createElement("div");
        eventCard.classList.add("event-card");
        eventCard.innerHTML = `
            <h3>${event.title}</h3>
            <p><strong>Date:</strong> ${event.date}</p>
            <p>${event.description}</p>
        `;
        eventsList.appendChild(eventCard);
    });
}

// Function to Filter Events by Category
function filterEvents(category) {
    displayEvents(category);
}

// Load All Events on Page Load
window.onload = () => displayEvents("all");

    </script>
</body>
</html>
