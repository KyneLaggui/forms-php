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
    <link rel="stylesheet" href="registration.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <form action="./includes/registration.inc.php" class="registration-box" id="registration-form" method="post">
            <div class="back-btn-container">
                <a href="index.php">
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
                            <input type="text" name="username" id="username" required>
                            <label>Username</label>
                        </div>
                        <div class="field-inputs password-field" id="input-group">  
                            <input type="text" name="password" id="password" required>
                            <label>Password</label>
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
                        <input type="text" name="fname" required >
                        <label>First Name</label>
                    </div>
                    <div class="field-inputs" id="input-group">  
                        <input type="text" name="mname" required>
                        <label for="mname">Middle Name</label>
                    </div>
                    <div class="field-inputs" id="input-group">  
                        <input type="text" name="lname" required>
                        <label>Last Name</label>
                    </div>
                </div>
                <div class="third-row row">                    
                    <div class="field-inputs medium-inputs" id="input-group">  
                        <input type="date" name="birthdate" id="birthdate" max="<?php echo date("Y-m-d"); ?>"required>
                        <label>Birthdate</label>
                    </div>
                    <div class="field-inputs short-inputs" id="input-group">  
                        <input type="number" name="age" id="age" required class="non-clickable">
                        <label id="age-label">Age</label>
                        <div class="overlay"></div>
                    </div>
                    <div class="field-inputs" id="input-group">  
                        <input type="text" name="email" required id="email">
                        <label>Email Address</label>
                    </div>
                </div>
                <div class="fourth-row row">
                    <div class="field-inputs" id="input-group">  
                        <input type="text" name="contact-num" required id="phone-input">
                        <label>Contact Number</label>
                    </div>
                    <div class="field-inputs" id="input-group">  
                        <input type="text" name="tel-num" id="tel-input" maxlength="15">
                        <label>Telephone Number</label>
                    </div>
                    <div class="field-inputs medium-inputs"> 
                        <select name="gender" required id="gender">
                            <option value="" disabled selected>--Select Gender--</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="others">Others</option>                            
                            <option value="N/A">Prefer not to say</option>
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
                        <select name="region" required id="region">
                            <option value="" disabled selected>--Select Region--</option>
                        </select>
                        <label>Region</label>
                    </div>
                    <div class="field-inputs medium-inputs"> 
                        <select name="city/province" required id="province">
                            <option value="" disabled selected>--Select Province/City--</option>                
                        </select>
                        <label>Province/City</label>
                    </div>                    
                    <div class="field-inputs medium-inputs"> 
                        <select name="city/municipality" required id="municipality">
                            <option value="" disabled selected>--Select Municipality--</option>                            
                        </select>
                        <label>Municipality/City</label>
                    </div>
                    <div class="field-inputs medium-inputs"> 
                        <select name="barangay" id="barangay" required>
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