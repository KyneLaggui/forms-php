<?php        
    session_start();
    if (!empty($_POST)) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $birthdate = $_POST['birthdate'];
        $age = $_POST['age'];
        $email = $_POST['email'];
        $contactNum = $_POST['contact-num'];
        $telNum = $_POST['tel-num'];
        $gender = empty($_POST['other-gender']) ? $_POST['gender']: $_POST['other-gender'];
        $region = $_POST['region'];
        $cityProvince = $_POST['city/province'];
        $cityMunicipality = $_POST['city/municipality'];
        $barangay = $_POST['barangay'];
        
        // Backside validation 
        if (empty($username) || empty($password) || empty($fname) || empty($lname) || empty($birthdate) 
            || empty($age) || empty($email) || empty($contactNum) || empty($gender) || empty($region)
            || empty($cityProvince) || empty($cityMunicipality) || empty($barangay)) {
                header("location: ../signup.php?error=emptyRequiredInputs");
                exit();
        }

        if (strlen($password) < 8) {
            header("location: ../signup.php?error=passwordTooShort");
            exit();
        }

        if (!preg_match('/[A-Z]/', $password)) {
            header("location: ../signup.php?error=passwordNoUppercase");
            exit();
        }

        if (!preg_match('/[`!@#$%^&*()_+\-=\[\]{};\':"\\|,.<>\/?~]/', $password)) {
            header("location: ../signup.php?error=passwordNoSpecialCharacter");
            exit();
        }

        if (!preg_match('/\d/', $password)) {
            header("location: ../signup.php?error=passwordNoNumbers");
            exit();
        }

        if ($password !== $cpassword) {
            header("location: ../signup.php?error=passwordDoesNotMatch");
            exit();
        }

        if (strlen(preg_replace('/[^\d]/g', '', $contactNum)) === 12) {
            header("location: ../signup.php?error=incorrectContactNumberFormat");
            exit();
        }

        if (!preg_match('/^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/', $email)) {
            header("location: ../signup.php?error=emailWrongFormat");
            exit();
        }

        if ($age < 13) {
            header("location: ../signup.php?error=ageTooYoung");
            exit();
        }

        // End of backside validation

        $serverName = 'localhost:3306';
        $dBUsername = 'root';
        $dBPassword = '';
        $dBName = 'spacet';
        
        $conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

        if (!$conn) {
            die("Connection failed " . mysqli_connect_error());             
        }
                    
        function emailExists($conn, $email) {
            $sql = "SELECT * FROM users WHERE email = ?;";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("location: ../signup.php?error=stmtfailed");
                exit();
            }

            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);

            $resultData = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($resultData)) {
                return $row;
            } else {
                $result = false;
                return $result;
            }

            mysqli_stmt_close($stmt);
        }

        if (emailExists($conn, $email)) {
            header("location: ../registration.php?error=emailExists");
            exit();
        }

        $sql = "INSERT INTO users(username, user_password, first_name, middle_name,
            last_name, birthdate, age, email, contact_number, tel_number, gender)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../registration.php?error=stmtfailed");
            exit();
        }

        $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
        $formattedCelnumber = preg_replace('/[^0-9]/', '', $contactNum);

        mysqli_stmt_bind_param($stmt, "ssssssissss", $username, $hashedPwd, $fname, $mname, 
            $lname, $birthdate, $age, $email, $formattedCelnumber, $telNum, $gender) ;
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        // For address table
        $sqlAddress = "INSERT INTO address(email, region, province_or_city, municipality, barangay)
            VALUES (?, ?, ?, ?, ?);";
        $stmtAddress = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmtAddress, $sqlAddress)) {
            header("location: ../registration.php?error=stmtfailed");
            exit();
        }

        $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
        $formattedCelnumber = preg_replace('/[^0-9]/', '', $contactNum);

        mysqli_stmt_bind_param($stmtAddress, "sssss", $email, $region, $cityProvince, $cityMunicipality, $barangay);
        mysqli_stmt_execute($stmtAddress);
        mysqli_stmt_close($stmtAddress);
        if (isset($_SESSION['error'])) {
            unset($_SESSION['error']);
        }
        header("location: ../index.php?error=none");
        exit();
    }               
?>

    


