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
    <title>Document</title>
    <!-- <link rel="stylesheet" href="../css/managenav.css"> -->
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

/* Table for Viewing Books */
h2 {
    margin-left: 10%;
}

table {
    width: 80%;
    margin: auto;
    margin-top: 30px;
    border-collapse: collapse;
    background: rgba(30, 30, 30, 0.9);
    color: #f0f0f0;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.5);
}

th, td {
    border: 1px solid #555;
    padding: 12px;
    text-align: center;
}

th {
    background-color: rgba(50, 50, 50, 0.9);
    font-weight: bold;
}

/* Buttons */
button {
    padding: 6px 12px;
    cursor: pointer;
    background-color: #f44336;
    color: white;
    border: none;
    border-radius: 5px;
    transition: background 0.3s ease;
}

button:hover {
    background-color: #e53935;
}

/* View Links */
a {
    color: #4db8ff;
    text-decoration: none;
    font-weight: bold;
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
    <h2>View Student Request</h2>
    <?php
     $sql="SELECT STUDENT.NAME,request.MESS,request.LOGS from STUDENT inner join request ON
     STUDENT.ID=request.ID";
     $res=$db->query($sql);
     if($res->num_rows>0)
    {
     echo"<table>
        <tr>
            <th>SNO</th>
            <th>NAME</th>
            <th>MESSAGE</th>
            <th>LOGS</th>
        </tr>";
         $i=0;
         while($row=$res->fetch_assoc())
         {
            $i++;
            echo"<tr>";
            echo" <td>{$i}</td>";
            echo" <td>{$row["NAME"]}</td>";
            echo" <td>{$row["MESS"]}</td>";
            echo"<td>{$row["LOGS"]}</td>";
            echo" </tr>";
         }
           echo"</table>";
        }
        else{
               echo"<p class='error'>No Request Found</p>";
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
