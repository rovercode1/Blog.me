<?php
session_start();
// If submit button has been clicked...
if (isset($_SESSION['u_id'])) {
  if (isset($_POST['submit'])) {
    include_once '../dbh.inc.php';
    // User inputs
      //  mysqli_real_escape_string =
      // escapes special characters in a string for use in an SQL statement.
    $author = $_SESSION["u_id"];
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $body = mysqli_real_escape_string($conn,$_POST['body']);
    $category = mysqli_real_escape_string($conn,$_POST['category']);
    $date = date("Y-m-d H:i:s");
      // Error handlers
      // Check for empty fields
    if (empty($title) ||empty($body)) {
        header("Location: ../../blog_form.php?field=empty");
      exit();
    }
    else{
    $file = $_FILES['UploadImage'];
    $fileName = $_FILES['UploadImage']['name'];
    $fileTmpName = $_FILES['UploadImage']['tmp_name'];
    $fileSize = $_FILES['UploadImage']['size'];
    $fileError = $_FILES['UploadImage']['error'];
    $fileType = $_FILES['UploadImage']['type'];

    $fileExt = explode('.',$fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg','jpeg','png','gif','bmp');

    $sql = "INSERT INTO blogs (post_author, post_title, post_body, post_date, category) VALUES ( '$author', '$title', '$body', '$date','$category');";
    mysqli_query($conn, $sql);
    $blog  ="SELECT * FROM blogs WHERE post_date ='$date' AND post_author ='$author' AND post_title = '$title' AND post_body = '$body' AND category = '$category'";
    // result = what is found in the database
    $resultBlog = mysqli_query($conn, $blog);
    $resultCheckBlog = mysqli_num_rows($resultBlog);
    // If there are no results in the database...
    if ($resultCheckBlog < 1) {
      header("Location: ../../index.php?blog_form=error");
      exit();
    }else{
      if ($row = mysqli_fetch_assoc($resultBlog)) {
          $id = $row['post_id'];
          if ($fileSize === 0) {
            header("Location: ../../index.php?blog_form=success");
            exit();
          }else{
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
                }else{
                  echo "Your file is too big";}
                }else{
                  echo "Error";}
                }else {
                  echo 'You cannot upload files of this type.';}
          }
        }else {
          echo 'error';}
        }
      }
    }else{
      header("Location: ../../index.php?");
      exit();}
  }else{
    header("Location: ../../index.php?");
    exit();
  }
// {
//   header("Location: ../../index.php");
//   exit();
// // }
