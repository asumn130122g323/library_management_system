<?php
session_start();
include "adminpage/database/database.php"; // Ensure correct database connection
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css\ulogin.css"> <!-- Link to shared CSS file -->
</head>
<body>
    <div id="main-container">
        <div class="form-container">
            <div class="title">USER LOGIN</div>
            <?php
            if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["name"], $_POST["pass"])) {
                $name = mysqli_real_escape_string($db, $_POST["name"]);
                $pass = $_POST["pass"];
            
                $sql = "SELECT * FROM student WHERE NAME = ?";
                $stmt = $db->prepare($sql);
                $stmt->bind_param("s", $name);
                $stmt->execute();
                $res = $stmt->get_result();
            
                if (!$res) {
                    die("Database error: " . $db->error);
                }
                
                if ($res->num_rows > 0) {
                    $row = $res->fetch_assoc();
                    
                    // Direct password comparison (no hashing)
                    if ($row["PASS"] === $pass) {
                        $_SESSION["ID"] = $row["ID"];
                        $_SESSION["NAME"] = $row["NAME"];
                        
                        header("Location: homepage.php");
                        exit();
                    } 
                     else{
                        echo "<p class='error'>Invalid User Details</p>";
                     }      
                } else {
                    echo "<p class='error'>User not found</p>";
                }
            }
            ?>
            <form action="login.php" method="post">
                <div class="field">
                    <input type="text" name="name" placeholder="User Name" required>
                    <label></label>
                </div>

                <div class="field">
                    <input type="password" name="pass" required placeholder="Password">
                    <label></label>
                </div>

                <button type="submit" class="login-btn">Login</button>
            </form>

            <div class="bottom">
                <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
            </div>
        </div>
    </div>
</body>
</html>
