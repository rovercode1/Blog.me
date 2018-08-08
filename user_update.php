<?php include 'header.php'; include 'includes/dbh.inc.php';
if (isset($_SESSION['u_id'])) {
  $user_id = $_GET['user'];
  $sql = "SELECT * FROM `users` WHERE `user_id` = $user_id";
  // result = what is found in the database
  $result = mysqli_query($conn, $sql);
  $resultCheck = mysqli_num_rows($result);
    // If there are no results in the database...
  if ($resultCheck < 1) {
      header("Location: index.php?blog=noblog");
      exit();
  }else{
    $row = mysqli_fetch_assoc($result);
    // If the current user is not the author
     // of the blog, redirect to home page.
    if($_SESSION['u_id'] == $row['user_id']){
?>
<section>
  <div class="container">
    <div id='signup' class="main-wrapper">
      <h2>Edit Profile</h2>
      <form  action="includes/users/update_profile.inc.php<?php echo '?user='. $row['user_id']?>" method="post">
        <label>First Name</label>
          <input class="form-control"type="text" name="first" placeholder="Enter first name" value='<?php echo $row['user_first'] ?>' required>
        <label>Last Name</label>
          <input class="form-control"type="text" name="last" placeholder="Enter last name" value='<?php echo $row['user_last'] ?>' required>
        <label>E-mail</label>
          <input class="form-control"type="text" name="email" placeholder="Enter email" value='<?php echo $row['user_email'] ?>' required>
        <label>Username</label>
          <input class="form-control"type="text" name="uid" placeholder="Enter username" value='<?php echo $row['user_uid'] ?>' required>
        <label>About</label>
          <input class="form-control"type="text" name="about" placeholder="About" value='<?php echo $row['user_about'] ?>' required>
        <button class="form-control btn btn-primary"type="submit" name="submit">Update</button>
      </form>
    </div>
  </div>
</section>
<?php
    }else{
      header("Location: index.php?user=error");
    }
  }
}else{
  header("Location: index.php?user=notloggedin");
}
include 'footer.php';
