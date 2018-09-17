<?php
    session_start();

    if (!isset($_POST['submit'])) {
        header("Location: ../home.php?login=error");
        exit();
    } else {
        include_once('dbh.inc.php');
    
        $username=mysqli_real_escape_string($dbConnection,$_POST['username']);
        $pass=mysqli_real_escape_string($dbConnection,$_POST['password']);
                    
        //Some error handling

        if (empty($username) || empty($pass)){
            header("Location: ../home.php?login=empty");
            exit();
        } else {
            $sql = "SELECT * FROM users WHERE user_username='$username' OR user_email='$username';";
            $result = mysqli_query($dbConnection, $sql);
            $resultCheck = mysqli_num_rows($result);
            //print_r($resultCheck);
            if ($resultCheck < 1){
                header("Location: ../home.php?login=usererror");
                exit();
            } else {
                if ($row = mysqli_fetch_assoc($result)) {
                    //De-hashing
                    //print_r($row);
                    $hashedPwdCheck = password_verify($pass, $row['user_password']);
                    if ($hashedPwdCheck == false) {
                        header("Location: ../home.php?login=passworderror");
                        exit();
                    } elseif ($hashedPwdCheck == true){
                        //login the user
                        $_SESSION['id'] = $row['user_id'];
                        $_SESSION['username'] = $row['user_username'];
                        $_SESSION['email'] = $row['user_email'];
                        $_SESSION['password'] = $row['user_password'];

                        header("Location: ../home.php?login=success");
                        exit();
                    }
                }
            }
        }
    }
?>