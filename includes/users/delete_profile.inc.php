<?php
session_start();
// If submit button has been clicked...
if (isset($_SESSION['u_id'])) {
  if (isset($_POST['submit'])) {
    include_once '../dbh.inc.php';
    $user_id = $_GET['user'];
    // If user is logged in...
    // Find the user in database
    $sql  ="SELECT * FROM user WHERE user_id ='$user_id'";
    // result = what is found in the database
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    // If there are no results in the database...
    if ($resultCheck < 1) {
      header("Location: http://localhost/project-website/index.php?user=nouser");
      exit();
    }else{
      $row = mysqli_fetch_assoc($result);
      // Delete the user in the database
      $sql = "DELETE FROM `users` WHERE `users`.`user_id` = $user_id;";
      unlink('../../uploads/blogs/'.$row['user_av']);
      mysqli_query($conn, $sql) or die(mysqli_error($conn));
      header("Location: http://localhost/project-website/index.php?delete_user=success");
      exit();
    }
  }
  else
  {
    header("Location: ../../index.php");
    exit();
  }
}
else{
  header("Location: ../../index.php");
  exit();
}
