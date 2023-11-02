<?php        
    if (!empty($_POST)) {
        $username = $_POST['username'];
        $password = $_POST['password'];
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
        
        $serverName = 'localhost:3306';
        $dBUsername = 'root';
        $dBPassword = '';
        $dBName = 'spacet';
        
        $conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

        if (!$conn) {
            die("Connection failed " . mysqli_connect_error());             
        }

        $sql = "UPDATE users
                SET username = ?, user_password = ? , first_name = ?, middle_name = ?,
                last_name = ?, birthdate = ?, age = ?, email = ?, contact_number = ?, tel_number = ?, gender = ?,
                region = ?, city_province = ?, city_municipality = ?, barangay = ?
                WHERE email = ?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../edit-details.php?error=stmtfailed");
            exit();
        }

        $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
        $formattedCelnumber = preg_replace('/[^0-9]/', '', $contactNum);

        mysqli_stmt_bind_param($stmt, "ssssssisssssssss", $username, $hashedPwd, $fname, $mname, 
            $lname, $birthdate, $age, $email, $formattedCelnumber, $telNum, $gender, $region, $cityProvince,
            $cityMunicipality, $barangay, $email) ;
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("location: ../dashboard.php?error=none");
        exit();
    }               
?>

    


