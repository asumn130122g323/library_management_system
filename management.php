<?php
session_start();
include "adminpage/database/database.php"; // Ensure correct database connection

// Redirect to login if the admin is NOT logged in
if (!isset($_SESSION["ID"])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management</title>
    <!-- <link rel="stylesheet" href="css/managenav.css"> -->
    <!-- <link rel="stylesheet" href="css/mangement.css"> -->
    <style>
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
/* management */
/* Header and Title Styling */
header, h1 {
    color: #fff;
    text-align: center;
    margin-top: 20px;
}

/* ---------------- Search Bar Styling ---------------- */
/* Search bar container */
/* Centering search container */
.search-container {
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 20px auto;
    width: 100%;
}

/* Styling form inside search container */
.search-container form {
    display: flex;
    align-items: center;
    gap: 10px; /* Space between input and button */
}

/* Search input field */
.search-input {
    width: 60%;
    max-width: 400px;
    padding: 12px 15px;
    font-size: 16px;
    border: 2px solid #0077cc;
    border-radius: 5px;
    background-color: #fff;
    color: #000;
    transition: border-color 0.3s ease-in-out;
}

/* Input focus effect */
.search-input:focus {
    border-color: #00aaff;
    outline: none;
}

/* Search button styling */
.search-button {
    padding: 12px 20px;
    font-size: 16px;
    background-color: #005bb5;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

/* Button hover effect */
.search-button:hover {
    background-color: #0077cc;
}


/* ---------------- Table Styling ---------------- */
table {
    width: 90%;
    margin: 20px auto;
    border-collapse: collapse;
    background-color: #333;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    border-radius: 8px;
    overflow: hidden;
}

/* Table Header */
th {
    background-color: #005bb5; /* Blue header */
    color: white;
    padding: 12px;
    text-align: left;
    font-size: 16px;
}

/* Table Rows */
td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #555;
}

/* Align text in specific columns */
td:nth-child(1), td:nth-child(4), td:nth-child(5) {
    text-align: center;
}

/* Table Hover Effect */
tr:hover {
    background-color: #444;
}

/* Alternate Row Coloring */
tr:nth-child(even) {
    background-color: #383838;
}

/* Ensure Border Consistency */
table {
    border: 1px solid #444;
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
                                                                                                                                                                                                                                                     
    <main class="upload-container">
        <h2>Search Book</h2>
        <div class="search-container">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <input type="text" name="name" class="search-input" placeholder="Search by title or keywords" required>
        <button type="submit" name="submit" class="search-button">Search</button>
    </form>
</div>

<?php
// Ensure database connection is established
if (!isset($db)) {
    die("<p class='error'>Database connection error.</p>");
}

if (isset($_POST["submit"])) {
    // Sanitize user input
    $searchTerm = trim($_POST["name"]);
    $searchTerm = htmlspecialchars($searchTerm, ENT_QUOTES, 'UTF-8');

    // Prepare SQL query
    $sql = "SELECT * FROM book WHERE BTITLE LIKE ? OR keywords LIKE ?";
    if ($stmt = $db->prepare($sql)) {
        $likeTerm = "%{$searchTerm}%";
        $stmt->bind_param("ss", $likeTerm, $likeTerm);

        // Execute and check for errors
        if ($stmt->execute()) {
            $res = $stmt->get_result();

            if ($res->num_rows > 0) {
                echo "<table>
                        <tr>
                            <th>SNO</th>
                            <th>TITLE</th>
                            <th>KEYWORDS</th>
                            <th>VIEW</th>
                            <th>COMMENT</th>
                        </tr>";

                $i = 0;
                while ($row = $res->fetch_assoc()) {
                    $i++;

                    // Ensure the file path is correct
                    $filePath = htmlspecialchars($row["FILE"], ENT_QUOTES, 'UTF-8');
                    $absolutePath = "/library_management_system/books/" . basename($filePath);

                    echo "<tr>";
                    echo "<td>{$i}</td>";
                    echo "<td>" . htmlspecialchars($row["BTITLE"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["KEYWORDS"]) . "</td>";
                    echo "<td><a href='{$absolutePath}' target='_blank'>View</a></td>";
                    echo "<td><a href='comment.php?id={$row["BID"]}'>Comment</a></td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p class='error'>No book records found</p>";
            }
        } else {
            echo "<p class='error'>Error executing search query.</p>";
        }
    } else {
        echo "<p class='error'>Error preparing search query.</p>";
    }
}
?>

    </main>
    
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
