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
    <title>Library Services</title>
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

    <!-- Search Bar for Services -->
    <section class="search-bar">
        <input type="text" id="serviceSearchInput" placeholder="Search services...">
        <button onclick="searchServices()">Search</button>
    </section>

    <!-- Services Grid -->
    <section class="services-grid" id="servicesGrid">
        <!-- Services will be dynamically loaded here -->
    </section>

    <footer>
        <p>&copy; 2025 Uchiha e-Library. All rights reserved.</p>
    </footer>

    <script>
       // Sample Service Data
    const services = [
    { name: "Get a Library Card", description: "Sign up for a free library card.", icon: "iconimage/library-card.png" },
    { name: "Use the Computer", description: "Free computer and internet access.", icon: "iconimage/computer.png" },
    { name: "Reserve a Room", description: "Book a study or meeting room.", icon: "iconimage/reserve.png" },
    { name: "Printing & Copying", description: "Print, copy, or scan documents.", icon: "iconimage/printer.png" },
    { name: "E-Books & Audiobooks", description: "Access digital books and audiobooks.", icon: "iconimage/audio-book.png" }
];

// Function to Display Services
function displayServices() {
    let servicesGrid = document.getElementById("servicesGrid");
    servicesGrid.innerHTML = ""; // Clear previous services

    services.forEach(service => {
        let serviceCard = document.createElement("div");
        serviceCard.classList.add("service-card");
        serviceCard.innerHTML = `
            <img src="${service.icon}" alt="${service.name}">
            <h3>${service.name}</h3>
            <p>${service.description}</p>
        `;
        servicesGrid.appendChild(serviceCard);
    });
}
// Function to Search Services
function searchServices() {
    let input = document.getElementById("serviceSearchInput").value.toLowerCase();
    let filteredServices = services.filter(service => service.name.toLowerCase().includes(input));

    let servicesGrid = document.getElementById("servicesGrid");
    servicesGrid.innerHTML = "";

    if (filteredServices.length === 0) {
        servicesGrid.innerHTML = "<p>No services found.</p>";
        return;
    }

    filteredServices.forEach(service => {
        let serviceCard = document.createElement("div");
        serviceCard.classList.add("service-card");
        serviceCard.innerHTML = `
            <img src="${service.icon}" alt="${service.name}">
            <h3>${service.name}</h3>
            <p>${service.description}</p>
        `;
        servicesGrid.appendChild(serviceCard);
    });
}

// Load All Services on Page Load
window.onload = () => displayServices();
    </script>
</body>
</html>
