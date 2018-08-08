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
      <h1> <em><?php echo $row['user_uid']?></em></h1>
      <h6> <?php echo $row['user_about'] ?> </h6>
      <?php if ($_SESSION['u_id'] == $row['user_id']): ?>
        <div class="buttons">
          <form class="" action="includes/user/delete_profile.inc.php  <?php echo '?user='. $row['user_id']?>" method="post">
            <button class='btn btn-danger btn-sm'type="submit" name="submit">Delete</button>
          </form>

          <a class='btn btn-warning btn-sm' href="profile.php <?php echo '?user='. $row['user_id']?>" >Go Back</a>
        </div>
      <?php endif; ?>
    </div>
    <?php
      // Find the blog in database
      $blogs  ="SELECT * FROM blogs WHERE post_author =$user_id";
      // result = what is found in the database
      $Blogresult = mysqli_query($conn, $blogs);
      $BlogresultCheck = mysqli_num_rows($Blogresult);
      // If there are no results in the database...
      if ($BlogresultCheck < 1) {
        ?>
          <h2 class='text-center' style="margin-bottom: 30px;">Blog(s) not found.</h2>
        <?php }
        else{
          while ($row = mysqli_fetch_assoc($Blogresult)) {
            ?>
            <div class="container">
              <div class="row">
                <div class="col-lg-12">
                  <a id='blog-link' href="blogs.php <?php echo '?blog='. $row['post_id']?>">
                    <div id="user-blogs">
                      <h4> <?php echo $row['post_title'] ?> </h4>
                      <p class='post_body'> <?php echo $row['post_body'] ?> </p>
                    </div>
                  </a>
                </div>
              </div>
            </div>
            <?php
          }?>
          <?php
        }
     ?>
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
