<?php
session_start();
// If submit button has been clicked...
if (isset($_SESSION['u_id'])) {
  if (isset($_POST['submit'])) {
    include_once '../dbh.inc.php';
    // User inputs
      //  mysqli_real_escape_string =
      // escapes special characters in a string for use in an SQL statement.
    $post_id = $_GET['blog'];
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $body = mysqli_real_escape_string($conn,$_POST['body']);
    $category = mysqli_real_escape_string($conn,$_POST['category']);
      // Error handlers
      // Check for empty fields
    if (empty($title) ||empty($body)) {
        header("Location: ../../blog_form.php?field=empty");
      exit();
    }
    else{
        // Insert the user into the database
        $sql = "UPDATE `blogs` SET `post_title` = '$title', `post_body` = '$body', `category` = '$category' WHERE `blogs`.`post_id` = $post_id;";
      mysqli_query($conn, $sql) or die(mysqli_error($conn));
          header("Location: ../../index.php?update_blog_form=success");
          exit();
        }
    }
  else
  {
    header("Location: ../../index.php");
    exit();
  }
}else
{
  header("Location: ../../index.php");
  exit();
}
