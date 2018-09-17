<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Registration page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <header>
        <nav>
            <div class="main-wrapper">
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="signup.php">Registration page</a></li>
                </ul>
                <div class="nav-login">

                    <?php
                        if(isset($_SESSION['id'])){
                            echo '<form action="includes/logout.inc.php" method="POST">
                            <button type="submit" name="submit">Logout</button>
                            </form>';
                        } else {
                            echo '<form action="includes/login.inc.php" method="POST">
                            <input type="text" name="username" placeholder="Username/email">
                            <input type="password" name="password" placeholder="Password">
                            <button type="submit" name="submit">Login</button>
                        </form>';
                        }

                        ?>
                    <a href="signup.php">Sign up</a>
                </div>
            </div>
        </nav>
    </header>
