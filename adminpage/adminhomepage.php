<?php
session_start();
include "database/database.php"; // Ensure correct database connection

// Redirect to login if the admin is NOT logged in
if (!isset($_SESSION["AID"])) {
    header("Location: index.php");
    exit();
}

// Function to count records in the database
function countRecord($sql, $db) {
    $res = $db->query($sql);
    return $res->num_rows; // ✅ Fixed typo (num_rows)
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Book</title>
    <!-- <link rel="stylesheet" href="../css/managenav.css">
    <link rel="stylesheet" href="../css/upload.css"> -->
</head>
<style>
    /* manage nav css */
/* Import Fonts and Icons */
@import url('https://fonts.googleapis.com/css2?family=Baloo+Bhai+2:wght@400&display=swap');
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.css');

/* Global Styling */
body {
    font-family: "Baloo Bhai 2", Arial, sans-serif;
    background: url("../images/alogin.jpg") no-repeat center center fixed;
    background-size: cover;
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

/* upload.css */
.upload-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    position: absolute;
    top: 800%;
    left: 40%;
    transform: translate(-50%, -50%);
    text-align: center;
    width: 100%;
}


.upload-form {
    background: rgba(50, 50, 50, 0.7); /* Reduced opacity for a transparent effect */
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    width: 90%;
    max-width: 400px; /* Slightly wider for better input visibility */
    box-sizing: border-box;
    backdrop-filter: blur(8px); /* Soft blur effect */
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.upload-form label {
    display: block;
    margin-top: 10px;
    font-weight: bold;
    color: #ffffff;
    text-align: left;
}

.upload-form input,
.upload-form textarea {
    width: calc(100% - 16px);
    padding: 8px;
    margin-top: 5px;
    border: 1px solid #777;
    border-radius: 5px;
    background: #333;
    color: #fff;
    display: block;
}

.upload-form input::placeholder,
.upload-form textarea::placeholder {
    color: #bbb;
}

.upload-form button {
    margin-top: 15px;
    padding: 10px;
    width: 100%;
    border: none;
    background:rgb(6, 176, 206);
    color: white;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
}

.upload-form button:hover {
    background:rgb(5, 144, 168);
}

.success-message {
    color: #4CAF50;
    font-weight: bold;
    margin-bottom: 15px;
}
/* Statistics Container */
/* Statistics Container */
.stats-container {
    position: absolute;
    top: 20px;
    right: 100px;
    width: 200px; /* Small square size */
    background: rgba(0, 0, 0, 0.7);
    border-radius: 10px;
    padding: 15px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
    text-align: center;
}

/* Statistics List */
.stats-container ul {
    padding: 0;
    margin: 0;
    list-style: none;
}

/* Individual Statistic Box */
.stats-container li {
    background: rgba(255, 255, 255, 0.1);
    padding: 8px;
    margin: 5px 0;
    border-radius: 5px;
    font-size: 14px;
    font-weight: bold;
    color: white;
    box-shadow: 0 2px 4px rgba(255, 255, 255, 0.2);
    transition: transform 0.3s ease;
}

/* Hover Effect */
.stats-container li:hover {
    transform: scale(1.05);
    background: rgba(255, 255, 255, 0.2);
}


</style>

<body>
 
    <aside>
        <button class="menu-btn fa fa-chevron-left"></button>
        <a href="/" class="logo-wrapper">
          <span class="fa-brands fa-uikit"></span>
          <span class="brand-name">Admin-page</span>
        </a>
        <div class="separator"></div>
        <ul class="menu-items">
          <li><a href="adminhomepage.php"><span class="icon fa fa-layer-group"></span><span class="item-name">Upload Books</span></a></li>
          <li><a href="viewbook.php"><span class="icon fa fa-chart-line"></span><span class="item-name">View Books</span></a></li>
          <li><a href="requestview.php"><span class="icon fa fa-chart-simple"></span><span class="item-name">Request View</span></a></li>
          <li><a href="commentview.php"><span class="icon fa fa-user"></span><span class="item-name">Comments View</span></a></li>
          <li><a href="changepw.php"><span class="icon fa fa-gear"></span><span class="item-name">Change Password</span></a></li>
          <li><a href="logout.php"><span class="icon fa fa-sign-out-alt"></span><span class="item-name">Logout</span></a></li>
        </ul>

    </aside>
    
    <main>
        <div class="stats-container">
            <ul>
            <li>Total students:<?php echo countRecord("select * from student",$db);?></li>
            <li>Total Books:<?php echo countRecord("select * from book",$db);?></li>
            <li>Total Request:<?php echo countRecord("select * from request",$db);?></li>
            <li>Total comments:<?php echo countRecord("select * from comment",$db);?></li>
            </ul>                
        </div>
        <div class="upload-container" >
        <h2>Upload Book Details</h2>
        <?php
       if(isset($_POST["submit"])){
          $target_dir="../books/";
          $target_file=$target_dir.basename($_FILES["efile"]["name"]);
          if(move_uploaded_file($_FILES["efile"]["tmp_name"],$target_file)){
               $sql="insert into book(BTITLE,KEYWORDS,FILE) values ('{$_POST["bname"]}','{$_POST["keys"]}','{$target_file}')";
               $db->query($sql);
               echo "<p class='success-message'>Book added successfully!</p>";
          }
          else{
            echo "<p>error in upload</p>";
          }
       }
    ?>
        <form id="uploadForm" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" enctype="multipart/form-data" class="upload-form">
            <label for="bookTitle">Book Title</label>
            <input type="text" id="bookTitle" name="bname" required><br><br>
            
            <label for="keywords">Keywords</label>
            <textarea id="keywords" name="keys" required></textarea><br><br>
            
            <label for="file">Upload File</label>
            <input type="file" id="file" name="efile" required><br><br>
            
            <button type="submit" name="submit">Save Details</button>
        </form>
        </div>
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
