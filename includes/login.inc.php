<?php 
    $serverName = 'localhost:3306';
    $dBUsername = 'root';
    $dBPassword = '';
    $dBName = 'spacet';

    $conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);
    $uidExists = uidExists($conn, $username, $username);

    if ($uidExists === false) {
        header('location: ../login.php?error=wronglogin');
        exit();
    }

    $pwdHashed = $uidExists['usersPwd'];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false) {
        header('location: ../login.php?error=wronglogin');
        exit();
    }
    
    else if ($checkPwd === true) {
        session_start();
        $_SESSION["userid"] = $uidExists['usersId'];
        $_SESSION["useruid"] = $uidExists['usersUid'];
        header('location: ../index.php');
        exit();
    }
?>