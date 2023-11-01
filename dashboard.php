<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./dashboard.css">
    <link href="https://fonts.googleapis.com/css?family=Libre+Barcode+128+Text" rel="stylesheet">

</head>
<body>
    <?php 
        if (!isset($_SESSION['email'])) {
            header('location: ./index.php');
        }
    ?>
    <?php
        $serverName = 'localhost:3306';
        $dBUsername = 'root';
        $dBPassword = '';
        $dBName = 'spacet';

        $conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

        $sql = "SELECT * FROM users WHERE email = ?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: index.php?error=queryerrror");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $_SESSION['email']);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        $row = mysqli_fetch_assoc($resultData)
    ?>
    <div class="ticket-main">
        <div class="ticket-main-body" id="ticket">
            <div class="ticket-main-wrapper">
                <div class="ticket-title">
                    <img
                        src="./Images/Logo.png"
                        alt="LogoImg"
                        class="ticket-logo-img"
                        />
                    <p class="title-name">SPACE IN COMPUTER ENGINEERING TECHNOLOGY</p>

                </div>
                <div class="ticket-top">
                    <div class="ticket-profile-details">
                        <div class="image-name">
                            <img
                            src="./Images/try.png"
                            alt="AstronautImg"
                            class="ticket-profile-img"
                            />
                            <div class="ticket-profile-name">
                                <p class="ticket-surname"><?= $row['last_name']?>,</p>
                                <p class="ticket-name">Joseph Jason S.</p>
                            </div>
                        </div>
                        <div class="ticket-personal-information">
                            <p class="PI-Birthdate"><span class="blue-text next-line">BIRTHDATE</span> 07/16/2004</p>
                            <p class="PI-Age"><span class="blue-text next-line">AGE</span> 19</p>
                            <p class="PI-Gender"><span class="blue-text next-line">GENDER</span> Male</p>
                        </div>
                    </div>
                    
                </div>
                <div class="ticket-bottom">
                    <div class="information">
                        <h1>CONTACT</h1>
                        <div class="group-information">
                            <p class="Email"><span class="blue-text">EMAIL ADDRESS</span><br><?php echo $_SESSION['email'] ?></p>
                            <p class="Contact-Number"><span class="blue-text">MOBILE NUMBER</span><br> 0912-345-6789</p>
                            <p class="Telephone-Number"><span class="blue-text">TELEPHONE NUMBER</span><br> (044)760-5083</p>
                        </div>
                    </div>
                    <div class="information">
                        <h1>LOCATION</h1>
                        <div class="group-information">
                            <p class="Region"><span class="blue-text">REGION</span><br> NCR</p>
                            <p class="Province/City"><span class="blue-text">PROVINCE/CITY</span><br> Manila</p>
                            <p class="Municipality"><span class="blue-text">MUNICIPALITY</span><br> Sta Mesa</p>
                            <p class="Barangay"><span class="blue-text">BARANGAY</span><br> 630</p>
                        </div>
                    </div>
                </div>
                <div class="ticket-right-wrapper">
                    <div class="ticket-number">
                        <div class="numbers">
                            <p>CMPE 40062</p>
                            <p>№ 00001</p>
                            <p>PUPCEA</p>
                        </div>
                        <div class="barcode-main">
                            <div id='barcodeContainer' class='glowing-animation'>
                                <h1 id="barcode">
                                    <span class = "animatedSpan"></span><span class = "animatedSpan">I</span><span class = "animatedSpan">N</span><span class = "animatedSpan">T</span><span class = "animatedSpan">E</span><span class = "animatedSpan">R</span><span class = "animatedSpan">S</span><span class = "animatedSpan">T</span></span><span class = "animatedSpan">E</span></span><span class = "animatedSpan">L</span></span><span class = "animatedSpan">L</span></span><span class = "animatedSpan">A</span></span><span class = "animatedSpan">R</span>
                                    
                                    
                            </div>
                        </div>
                </div>
                
            </div>
        </div>
    </div>


    <script src="./main.js"></script>
        
</body>
</html>