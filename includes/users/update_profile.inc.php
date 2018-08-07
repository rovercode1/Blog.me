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
              $sql = "UPDATE `users` SET `user_first` = '$first', `user_last` = '%last', `user_email` = '$email', `user_uid` = '$uid', `user_about` = '$about' WHERE `users`.`user_id` = $user_id;";
              mysqli_query($conn, $sql);
              header("Location: ../../index.php?update_profile=success");
              exit();
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
