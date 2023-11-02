<?php
    session_start();
?>

<?php
    if (!isset($_SESSION['email'])) {
        header('location: ./index.php');
    }

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

    $row = mysqli_fetch_assoc($resultData);

    // For address
    $sqlAddress = "SELECT * FROM address WHERE email = ?;";
    $stmtAddress = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmtAddress, $sqlAddress)) {
        header("location: index.php?error=queryerrror");
        exit();
    }

    mysqli_stmt_bind_param($stmtAddress, "s", $_SESSION['email']);
    mysqli_stmt_execute($stmtAddress);

    $resultDataAddress = mysqli_stmt_get_result($stmtAddress);

    $rowAddress = mysqli_fetch_assoc($resultDataAddress);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="registration.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <form action="./includes/edit.inc.php" class="registration-box" id="registration-form" method="post">
            <div class="back-btn-container">
                <a href="dashboard.php">
                    <i class='fas fa-arrow-circle-left' id="back-btn"></i>                
                </a>
                Go Back
            </div>
            <div class="all-inputs">
                <div class="first-row row">
                    <div>
                        <img src="./Images/try.png" alt="Umasa Picture" class="full-pic">
                    </div>
                    <div class="first-row-inputs">
                        <div class="field-inputs" id="input-group">  
                            <input type="text" name="username" id="username" value="<?= $row['username']?>" required>
                            <label>Username</label>
                        </div>
                        <div class="field-inputs password-field" id="input-group">  
                            <input type="text" name="password" id="password" required>
                            <label>New Password</label>
                        </div>
                        <div class="field-inputs password-field" id="input-group" >  
                            <input type="text" name="cpassword" id ="cpassword" required>
                            <label>Confirm Password</label>
                        </div>
                    </div>
                    <div class="input-errors">
                        <?php   
                            if (isset($_GET['error'])) {
                                if ($_GET['error'] == 'emailExists') {
                                    echo "
                                        <div class='input-error'>
                                            <p><i class='fa-solid fa-circle-exclamation' id='uppercase-ex'></i><i class='fa-solid fa-circle-check' style='color: #1fd195;' id='uppercase-check'></i>Email should be unused</p>
                                        </div>
                                    ";
                                }
                                else if ($_GET['error'] == 'stmtfailed') {
                                    echo "
                                        <div class='input-error'>
                                            <p><i class='fa-solid fa-circle-exclamation' id='uppercase-ex'></i><i class='fa-solid fa-circle-check' style='color: #1fd195;' id='uppercase-check'></i>Database query failed</p>
                                        </div>
                                    ";
                                }
                            }
                        ?>
                        <div class="input-error">
                            <p><i class="fa-solid fa-circle-exclamation" id="uppercase-ex"></i><i class="fa-solid fa-circle-check" style="color: #1fd195;" id="uppercase-check"></i>Password has at least one uppercase character</p>
                        </div>
                        <div class="input-error">
                            <p><i class="fa-solid fa-circle-exclamation" id="special-ex"></i><i class="fa-solid fa-circle-check" style="color: #1fd195;" id="special-check"></i>Password has at least one special character</p>
                        </div>
                        <div class="input-error">
                            <p><i class="fa-solid fa-circle-exclamation" id="number-ex"></i><i class="fa-solid fa-circle-check" style="color: #1fd195;" id="number-check"></i>Password has at least one number</p>
                        </div>
                        <div class="input-error">
                            <p><i class="fa-solid fa-circle-exclamation" id="length-ex"></i><i class="fa-solid fa-circle-check" style="color: #1fd195;" id="length-check"></i>Password has at least 8 characters</p>
                        </div>                
                        <div class="input-error">
                            <p><i class="fa-solid fa-circle-exclamation" id="match-ex"></i><i class="fa-solid fa-circle-check" style="color: #1fd195;" id="match-check"></i>Password matches</p>
                        </div>                
                        <div class="input-error">
                            <p><i class="fa-solid fa-circle-exclamation" id="contact-ex"></i><i class="fa-solid fa-circle-check" style="color: #1fd195;" id="contact-check"></i>Proper contact number format</p>
                        </div>                
                        <div class="input-error">
                            <p><i class="fa-solid fa-circle-exclamation" id="email-ex"></i><i class="fa-solid fa-circle-check" style="color: #1fd195;" id="email-check"></i>Proper email address format</p>
                        </div>                
                        <div class="input-error">
                            <p><i class="fa-solid fa-circle-exclamation" id="age-ex"></i><i class="fa-solid fa-circle-check" style="color: #1fd195;" id="age-check"></i>At least 13 years old</p>
                        </div>                
                    </div>
                </div>
                <div class="second-row row">
                    <div class="field-inputs" id="input-group">  
                        <input type="text" name="fname" value="<?= $row['first_name']?>" required >
                        <label>First Name</label>
                    </div>
                    <div class="field-inputs" id="input-group">  
                        <input type="text" name="mname" value="<?= $row['middle_name']?>" required >
                        <label>Middle Name</label>
                    </div>
                    <div class="field-inputs" id="input-group">  
                        <input type="text" name="lname" value="<?= $row['last_name']?>" required>
                        <label>Last Name</label>
                    </div>
                </div>
                <div class="third-row row">                    
                    <div class="field-inputs medium-inputs" id="input-group">  
                        <input type="date" name="birthdate" id="birthdate" max="<?php echo date("Y-m-d"); ?>" value="<?=$row['birthdate']?>" required>
                        <label>Birthdate</label>
                    </div>
                    <div class="field-inputs short-inputs" id="input-group">  
                        <input type="number" name="age" id="age" value="<?= $row['age']?>" required class="non-clickable">
                        <label class="edit-detail-automatic" id="age-label">Age</label>
                        <div class="overlay"></div>
                    </div>
                    <div class="field-inputs" id="input-group">  
                        <input type="text" name="email" required id="email" value="<?= $row['email']?>" readonly>
                        <label class="edit-detail-automatic" >Email Address</label>
                    </div>
                </div>
                <div class="fourth-row row">
                    <div class="field-inputs" id="input-group">  
                        <input type="text" name="contact-num" required id="phone-input" value="<?= $row['contact_number']?>">
                        <label>Contact Number</label>
                    </div>
                    <div class="field-inputs" id="input-group">  
                        <input type="text" name="tel-num" required id="tel-input" maxlength="15" value="<?= $row['tel_number']?>">
                        <label>Telephone Number</label>
                    </div>
                    <div class="field-inputs medium-inputs"> 
                        <select name="gender" required id="gender">
                            <option value="" disabled selected>--Select Gender--</option>
                            <option value="male" <?php if ($row['gender'] == 'male') echo "selected";?> >Male</option>
                            <option value="female" <?php if ($row['gender'] == 'female') echo "selected";?>>Female</option>
                            <option value="others" <?php if (!$row['gender'] == 'male' && !$row['gender'] == 'female' &&
                             !$row['gender'] == 'N/A') echo "selected";?>>Others</option>                            
                            <option value="N/A" <?php if ($row['gender'] == 'N/A') echo "selected";?>>Prefer not to say</option>
                        </select>
                        <label>Gender</label>
                    </div>                   
                    <div class="field-inputs other-gender" id="input-group">  
                        <input type="text" name="other-gender">
                        <label>Others (Please specify)</label>
                    </div>
                </div>
                <div class="fifth-row row">
                    <div class="field-inputs medium-inputs"> 
                        <select name="region" id="region" value="<?=$rowAddress['region']?>" >
                            <option value="" disabled selected>--Select Region--</option>
                        </select>
                        <label>Region</label>
                    </div>
                    <div class="field-inputs medium-inputs"> 
                        <select name="city/province" id="province" value="<?=$rowAddress['province_or_city']?>" >
                            <option value="" disabled selected>--Select Province/City--</option>                
                        </select>
                        <label>Province/City</label>
                    </div>                    
                    <div class="field-inputs medium-inputs"> 
                        <select name="city/municipality" id="municipality" value="<?=$rowAddress['municipality']?>" >
                            <option value="" disabled selected>--Select Municipality/City--</option>                            
                        </select>
                        <label>Municipality/City</label>
                    </div>
                    <div class="field-inputs medium-inputs"> 
                        <select name="barangay" id="barangay" value="<?=$rowAddress['barangay']?>">
                            <option value="" disabled selected>--Select Barangay--</option>                            
                        </select>
                        <label>Barangay</label>
                    </div>                                      
                </div>                
            </div>
            <button type="submit" class="save-btn">Save</button>
        </form>
    </div>
    <script src="https://kit.fontawesome.com/ee74f8cc5e.js" crossorigin="anonymous"></script>
    <script src="./js/registration.js"></script>
</body>
</html>