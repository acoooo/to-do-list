<?php include_once 'header.php' ?>

    <section class="main-container">
        <div class="main-wrapper">
            <h2>Signup</h2>
            <form action="includes/signup.inc.php" method="post" class="signup-form">
                <input type="text" name="username" placeholder="Username">
                <input type="text" name="email" placeholder="Email">
                <input type="password" name="password1" placeholder="Password">
                <input type="password" name="password2" placeholder="Confirm password">
                <button type="submit" name="submit">Sign up</button>
            </form>
        </div>
    </section>

    <?php include_once 'footer.php' ?>
