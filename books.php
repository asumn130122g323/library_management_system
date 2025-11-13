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
    <title>Books & Media</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Corrected path with forward slashes -->
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

    <!-- Search Bar for Books -->
    <section class="search-bar">
        <input type="text" id="bookSearchInput" placeholder="Search for books...">
        <button onclick="searchBooks()">Search</button>
    </section>

    <!-- Book Categories -->
    <section class="categories">
        <button onclick="filterBooks('all')">All</button>
        <button onclick="filterBooks('fiction')">Fiction</button>
        <button onclick="filterBooks('non-fiction')">Non-Fiction</button>
        <button onclick="filterBooks('kids')">Kids</button>
    </section>

    <!-- Books Grid -->
    <section class="books-grid" id="booksGrid">
        <!-- Books will be dynamically loaded here -->
    </section>

    <footer>
        <p>&copy;2025 SJS E_Library. All rights reserved.</p>
    </footer>

    <script>
    const books = [
        { 
            title: "The Great Gatsby", 
            author: "F. Scott Fitzgerald", 
            category: "fiction", 
            image: "images/gatsby.jpg",  <!-- Corrected path -->
            pdf: "books/gatsby.pdf",  <!-- Corrected path -->
            description: "A novel set in the Roaring Twenties, exploring themes of wealth and society." 
        },
        { 
            title: "Light From Many Lamps", 
            author: "Lillian Watson", 
            category: "non-fiction", 
            image: "images/light.jpg",  <!-- Corrected path -->
            pdf: "books/Lillian Watson - Light From Many Lamps-Touchstone (1988).pdf",  <!-- Corrected path -->
            description: "A collection of inspirational stories and lessons for daily life." 
        },
        { 
            title: "Harry Potter", 
            author: "J.K. Rowling", 
            category: "kids", 
            image: "images/harrypotter.jpg",  <!-- Corrected path -->
            pdf: "books/Harry Potter The complete Collection.pdf",  <!-- Corrected path -->
            description: "The magical journey of Harry Potter and his adventures at Hogwarts." 
        },
        { 
            title: "Sapiens", 
            author: "Yuval Noah Harari", 
            category: "non-fiction", 
            image: "images/sapiens.jpg",  <!-- Corrected path -->
            pdf: "books/Sapiens-A-Brief-History-of-Humankind.pdf",  <!-- Corrected path -->
            description: "A fascinating exploration of human history and evolution." 
        }
    ];
    
    // Function to Display Books with Flip Effect
    function displayBooks(filter = "all") {
        let booksGrid = document.getElementById("booksGrid");
        booksGrid.innerHTML = "";
    
        let filteredBooks = filter === "all" ? books : books.filter(book => book.category === filter);
    
        filteredBooks.forEach((book, index) => {
            let bookCard = document.createElement("div");
            bookCard.classList.add("book-card");
            bookCard.innerHTML = `
                <div class="book-inner">
                    <!-- Front Side -->
                    <div class="book-front">
                        <img src="${book.image}" alt="${book.title}" style="width: 100%; height: 150px; object-fit: cover;">
                        <h3>${book.title}</h3>
                        <p>by ${book.author}</p>
                        <a href="${book.pdf}" target="_blank" class="pdf-link">Download PDF</a>
                        <button class="flip-button" onclick="flipBook(${index})">More Info</button>
                    </div>
    
                    <!-- Back Side -->
                    <div class="book-back">
                        <h3>${book.title}</h3>
                        <p>${book.description}</p>
                        <button class="flip-button" onclick="flipBook(${index})">Go Back</button>
                    </div>
                </div>
            `;
            bookCard.setAttribute("id", `book-${index}`);
            booksGrid.appendChild(bookCard);
        });
    }
    
    // Function to Flip the Book Card
    function flipBook(index) {
        let bookCard = document.getElementById(`book-${index}`);
        bookCard.classList.toggle("flipped");
    }
    
    // Function to Search Books
    function searchBooks() {
        let input = document.getElementById("bookSearchInput").value.toLowerCase();
        let filteredBooks = books.filter(book => book.title.toLowerCase().includes(input));
    
        let booksGrid = document.getElementById("booksGrid");
        booksGrid.innerHTML = "";
    
        if (filteredBooks.length === 0) {
            booksGrid.innerHTML = "<p>No books found.</p>";
            return;
        }
    
        filteredBooks.forEach((book, index) => {
            let bookCard = document.createElement("div");
            bookCard.classList.add("book-card");
            bookCard.innerHTML = `
                <div class="book-inner">
                    <div class="book-front">
                        <img src="${book.image}" alt="${book.title}" style="width: 100%; height: 150px; object-fit: cover;">
                        <h3>${book.title}</h3>
                        <p>by ${book.author}</p>
                        <a href="${book.pdf}" target="_blank" class="pdf-link">Download PDF</a>
                        <button class="flip-button" onclick="flipBook(${index})">More Info</button>
                    </div>
                    <div class="book-back">
                        <h3>${book.title}</h3>
                        <p>${book.description}</p>
                        <button class="flip-button" onclick="flipBook(${index})">Go Back</button>
                    </div>
                </div>
            `;
            bookCard.setAttribute("id", `book-${index}`);
            booksGrid.appendChild(bookCard);
        });
    }
    
    // Function to Filter Books by Category
    function filterBooks(category) {
        displayBooks(category);
    }
    
    // Load All Books on Page Load
    window.onload = () => displayBooks("all");
    </script>
</body>
</html>
