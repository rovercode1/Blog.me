<?php
session_start();
// If submit button has been clicked...
if (isset($_SESSION['u_id'])) {
  if (isset($_POST['submit'])) {
    include_once 'dbh.inc.php';
    // User inputs
      //  mysqli_real_escape_string =
      // escapes special characters in a string for use in an SQL statement.
    $author = $_SESSION["u_uid"];
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $url = mysqli_real_escape_string($conn,$_POST['url']);
    $body = mysqli_real_escape_string($conn,$_POST['body']);
    $date = date("l jS \of F Y h:i:s A");
      // Error handlers
      // Check for empty fields
    if (empty($title) ||empty($body)) {
        header("Location: ../blog_form.php?signup=empty");
      exit();
    }
    else{
        // Check if input characters are vaild
      if (!preg_match("/^[a-zA-Z*$]*$/",$first) || !preg_match("/^[a-zA-Z*$]*$/",$last)){
        header("Location: ../blog_form.php?blog_form=invalidChar");
      }else{
            // Insert the user into the database
            $sql = "INSERT INTO blogs (post_author, post_title, post_body, post_date) VALUES ( '$author', '$title', '$body', '$date');";
            mysqli_query($conn, $sql);
            header("Location: ../index.php?blog_form=success");
            exit();
          }
        }
    }
  else
  {
    header("Location: ../index.php");
    exit();
  }
}else
{
  header("Location: ../index.php");
  exit();
}