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
      $file = $_FILES['Image'];
      $fileName = $_FILES['Image']['name'];
      $fileTmpName = $_FILES['Image']['tmp_name'];
      $fileSize = $_FILES['Image']['size'];
      $fileError = $_FILES['Image']['error'];
      $fileType = $_FILES['Image']['type'];

      $fileExt = explode('.',$fileName);
      $fileActualExt = strtolower(end($fileExt));
      $allowed = array('jpg','jpeg','png','gif','bmp');
      // Insert the user into the database
      $sql = "UPDATE `blogs` SET `post_title` = '$title', `post_body` = '$body', `category` = '$category' WHERE `blogs`.`post_id` = $post_id;";
      mysqli_query($conn, $sql) or die(mysqli_error($conn));

      $blog  ="SELECT * FROM blogs WHERE `post_id` = $post_id";
      // result = what is found in the database
      $resultBlog = mysqli_query($conn, $blog);
      $resultCheckBlog = mysqli_num_rows($resultBlog);
      // If there are no results in the database...
      if ($resultCheckBlog < 1) {
        header("Location: ../../index.php?blogupdate=error");
        exit();
          }else{
            if ($row = mysqli_fetch_assoc($resultBlog)) {
              $id = $row['post_id'];
              if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                  if ($fileSize < 1000000) {
                    $fileNameNew = $id ."_" . uniqid('',true)."."."$fileActualExt";
                    $fileDestination = '../../uploads/blogs/'.$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    $img = "UPDATE `blogs` SET `post_image` = '$fileNameNew' WHERE `blogs`.`post_id` = $id;";
                    mysqli_query($conn, $img);
                    header("Location: ../../index.php?blog_form=success");
                    exit();
                    }
                  }else{
                    echo "Your file is too big";
                  }
                }else {
                    header("Location: ../../index.php?blog_form=success");
                    exit();
                }
              }else {
                echo 'You cannot upload files of this type.';
              }
            }
        }
    }
  else{
    header("Location: ../../index.php");
    exit();}
}else{
  header("Location: ../../index.php");
  exit();}
