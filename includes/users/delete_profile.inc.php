<?php
session_start();
// If submit button has been clicked...
if (isset($_SESSION['u_id'])) {
  if (isset($_POST['submit'])) {
    $fullurl = 'http://localhost/project-website'
    include_once '../dbh.inc.php';
    $currentUser = $_SESSION['u_id'];
    $user_id = $_GET['user'];
    // If user is logged in...
    // Find the user in database
    $sql  ="SELECT * FROM user WHERE user_id ='$user_id'";
    // result = what is found in the database
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    // If there are no results in the database...
    if ($resultCheck < 1) {
      header("Location: $fullurl/index.php?user=nouser");
      exit();
    }else{
      $userPriv = "SELECT priv FROM user_priv where `id` = $currentUser";
      $privresult = mysqli_query($conn, $userPriv);
      $privcheck = mysqli_num_rows($privresult);
      while ($userpriv = mysqli_fetch_assoc($privresult)) {
      if ($currentUser == $user_id || $userpriv['priv'] = 2 ) {
        $row = mysqli_fetch_assoc($result);
        // Delete users blogs
        $blogs = "DELETE FROM `blogs` WHERE `blogs`.'author' = $user_id";
        mysqli_query($conn, $blogs);

        // Delete the user in the database
        $sql = "DELETE FROM `users` WHERE `users`.`user_id` = $user_id;";
        unlink('../../uploads/blogs/'.$row['user_av']);
        mysqli_query($conn, $sql) or die(mysqli_error($conn));
        header("Location: $fullurl/index.php?delete_user=success");
        exit();
      }else{
        header("Location: $fullurl/index.php?error");
        exit();}
      }
    }
  }
  else
  {
    header("Location: $fullurl/index.php");
    exit();
  }
}
else{
  header("Location: $fullurl/index.php");
  exit();
}
