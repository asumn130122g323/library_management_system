<?php
session_start();
include "adminpage/database/database.php";
 // Ensure correct path to database connection
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="css/ulogin.css"> <!-- Make sure this file exists -->
</head>
<body>
    <div id="main-container">
        <div class="form-container">
            <div class="title">SIGN UP</div>
            
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST["name"], $_POST["pass"], $_POST["mail"], $_POST["dep"])) {
                    // Sanitize inputs
                    $name = mysqli_real_escape_string($db, $_POST["name"]);
                    $mail = mysqli_real_escape_string($db, $_POST["mail"]);
                    $dep  = mysqli_real_escape_string($db, $_POST["dep"]);
                    $pass = $_POST["pass"]; // No Hashing

                    // Insert into database
                    $sql = "INSERT INTO student (NAME, PASS, MAIL, DEP) VALUES ('$name', '$pass', '$mail', '$dep')";
                    
                    if ($db->query($sql) === TRUE) {
                        echo "<p class='success-message'>User registered successfully!</p>";
                    } else {
                        echo "<p class='error-message'>Error: " . $db->error . "</p>";
                    }
                } else {
                    echo "<p class='error-message'>All fields are required!</p>";
                }
            }
            ?>

            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                <div class="field">
                    <input type="text" name="name" required placeholder=" ">
                    <label>Name</label>
                </div>

                <div class="field">
                    <input type="email" name="mail" required placeholder=" ">
                    <label>Email</label>
                </div>

                <div class="field">
                    <input type="password" name="pass" required placeholder=" ">
                    <label>Password</label>
                </div>

                <div class="field">
                    <select name="dep" required>
                        <option value="">Select Department</option>
                        <option value="BCA">BCA</option>
                        <option value="BSC(CS)">BSC(CS)</option>
                        <option value="B.COM">B.COM</option>
                        <option value="others">OTHERS</option>
                    </select>
                </div>

                <button type="submit" class="signup-btn">Register</button>
            </form>

            <div class="bottom">
                <p>Already have an account? <a href="login.php">Login</a></p>
            </div>
        </div>
    </div>
</body>
</html>
