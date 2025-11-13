<?php 
session_start();
include "adminpage/database/database.php"; // Ensure correct database connection

// Redirect to login if the user is NOT logged in
if (!isset($_SESSION["ID"])) {
    header("Location: login.php");
    exit();
}

// Validate that 'id' is set in GET request
if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    die("<p class='error'>Invalid book ID.</p>");
}

$book_id = intval($_GET["id"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management</title>
    <!-- <link rel="stylesheet" href="css/managenav.css"> -->
    <link rel="stylesheet" href="css/mangement.css">
    <style>
        /* Import Fonts and Icons */
 /* Import Fonts and Icons */
@import url('https://fonts.googleapis.com/css2?family=Baloo+Bhai+2:wght@400&display=swap');
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.css');

/* Global Styling */
body {
    font-family: "Baloo Bhai 2", Arial, sans-serif;
    background: url("./images/alogin.jpg") no-repeat center center/cover;
    color: white;
    text-align: center;
    min-height: 100vh;
    margin: 0;
    padding: 0;
}

/* Sidebar Styling */
:root {
    --menu-width: 300px;
    --collapsed-width: 60px;
}

aside {
    position: fixed;
    top: 0;
    left: 0;
    width: var(--menu-width);
    min-height: 100vh;
    background: linear-gradient(0deg, black, #1f314b);
    color: white;
    transition: width 0.3s;
    box-shadow: 0px 0px 15px 0px rgba(0, 0, 0, 0.45);
    z-index: 10;
    padding: 10px;
}

.collapsed aside {
    width: var(--collapsed-width);
}

/* Sidebar Menu Button */
.menu-btn {
  color: white;
  position: absolute;
  top: 20px;
  right: 0;
  padding: 8px;
  border: none;
  font-size: 15px;
  aspect-ratio: 1;
  border-radius: 0 50% 50% 0;
  cursor: pointer;
  transform: translateX(100%);
  box-shadow: 2px 0px 5px 0px #1a1a1a;
  background: #1b2b42;
  transition: background 0.3s;
}

.menu-btn:hover {
    background: #263d5b;
}

/* Sidebar Logo and Items */
.logo-wrapper {
  display: flex;
  overflow: hidden;
  white-space: nowrap;
  align-items: center;
  gap: 15px;
  padding: 10px;
  overflow: hidden;
}

.brand-name {
    font-size: 20px;
    transition: 0.3s;
}

.collapsed .brand-name {
    width: 0;
    visibility: hidden;
    transition-delay: 0.3s;
}

/* Sidebar Menu Items */
.menu-items {
    margin-top: 15px;
}

.menu-items a {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 10px;
    margin-bottom: 10px;
    color: white;
    text-decoration: none;
    transition: background 0.3s;
    border-radius: 10px;
}
ul {
  list-style: none;
  color:#161616;
}
.menu-items a:hover {
    background: rgba(0, 0, 0, 0.1);
    color: #daddff;
}
.menu-items a {
  display: flex;
  align-items: center;
  gap: 15px;
  padding: 10px;
  margin-bottom: 10px;
  overflow: hidden;
}

.menu-items a:hover {
  color: #daddff;
  background: #00000017;
  border-radius: 10px;
}

.menu-items li {
  position: relative;
}

.icon {
  font-size: 20px;
}

/* Tooltip for Collapsed Menu */
.tooltip {
    position: absolute;
    right: -50px;
    top: 50%;
    background: rgb(22, 22, 22);
    color: white;
    padding: 5px 15px;
    font-size: 15px;
    border-radius: 5px;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.3s;
    transform: translate(100%, -50%);
}

.collapsed .menu-items a:hover + .tooltip {
    visibility: visible;
    opacity: 1;
}

/* Main Content Area */
main {
    position: relative;
    left: var(--menu-width);
    width: calc(100% - var(--menu-width));
    transition: left 0.3s, width 0.3s;
    padding: 20px;
}

.collapsed main {
    left: var(--collapsed-width);
    width: calc(100% - var(--collapsed-width));
}

/* View Links */
a {
    color: #4db8ff;
    text-decoration: none;
    font-weight: bold;
}

/* Table Styling */
table {
    margin: 20px auto;
    border-collapse: collapse;
    width: 60%;
    background: rgba(46, 46, 46, 0.8);
    box-shadow: 0px 6px 12px rgba(255, 255, 255, 0.1);
    border-radius: 12px;
    overflow: hidden;
    backdrop-filter: blur(8px);
}

table th, table td {
    padding: 15px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    text-align: left;
    color: white;
}

table th {
    background: rgba(68, 68, 68, 0.8);
    font-weight: bold;
}

table tr:nth-child(even) {
    background: rgba(58, 58, 58, 0.8);
}

table tr:hover {
    background: rgba(255, 255, 255, 0.1);
}

/* Comment Section */
.comment-section {
    background: rgba(46, 46, 46, 0.85);
    backdrop-filter: blur(8px);
    color: white;
    max-height: 300px;
    overflow-y: auto;
}

.comment-section p {
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    padding: 10px 0;
}

.comment-section strong {
    color: rgba(26, 188, 156, 0.8);
}

/* Responsive Fixes */
@media (max-width: 768px) {
    .upload-container {
        margin-left: 0;
        width: 100%;
    }

    table, form, .comment-section {
        width: 90%;
    }
}

    </style>
</head>
<body>
    <aside>
        <button class="menu-btn fa fa-chevron-left"></button>
        <a href="/" class="logo-wrapper">
            <span class="fa-brands fa-uikit"></span>
            <span class="brand-name">E-Management</span>
        </a>
        <div class="separator"></div>
        <ul class="menu-items">
            <li><a href="management.php"><span class="icon fa fa-layer-group"></span><span class="item-name">Search Books</span></a></li>
            <li><a href="requestbook.php"><span class="icon fa fa-chart-line"></span><span class="item-name">Request for Books</span></a></li>
            <li><a href="uchangepw.php"><span class="icon fa fa-gear"></span><span class="item-name">Change Password</span></a></li>
            <li><a href="homepage.php"><span class="icon fa fa-home"></span><span class="item-name">Return to Homepage</span></a></li>
        </ul>
    </aside>

    <div class="upload-container">
        <h2>Comment your review</h2>
        <?php
        // Fetch book details safely
        $sql = "SELECT * FROM book WHERE BID = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $book_id);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows > 0) {
            echo "<table>";
            $row = $res->fetch_assoc();
            echo "<tr><th>Book Name</th><td>{$row['BTITLE']}</td></tr>
                  <tr><th>Keywords</th><td>{$row['KEYWORDS']}</td></tr>";
            echo "</table>";
        } else {
            echo "<p class='error'>No books found</p>";
        }
        ?>

        <!-- Comment Form -->
        <div>
            <form method="post" action="post_comment.php">
                <label for="comment">Your comments:</label>
                <textarea name="mess" id="comment" required></textarea>
                <input type="hidden" name="book_id" value="<?php echo $book_id; ?>">
                <button type="submit" name="submit">Post Now</button>
            </form>
        </div>

        <!-- Display Comments -->
        <?php
        $sql = "SELECT student.NAME, comment.COMM, comment.LOGS 
                FROM comment 
                INNER JOIN student ON comment.SID = student.ID 
                WHERE comment.BID = ? 
                ORDER BY comment.CID DESC";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $book_id);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                echo "<p><strong>{$row["NAME"]}</strong> {$row["COMM"]} <i>{$row["LOGS"]}</i></p>";
            }
        } else {
            echo "<p>No comments yet</p>";
        }
        ?>
    </div>

    <script>
        const menuBtn = document.querySelector(".menu-btn");
        menuBtn.addEventListener("click", (e) => {
            document.body.classList.toggle("collapsed");
            e.currentTarget.classList.toggle("fa-chevron-right");
            e.currentTarget.classList.toggle("fa-chevron-left");
        });
    </script>
</body>
</html>
