<?php
session_start();
include "adminpage/database/database.php"; // Ensure correct database connection

// Redirect to login if the admin is NOT logged in
if (!isset($_SESSION["ID"])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/managenav.css">
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
    padding: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh; 
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
        /* requestbook */
/* Form Styling */
/* Center the form */
/* Center the request form */
form {
    width: 90%;
    max-width: 450px;
    background: rgba(0, 0, 0, 0.4); /* Dark glassmorphism */
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.3);
    backdrop-filter: blur(8px);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin: auto; /* Centering */
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%); /* Perfect centering */
}

/* Title Styling */
h2 {
    text-align: center;
    color: white;
    font-size: 1.7em;
    background: rgba(0, 0, 0, 0.5);
    padding: 12px 15px;
    border-radius: 10px;
    width: max-content;
    margin-bottom: 20px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.3);
}

/* Input & Textarea */
input[type="text"],
textarea {
    width: 100%;
    padding: 12px;
    margin: 10px 0;
    border: none;
    background: rgba(255, 255, 255, 0.2);
    color: white;
    font-size: 1em;
    border-radius: 6px;
    text-align: center;
}

/* Textarea Adjustments */
textarea {
    height: 100px;
    resize: none;
}

/* Button Styling */
button[type="submit"] {
    width: 100%;
    padding: 12px;
    background: rgba(6, 71, 212, 0.5);
    color: white;
    border: 1px solid white;
    border-radius: 6px;
    font-size: 1.1em;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
    margin-top: 15px;
}

button[type="submit"]:hover {
    background: rgba(2, 19, 255, 0.5)
    transform: scale(1.05);
}

/* Responsive Fixes */
@media (max-width: 768px) {
    form {
        width: 95%;
        padding: 15px;
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
    <main>
    <h2>Add Book Request</h2>
    <?php
       if(isset($_POST["submit"])){
        $sql="insert into request (ID,MESS,LOGS) values({$_SESSION["ID"]},'{$_POST["mess"]}',now())";
        $db->query($sql);
        echo"<p class='success'>request sended </p>";
        }
       
    ?>
    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
        <label for="message">Message</label><br>
        <textarea required name="mess"></textarea><br>
        <button type="submit" name="submit">Request to admin</button>
    </form>
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
