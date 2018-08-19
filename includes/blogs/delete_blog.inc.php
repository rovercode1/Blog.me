<?php
session_start();
// If submit button has been clicked...
if (isset($_SESSION['u_id'])) {
  include_once '../dbh.inc.php';
  $id = $_SESSION['u_id'];
  $privSql = "SELECT * FROM `user_priv` WHERE id = $id";
  $resultPriv = mysqli_query($conn, $privSql);
  while($privrow = mysqli_fetch_assoc($resultPriv)){
    $author = $privrow['author'];
    $priv = $privrow['priv'];
    if ($priv > 0) {
    if (isset($_POST['submit'])) {
      $post_id = $_GET['blog'];
      // If user is logged in...
      // Find the blog in database
      $sql  ="SELECT * FROM blogs WHERE post_id ='$post_id'";
      // result = what is found in the database
      $result = mysqli_query($conn, $sql);
      $resultCheck = mysqli_num_rows($result);
      // If there are no results in the database...
      if ($resultCheck < 1) {
        header("Location: http://localhost/news-website/index.php?blog=error");
        exit();
      }else{
        $row = mysqli_fetch_assoc($result);
        // Delete the blog into the database
        $sql = "DELETE FROM `blogs` WHERE `blogs`.`post_id` = $post_id;";
        unlink('../../uploads/blogs/'.$row['post_image']);
        mysqli_query($conn, $sql) or die(mysqli_error($conn));
        header("Location: http://localhost/news-website/index.php?delete_blog=success");
        exit();
          }
          // button was pressed.
        }else{
        header("Location: ../../index.php");
        exit();}
        // User has priv
      }else{
      header("Location: ../../index.php");
      exit();}
      }
      // User is signed in
    }else{
    header("Location: ../../index.php");
    exit();
    }
