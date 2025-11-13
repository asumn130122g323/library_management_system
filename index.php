<?php
    session_start();
    include "adminpage/database/database.php"; 
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library E-catelogue</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* General Styles */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color:rgb(90, 31, 4);
    background: url("./images/alogin.jpg") no-repeat center center/cover;
    color: #ffffff;
    text-align: center;
}

header {
    background: rgba(0, 0, 0, 0.7); /* Semi-transparent black */
    padding: 8px;  /* Reduced padding */
    font-size: 20px; /* Standard font size */
    font-weight: bold;
    color: white;
    text-align: center;
    text-transform: uppercase;
}



main {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 80vh;
}

.login-container {
    background: rgba(0, 0, 0, 0.6); /* Semi-transparent black */
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.5);
    width: 300px;
}

h2 {
    color:rgb(252, 248, 247);
}

.buttons {
    margin-top: 20px;
}

.btn {
    display: inline-block;
    padding: 10px 20px;
    margin: 10px;
    color: white;
    background-color:rgb(30, 204, 210);
    text-decoration: none;
    border-radius: 5px;
    transition: 0.3s;
}

.btn:hover {
    background-color:rgb(6, 117, 121);
}

    </style>
</head>
<body>
    <header>
        <h1>Welcome to the E-Library catelogue</h1>
    </header>
    <main>
        <div class="login-container">
            <h2>Login</h2>
            <p>Select your role:</p>
            <div class="buttons">
                <a href="adminpage/adminlogin.php" class="btn">Admin Login</a>
                <a href="login.php" class="btn">User Login</a>
            </div>
        </div>
    </main>
</body>
</html>
