<?php include_once 'header.php' ?>

    <section class="main-container">
        <div class="main-wrapper">
            <h2>Signup</h2>
            <form action="includes/signup.inc.php" method="post" class="signup-form">
            <?php
               /*$url="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
               if (strpos($url, "task=empty") == true) {
               echo "<p class='error'> Please enter something in the task field!";
               }*/
               
               if ($_GET['signup'] == "empty"){
                    echo "<p class='error'> Please enter information in all fields!</p>";
                } elseif ($_GET['signup'] == "invalid"){
                    echo "<p class='error'> Your username has invalid characters in it!</p>";
                } elseif ($_GET['signup'] == "password"){
                    echo "<p class='error'> Your passwords don't match!</p>";
                } elseif ($_GET['signup'] == "email"){
                    echo "<p class='error'> Your email is not entered in correct format!</p>";
                } elseif ($_GET['signup'] == "datataken"){
                    echo "<p class='error'> That username is already taken!</p>";
                }
            ?>
                <input type="text" name="username" placeholder="Username">
                <input type="text" name="email" placeholder="Email">
                <input type="password" name="password1" placeholder="Password">
                <input type="password" name="password2" placeholder="Confirm password">
                <button type="submit" name="submit">Sign up</button>
            </form>
        </div>
    </section>

    <?php include_once 'footer.php' ?>
