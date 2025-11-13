<?php
  session_start();
  include "database/database.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/aloginstyle.css">
</head>
<body>
    <div id="main-container">
        <div class="form-container">
            <div class="login-form">
                <div class="title">ADMIN LOGIN</div>
                <?php
                  if(isset($_POST["submit"])){
                         $sql="SELECT * FROM admin where ANAME='{$_POST["aname"]}' and APASS='{$_POST["apass"]}'";
                         $res=$db->query($sql); 
                         if($res->num_rows>0)
                         {
                            $row=$res->fetch_assoc();
                            $_SESSION["AID"]=$row["AID"];
                            $_SESSION["ANAME"]=$row["ANAME"];
                           header("location: adminhomepage.php");
                         }  
                         else{
                            echo "<p class='error'>Invalid User Details</p>";
                         }              
                  }
                ?>
                <form action="adminlogin.php" method="post">
                    <div class="field">
                        <input type="text" name="aname" placeholder="Name" required autocomplete="">
                        <label for="email-address"></label>
                    </div>

                    <div class="field">
                        <input type="password" name="apass" required placeholder="password" autocomplete="on">
                        <label for="create-pass"></label>
                    </div>
                    <section> </section>
                    <button type="submit" class="login-btn" name="submit">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>