<?php include_once 'header.php' ?>
<?php
  session_start();
  include_once ('includes/dbh.inc.php');

  $task_id=$_GET['update_task'];
  $query="SELECT * FROM tasks WHERE task_id='$task_id';";
  $user_tasks=mysqli_query($dbConnection, $query);

  $row=mysqli_fetch_assoc($user_tasks);
  //Test the content of my array
  //var_dump($row); echo "<br><br><br>";
  //var_dump($_SESSION); echo "<br><br><br>";

    if (!isset($_SESSION['oktoupdate'])) {
      if (($row['user_id']) == $_SESSION['id'] ) {
        $_SESSION['oktoupdate'] = true;
        $_SESSION['task_id'] = $task_id;
      }
    }

  if (isset($_POST['submit'])){
    $task = ($_POST['task']);
    if (empty($task)) {
      header('Location:updatetask.php?task=empty');
    } elseif ($_SESSION['oktoupdate']){
      echo $task;
      $task_id = $_SESSION['task_id'];
      $qry = "UPDATE tasks SET task_text='$task' WHERE task_id='$task_id';";
      mysqli_query($dbConnection, $qry);
      unset($_SESSION['task_id']);
      unset($_SESSION['oktoupdate']);
      header('Location:home.php?list=updated');
    }
  }
?>

    <section class="main-container">
        <div class="main-wrapper">
          <button type="button" name="button" onclick="openClose()">Show/Hide Top Bar</button>
            <h2>Update task</h2>
            <?php
            if (isset($_SESSION['username'])){
                //include 'task.php' ; ?>
                <form class="task-form" action="updatetask.php" method="post">
                  <?php
                    $url="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    if (strpos($url, "task=empty") == true) {
                      echo "<p class='error'> Please enter something in the task field!";
                    }
                    elseif (strpos($url, "list=updated") == true) {
                      echo "<p class='success'> DB field updated!";
                    }
                  ?>
                  <input type="text" name="task" class="task-input" value="<?php echo $row["task_text"]?>">
                  <button type="submit" name="submit" class="task-button">Update task</button>

                </form>

              <?php  $error="";
            } else {
              echo "<h2>Please login to add your task to the list</h2>";
            };
            ?>
        </div>
    </section>

<?php include_once 'footer.php' ?>
