<?php include 'header.php'; include 'includes/dbh.inc.php';
if (isset($_SESSION['u_id'])) {
  $user_id = $_GET['user'];
  $sql = "SELECT * FROM `users` WHERE `user_id` = $user_id";
  // result = what is found in the database
  $result = mysqli_query($conn, $sql);
  $resultCheck = mysqli_num_rows($result);
  // If there are no results in the database...
  if ($resultCheck < 1) {
    header("Location: index.php?blog=nouser");
    exit();
  }else{
    $row = mysqli_fetch_assoc($result);
    // If the current user is not the author
    // of the blog, redirect to home page.
    $userPriv = "SELECT priv FROM user_priv where `id` = $user_id";
    $privresult = mysqli_query($conn, $userPriv);
    $privcheck = mysqli_num_rows($privresult);
    while ($userpriv = mysqli_fetch_assoc($privresult)) {
      if($_SESSION['u_id'] == $row['user_id'] || $userpriv['priv'] = 2){
        include 'includes\pages\profile\update\profile-update-top.inc.php';
      }else{
      header("Location: index.php?user=error");
      }
    }
  }
}else{
header("Location: index.php?user=notloggedin");
}
include 'footer.php';
