<?php
session_start();
// If submit button has been clicked...
if (isset($_SESSION['u_id'])) {
  if (isset($_POST['submit'])) {
    include_once '../dbh.inc.php';
    // User inputs
    $user_id = $_SESSION['u_id'];
    $first = mysqli_real_escape_string($conn,$_POST['first']);
    $last = mysqli_real_escape_string($conn,$_POST['last']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $uid = mysqli_real_escape_string($conn,$_POST['uid']);
    $about = mysqli_real_escape_string($conn,$_POST['about']);

    if (empty($first) ||empty($last) || empty($email) || empty($uid) || empty($about)) {
      header("Location: ../../update_profile.php?user=empty");
      exit();
    }  else{
      // Check if input characters are vaild
      if (!preg_match("/^[a-zA-Z*$]*$/",$first) || !preg_match("/^[a-zA-Z*$]*$/",$last)){
        header("Location: ../../update_profile.php?user=invalid");
        exit();
      }else{
      // Check if email is vaild
      if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        header("Location: ../../update_profile.php?user=invalidemail");
        exit();
      }else{
        $sql = "SELECT * FROM users WHERE user_uid = $user_uid";
        $result = mysqli_query($conn, $sql);
        // Check if there is a user that matches the uid
        $resultCheck = mysqli_num_rows($result);
        // If there is already a user with that Username
        // Throw an error
        if ($resultCheck > 0) {
          header("Location: ../../update_profile.php?user=usertaken");
          exit();
        }else{
        // Insert the user into the database
        $sql = "UPDATE `users` SET `user_first` = '$first', `user_last` = '$last', `user_email` = '$email', `user_uid` = '$uid', `user_about` = '$about' WHERE `users`.`user_id` = $user_id;";
        mysqli_query($conn, $sql);
        $_SESSION['u_first'] = $first;
        $_SESSION['u_last'] = $last;
        $_SESSION['u_email'] = $email;
        $_SESSION['u_uid'] = $uid;

        $file = $_FILES['UploadImage'];
        $fileName = $_FILES['UploadImage']['name'];
        $fileTmpName = $_FILES['UploadImage']['tmp_name'];
        $fileSize = $_FILES['UploadImage']['size'];
        $fileError = $_FILES['UploadImage']['error'];
        $fileType = $_FILES['UploadImage']['type'];

        $fileExt = explode('.',$fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg','jpeg','png','gif','bmp');

        $user  ="SELECT * FROM users WHERE user_id = $user_id";
        // result = what is found in the database
        $resultUser = mysqli_query($conn, $user);
        $resultCheckUser = mysqli_num_rows($resultUser);
        // If there are no results in the database...
        if ($resultCheckUser < 1) {
          header("Location: ../../index.php?user=false");
          exit();
        }else{
          if ($row = mysqli_fetch_assoc($resultUser)) {
            if ($fileSize === 0) {
              header("Location: ../../index.php?update_profile=success");
              exit();
            }else{
              if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                  if ($fileSize < 1000000) {
                    $fileNameNew = $user_id ."_" . uniqid('',true)."."."$fileActualExt";
                    $fileDestination = '../../uploads/users/'.$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    $img = "UPDATE `users` SET `user_av` = '$fileNameNew' WHERE `users`.`user_id` = $user_id;";
                    mysqli_query($conn, $img);
                    header("Location: ../../index.php?update_profile=success");
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
        }
      }
    }
  }else{
  header("Location: ../../index.php");
  exit();
  }
}else{
header("Location: ../../index.php");
exit();
}
