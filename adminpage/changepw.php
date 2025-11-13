<?php
session_start();
include "database/database.php"; // Ensure correct database connection

// Redirect to login if the admin is NOT logged in
if (!isset($_SESSION["AID"])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>changepw</title>
    <link rel="stylesheet" href="../css/managenav.css">
    <link rel="stylesheet" href="adminstyle.css">
    <style>
/* Import Fonts and Icons */
@import url('https://fonts.googleapis.com/css2?family=Baloo+Bhai+2:wght@400&display=swap');
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.css');

/* Global Styling */
body {
    font-family: "Baloo Bhai 2", Arial, sans-serif;
    background: url("../images/alogin.jpg") no-repeat center center/cover;
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
/* change password */
h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #f8f9fa;
    font-size: 24px;
}

form {
    width: 400px;
    margin: auto;
    background-color:rgb(56, 60, 65); /* Dark Blue-Grey */
    padding: 25px;
    border-radius: 10px;
    margin-top: 40px;
    box-shadow: 0px 0px 15px rgba(253, 251, 251, 0.15);
    display: flex;
    flex-direction: column;
    align-items: center;
}

input, select {
    width: 95%;
    padding: 10px;
    margin: 12px 0;
    border: 1px solidrgb(87, 88, 90);
    background-color:rgb(155, 157, 160); /* Darker Input */
    color: white;
    border-radius: 5px;
    font-size: 14px;
}

input::placeholder {
    color: #bdc3c7;
}

.update-button {
    padding: 12px;
    width: 100%;
    background-color:rgb(6, 156, 202); /* Green for Submit */
    color: white;
    font-size: 16px;
    font-weight: bold;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s ease-in-out;
}

.update-button:hover {
    background-color:rgb(3, 203, 253); /* Lighter Green */
}

label {
    color: #f8f9fa;
    font-weight: bold;
    font-size: 14px;
    align-self: flex-start;
    margin-top: 5px;
}

select {
    cursor: pointer;
}

/* Responsive Design */
@media (max-width: 600px) {
    form {
        width: 90%;
        margin-left: auto;
        margin-right: auto;
    }
}
    </style>
</head>
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
    <h2>Change Password</h2>
    <?php
       if(isset($_POST["submit"])){
        $sql="SELECT * FROM admin WHERE APASS='{$_POST["opass"]}' and AID='{$_SESSION["AID"]}'";
        $res=$db->query($sql);
        if($res->num_rows>0){
        $s="update admin set APASS='{$_POST["npass"]}' WHERE AID=".$_SESSION["AID"];
        $db->query($s);
        echo"<p class='success'>password changed</p>";
        }
        else{
            echo"<p class='error'> invalid password</p>";
        }
       }
    ?>
    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST" >
        <label for="old_password">Old Password</label>
        <input type="password" name="opass" required>
        
        <label for="new_password">New Password</label>
        <input type="password" name="npass" required>
        
        <button type="submit" name="submit" class="update-button">Update Now</button>
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
