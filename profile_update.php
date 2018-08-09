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
  <div class="container-fluid">
    <div class='container' id="user-box">
      <form class="" action="includes/users/update_profile.inc.php" method="post">
        <input id='uid-edit'class='form-control'type="text" name="uid" value="<?php echo $row['user_uid']?>">
        <input type="text" id='about-edit' class='form-control'name="about" value="<?php echo $row['user_about'] ?>">
        <div class="collapse" id="moreSettings">
          <div class="card card-body">
            <label>First name</label>
            <input class='form-control'type="text" name="first" value="<?php echo $row['user_first'] ?>">
            <label>Last name</label>
            <input class='form-control'type="text" name="last" value="<?php echo $row['user_last'] ?>">
            <label>Email</label>
            <input class='form-control'type="text" name="email" value="<?php echo $row['user_email'] ?>">
          </div>
        </div>
        <button class='btn btn-primary btn-sm'type="submit" name="submit">Update</button>
      </form>
      <a id="fullSettings" data-toggle="collapse" href="#moreSettings" role="button" aria-expanded="false" aria-controls="moreSettings">
        Full Settings
      </a>
        <div class="buttons">
          <form action="includes/user/delete_profile.inc.php  <?php echo '?user='. $row['user_id']?>" method="post">
            <button class='btn btn-danger btn-sm'type="submit" name="submit">Delete</button>
          </form>

          <a class='btn btn-warning btn-sm' href="profile.php <?php echo '?user='. $row['user_id']?>" >Go Back</a>
        </div>

    </div>
            <?php
          }else{
            header("Location: index.php?user=error");
          }
        }
     ?>
  </div>
</section>
<?php
    }else{
  header("Location: index.php?user=notloggedin");
}
include 'footer.php';
