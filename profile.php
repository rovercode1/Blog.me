<?php include 'header.php';
// If user is signed in
if (isset($_SESSION['u_id'])) {
    $user_id = $_GET['user'];
    // If user is logged in...
    // Find the user in database
    $sql = "SELECT *  FROM `users` WHERE `user_id` = $user_id";
    // result = what is found in the database
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    // If there are no results in the database...
    if ($resultCheck < 1) {
      header("Location: http://localhost/project-website/index.php?user=nouser");
      exit();
    }else{
      $row = mysqli_fetch_assoc($result);
  ?>
  <div class="container-fluid">
    <div id="user-box">
      <p><?php echo $row['user_uid']?></p>
    </div>
  </div>
<?php
  }
}
else{
header("Location: ../../index.php");
exit();
}

 include 'footer.php';

 ?>
