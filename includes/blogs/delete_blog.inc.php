<?php
session_start();
// If submit button has been clicked...
if (isset($_SESSION['u_id'])) {
  if (isset($_POST['submit'])) {
    include_once '../dbh.inc.php';
    $post_id = $_GET['blog'];
    // If user is logged in...
    // Find the blog in database
    $sql  ="SELECT * FROM blogs WHERE post_id ='$post_id'";
    // result = what is found in the database
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    // If there are no results in the database...
    if ($resultCheck < 1) {
      header("Location: http://localhost/project-website/index.php?blog=error");
      exit();
    }else{
      $row = mysqli_fetch_assoc($result);
      // Delete the blog into the database
      $sql = "DELETE FROM `blogs` WHERE `blogs`.`post_id` = $post_id;";
      mysqli_query($conn, $sql) or die(mysqli_error($conn));
      header("Location: http://localhost/project-website/index.php?delete_blog=success");
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
