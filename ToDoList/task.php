<?php
  session_start();
  include_once ('includes/dbh.inc.php');
//  include_once ('includes/dbh.inc.php');
//  $dbServerName="localhost";
//  $dbUsername="root";
//  $dbPassword="password";
//  $dbName="todolist";

//  $dbConnection = mysqli_connect($dbServerName, $dbUsername, $dbPassword, $dbName);

//  if (!$dbConnection) {
//      die("Connection failed: " . mysqli_connect_error());
//  }
//  echo "Connected successfully";


  if (isset($_POST['submit'])){
    $task = ($_POST['task']);
    $uid = $_SESSION['id'];
    if (empty($task)) {
      header('Location:home.php?task=empty');
    } else {
      $qry = "INSERT INTO tasks (task_text, user_id) VALUES ('$task','$uid');";
      mysqli_query($dbConnection, $qry);
      header('Location:home.php?list=updated');
      }
    }
  $user_id = $_SESSION['id'];
  $query="SELECT * FROM tasks WHERE user_id='$user_id';";
    $user_tasks=mysqli_query($dbConnection, $query);

  //How to delete the task
  if (isset($_GET['delete_task'])){
    $task_id = $_GET['delete_task'];
    $delete_task= "DELETE FROM tasks WHERE task_id=$task_id";
    mysqli_query($dbConnection, $delete_task);
    header('Location:home.php?list=updated');
  }

?>

<div class="task-heading">
    <h2>Todo list</h2>
</div>

<form class="task-form" action="task.php" method="post">
  <?php
    $url="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    if (strpos($url, "task=empty") == true) {
      echo "<p class='error'> Please enter something in the task field!";
    } 
    elseif (strpos($url, "list=updated") == true) {
      echo "<p class='success'> DB field updated!";
    }
  ?>
  <input type="text" name="task" class="task-input">
  <button type="submit" name="submit" class="task-button">Add task</button>

</form>

<table>
  <thead>
    <tr>
      <th>#</th>
      <th>Task</th>
      <th>Action</th>
    </tr>
  </thead>

  <tbody>
    <?php $i=1; while ($row=mysqli_fetch_assoc($user_tasks)) { ?>
    <tr>
      <td><?php echo $i;?></td>
      <td class="task"><?php echo $row['task_text'];?></td>
      <td class="delete">
          <a href="task.php?delete_task=<?php echo $row['task_id'];?>">X</a>
      </td>
    </tr>
    <?php $i++; }; ?>
  </tbody>
</table>
