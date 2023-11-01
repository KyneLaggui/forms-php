<?php 
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

    function loginUser($conn, $email, $pwd) {
        $emailExists = emailExists($conn, $email);

        if ($emailExists === false) {
            header('location: ../login.php?error=wronglogin');
            exit();
        }

        $pwdHashed = $emailExists['user_password'];
        $checkPwd = password_verify($pwd, $pwdHashed);

        if ($checkPwd === false) {
            header('location: ../login.php?error=wronglogin');
            exit();
        }

        else if ($checkPwd === true) {
            session_start();
            $_SESSION["email"] = $emailExists['email'];
            header('location: ../dashboard.php');
            exit();
        }
    }
    // End of loginUser function

    if ($emailExists === false) {
        header('location: ../login.php?error=wronglogin');
        exit();
    }

    $serverName = 'localhost:3306';
    $dBUsername = 'root';
    $dBPassword = '';
    $dBName = 'spacet';

    $email = $_POST['email'];
    $userPassword = $_POST['password'];

    $conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);
    $uidExists = emailExists($conn, $email);

    loginUser($conn, $email, $userPassword);
?>