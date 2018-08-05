<?php
// If submit button has been clicked...
if (isset($_POST['submit'])) {
  include_once '../dbh.inc.php';
  // User inputs
    //  mysqli_real_escape_string =
    // escapes special characters in a string for use in an SQL statement.
  $first = mysqli_real_escape_string($conn,$_POST['first']);
  $last = mysqli_real_escape_string($conn,$_POST['last']);
  $email = mysqli_real_escape_string($conn,$_POST['email']);
  $uid = mysqli_real_escape_string($conn,$_POST['uid']);
  $pwd = mysqli_real_escape_string($conn,$_POST['pwd']);
    // Error handlers
    // Check for empty fields
  if (empty($first) ||empty($last) || empty($email) || empty($uid) || empty($pwd)) {
    header("Location: ../../signup.php?signup=empty");
    exit();
  }
  else{
      // Check if input characters are vaild
    if (!preg_match("/^[a-zA-Z*$]*$/",$first) || !preg_match("/^[a-zA-Z*$]*$/",$last)){
      header("Location: ../../signup.php?signup=invalid");
          exit();
    }else{
        // Check if email is vaild
      if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        header("Location: ../../signup.php?signup=invalidemail");
            exit();
      }else{
        $sql = "SELECT * FROM users WHERE user_uid = '$uid'";
        $result = mysqli_query($conn, $sql);
          // Check if there is a user that matches the uid
        $resultCheck = mysqli_num_rows($result);
          // If there is already a user with that Username
          // Throw an error
        if ($resultCheck > 0) {
          header("Location: ../../signup.php?signup=usertaken");
          exit();
        }else{
            // Hashing password
          $hashedpwd = password_hash($pwd, PASSWORD_DEFAULT);
            // Insert the user into the database
          $sql = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_pwd) VALUES ( '$first', '$last', '$email', '$uid', '$hashedpwd');";
          mysqli_query($conn, $sql);
          header("Location: ../../index.php?signup=success");
          exit();
        }
      }
    }
  }
}else{
  header("Location: ../../signup.php");
  exit();
}
