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
    <div class="welcome-statement">
        <h1>Welcome <span class= "username"><?= $row['username']?>!</span></h1>
        <p id="typing-effect"></p>
    </div>
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
                                <p class="ticket-name"><?php echo $row['first_name'] . " " . substr($row['middle_name'], 0, 1) . "." ; ?></p>
                            </div>
                        </div>
                        <div class="ticket-personal-information">
                            <p class="PI-Birthdate"><span class="blue-text next-line">BIRTHDATE</span> <?= $row['birthdate']?></p>
                            <p class="PI-Age"><span class="blue-text next-line">AGE</span> <?= $row['age']?></p>
                            <p class="PI-Gender"><span class="blue-text next-line">GENDER</span> <?= strtoupper($row['gender']) ?> </p>
                        </div>
                    </div>
                    
                </div>
                <div class="ticket-bottom">
                    <div class="information">
                        <h1>CONTACT</h1>
                        <div class="group-information">
                            <p class="Email"><span class="blue-text">EMAIL ADDRESS</span><br><?php echo $_SESSION['email'] ?></p>
                            <p class="Contact-Number"><span class="blue-text">MOBILE NUMBER</span><br> <?= $row['contact_number']?> </p>
                            <p class="Telephone-Number"><span class="blue-text">TELEPHONE NUMBER</span><br> <?= $row['tel_number']?></p>
                        </div>
                    </div>
                    <div class="information">
                        <h1>LOCATION</h1>
                        <div class="group-information">
                            <p class="Region"><span class="blue-text">REGION</span><br> <?= $row['region']?></p>
                            <p class="Province/City"><span class="blue-text">PROVINCE/CITY</span><br> <?= $row['city_province']?></p>
                            <p class="Municipality"><span class="blue-text">MUNICIPALITY</span><br> <?= $row['city_municipality']?></p>
                            <p class="Barangay"><span class="blue-text">BARANGAY</span><br> <?= $row['barangay']?></p>
                        </div>
                    </div>
                </div>
                <div class="ticket-right-wrapper">
                    <div class="ticket-number">
                        <div class="numbers">
                            <p>CMPE 40062</p>
                            <p>№ 0000<?= $row['user_id']?></p>
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
    </div>

    <div class="buttons-bottom">
        <button class="logout-button"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"></path><path fill="currentColor" d="M5 13c0-5.088 2.903-9.436 7-11.182C16.097 3.564 19 7.912 19 13c0 .823-.076 1.626-.22 2.403l1.94 1.832a.5.5 0 0 1 .095.603l-2.495 4.575a.5.5 0 0 1-.793.114l-2.234-2.234a1 1 0 0 0-.707-.293H9.414a1 1 0 0 0-.707.293l-2.234 2.234a.5.5 0 0 1-.793-.114l-2.495-4.575a.5.5 0 0 1 .095-.603l1.94-1.832C5.077 14.626 5 13.823 5 13zm1.476 6.696l.817-.817A3 3 0 0 1 9.414 18h5.172a3 3 0 0 1 2.121.879l.817.817.982-1.8-1.1-1.04a2 2 0 0 1-.593-1.82c.124-.664.187-1.345.187-2.036 0-3.87-1.995-7.3-5-8.96C8.995 5.7 7 9.13 7 13c0 .691.063 1.372.187 2.037a2 2 0 0 1-.593 1.82l-1.1 1.039.982 1.8zM12 13a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"></path></svg>
            <span><a href="">LOGOUT</a></span></button>
        <button class="profile-button"><a href="">Edit Details</a></button>
    </div>


    <script src="./main.js"></script>
        
</body>
</html>