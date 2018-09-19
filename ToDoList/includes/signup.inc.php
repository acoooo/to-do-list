<?php

if (!isset($_POST['submit'])) {
    header("Location: ../signup.php");
    exit();
} else {
    include_once('dbh.inc.php');

    $username= mysqli_real_escape_string($dbConnection,$_POST['username']);
    $email= mysqli_real_escape_string($dbConnection,$_POST['email']);
    $pass1= mysqli_real_escape_string($dbConnection,$_POST['password1']);
    $pass2= mysqli_real_escape_string($dbConnection,$_POST['password2']);

    //Some error handling

    if (empty($username) || empty($email) || empty($pass1) || empty($pass2)) {
        header("Location: ../signup.php?signup=empty");
        exit();
    } else {
        if (!preg_match("/^[a-zA-Z]*$/", $username) || !preg_match("/^[a-zA-Z]*$/", $username)){
            header("Location: ../signup.php?signup=invalid");
            exit();
        } else {
            if ($pass1 != $pass2){
                header("Location: ../signup.php?signup=password");
                exit();
            } else {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    header("Location: ../signup.php?signup=email");
                    exit();
                } else {
                    $sql = "SELECT * FROM users WHERE user_username='$username';";
                    $result = mysqli_query($dbConnection, $sql);
                    $queryCheck = mysqli_num_rows($result);
                    if ($queryCheck > 0) {
                        header("Location: ../signup.php?signup=datataken");
                        exit();
                    } else {
                        $hashedPassword=password_hash($pass1, PASSWORD_DEFAULT);
                        $sql = "INSERT INTO users (user_username, user_email, user_password) VALUES ('$username', '$email', '$hashedPassword');";
                        mysqli_query($dbConnection, $sql);
                        mysqli_close($dbConnection);
                        header("Location: ../signup.php?signup=success");
                        exit();
                    }
                }
            }
        }
    }

}

?>
