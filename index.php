<?php 
    session_start();
?>

<?php
    if (isset($_SESSION['email'])) {
        header('location: ./dashboard.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <form action="./includes/login.inc.php" method="post" class="login-box">
            <div class="all-inputs">
                <p class="welcome">Welcome to&nbsp;<span id="space">Space</span><span id="T">T</span></p>
                <div class="input-boxes">
                    <div class="field-inputs" id="input-group">  
                        <input type="text" name="email" required maxlength = "30" >
                        <label>Email</label>
                    </div>
                    <div class="field-inputs password-field" id="input-group">  
                        <input type="text" name="password" required maxlength = "30" >
                        <label>Password</label>
                    </div>
                </div>
                <button type="submit" id="login-btn">Login</button>
                <?php 
                    if (isset($_GET['error'])) {
                        if ($_GET['error'] == 'emptyinput') {
                            echo "<p><i class='fa-solid fa-circle-exclamation'></i>&nbsp;Fill in all fields.</p>";
                        }
                        else if ($_GET['error'] == 'wronglogin') {
                            echo "<p><i class='fa-solid fa-circle-exclamation'></i>&nbsp;Wrong login credentials.</p>";
                        }
                    }
                ?>
                <p class="no-account">Don't have an account?&nbsp;<a id="sign-up" href="registration.php">Sign Up</a></p>
            </div>
        </form>
    </div>
    <script src="https://kit.fontawesome.com/ee74f8cc5e.js" crossorigin="anonymous"></script>
    <script src="./js/login.js"></script>
</body>
</html>