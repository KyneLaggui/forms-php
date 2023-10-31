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
        <form action="./includes/register-inc.php" class="registration-box">
            <div class="back-btn-container">
                <a href="index.php">
                    <i class='fas fa-arrow-circle-left' id="back-btn"></i>                
                </a>
                Go Back
            </div>
            <div class="all-inputs">
                <div class="first-row row">
                    <div>
                        <img src="./Images/Profile-Picture.jpg" alt="Astronaut Picture" class="full-pic">
                    </div>
                    <div class="first-row-inputs">
                        <div class="field-inputs" id="input-group">  
                            <input type="text" name="fname" required maxlength = "30" >
                            <label>Username</label>
                        </div>
                        <div class="field-inputs password-field" id="input-group">  
                            <input type="text" name="lname" required maxlength = "30" >
                            <label>Password</label>
                        </div>
                        <div class="field-inputs password-field" id="input-group">  
                            <input type="text" name="mname" required maxlength = "30" >
                            <label>Confirm Password</label>
                        </div>
                    </div>
                    <div class="input-errors">

                    </div>
                </div>
                <div class="second-row row">
                    <div class="field-inputs" id="input-group">  
                        <input type="text" name="fname" required maxlength = "30" >
                        <label>First Name</label>
                    </div>
                    <div class="field-inputs password-field" id="input-group">  
                        <input type="text" name="lname" required maxlength = "30" >
                        <label>Middle Name</label>
                    </div>
                    <div class="field-inputs password-field" id="input-group">  
                        <input type="text" name="mname" required maxlength = "30" >
                        <label>Last Name</label>
                    </div>
                </div>
                <div class="third-row row">                    
                    <div class="field-inputs medium-inputs" id="input-group">  
                        <input type="date" name="birthdate" required maxlength = "30" >
                        <label>Birthdate</label>
                    </div>
                    <div class="field-inputs short-inputs" id="input-group">  
                        <input type="number" name="age" required maxlength = "30" >
                        <label>Age</label>
                    </div>
                    <div class="field-inputs" id="input-group">  
                        <input type="text" name="email" required maxlength = "30" >
                        <label>Email Address</label>
                    </div>
                </div>
                <div class="fourth-row row">
                    <div class="field-inputs" id="input-group">  
                        <input type="text" name="email" required maxlength = "30" >
                        <label>Contact Number</label>
                    </div>
                    <div class="field-inputs" id="input-group">  
                        <input type="text" name="birthdate" required maxlength = "30" >
                        <label>Telephone Number</label>
                    </div>
                    <div class="field-inputs medium-inputs"> 
                        <select name="Gender" required>
                            <option value="" disabled selected>--Select Gender--</option>
                            <option>Male</option>
                            <option>Female</option>                            
                            <option>Prefer not to say</option>
                        </select>
                        <label>Gender</label>
                    </div>
                </div>
                <div class="fifth-row row">
                    <div class="field-inputs medium-inputs"> 
                        <select name="Gender" required>
                            <option value="" disabled selected>--Select Region--</option>
                            <option>Male</option>
                            <option>Female</option>                            
                            <option>Prefer not to say</option>
                        </select>
                        <label>Region</label>
                    </div>
                    <div class="field-inputs medium-inputs"> 
                        <select name="Gender" required>
                            <option value="" disabled selected>--Select City/Province--</option>
                            <option>Male</option>
                            <option>Female</option>                            
                            <option>Prefer not to say</option>
                        </select>
                        <label>City/Province</label>
                    </div>                    
                    <div class="field-inputs medium-inputs"> 
                        <select name="Gender" required>
                            <option value="" disabled selected>--Select Municipality--</option>
                            <option>Male</option>
                            <option>Female</option>                            
                            <option>Prefer not to say</option>
                        </select>
                        <label>Municipality</label>
                    </div>
                    <div class="field-inputs medium-inputs"> 
                        <select name="Gender" required>
                            <option value="" disabled selected>--Select Barangay--</option>
                            <option>Male</option>
                            <option>Female</option>                            
                            <option>Prefer not to say</option>
                        </select>
                        <label>Barangay</label>
                    </div>                                      
                </div>
            </div>
        </form>
    </div>
    <script src="https://kit.fontawesome.com/ee74f8cc5e.js" crossorigin="anonymous"></script>
    <script src="./js/registration.js"></script>
</body>
</html>