<?php include_once 'header.php' ?>

    <section class="main-container">
        <div class="main-wrapper">
          <button type="button" name="button" onclick="openClose()">Show/Hide Top Bar</button>
            <h2>Home</h2>
            <?php
            if (isset($_SESSION['username'])){
                include 'task.php' ;
                $error="";
            } else {
              echo "<h2>Please login to add your task to the list</h2>";
            };
            ?>
        </div>
    </section>

<?php include_once 'footer.php' ?>
