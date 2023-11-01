<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    </style>
</head>
<body>
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
            $cityMunicipality = $_POST['city/municiaplity'];
            $barangay = $_POST['barangay'];
            
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
                last_name, birthdate, age, email, contact_number, tel_number, gender,
                region, city_province, city_municipality, barangay) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("location: ../registration.php?error=stmtfailed");
                exit();
            }

            $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
            $formattedCelnumber = preg_replace('/[^0-9]/', '', $contactNum);

            mysqli_stmt_bind_param($stmt, "ssssssissssssss", $username, $hashedPwd, $fname, $mname, 
                $lname, $birthdate, $age, $email, $formattedCelnumber, $telNum, $gender, $region, $cityProvince,
                $cityMunicipality, $barangay) ;
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            header("location: ../index.php?error=none");
            exit();
        }               
    ?>
</body>
</html>

    


