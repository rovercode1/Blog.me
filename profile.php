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
    $row = mysqli_fetch_assoc($result);?>
    <div class="container-fluid">
      <div class='container' id="user-box">
        <h1> <em><?php echo $row['user_uid']?></em></h1>
        <h6> <?php echo $row['user_about'] ?> </h6>
        <?php if ($_SESSION['u_id'] == $row['user_id']): ?>
          <form class="" action="includes/user/delete_profile.inc.php  <?php echo '?user='. $row['user_id']?>" method="post">
            <button class='btn btn-danger'type="submit" name="submit">Delete</button>
          </form>
        <a class='btn btn-warning' href="user_update.php <?php echo '?user='. $row['user_id']?>" >Update</a>
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
            <p>Blog not found.</p>
          <?php }
          else{
            while ($row = mysqli_fetch_assoc($Blogresult)) {
              ?>
              <div class="container">
                <div class="row">
                  <div class="col-lg-12">
                    <div id="user-blogs">
                    <a href="blogs.php <?php echo '?blog='. $row['post_id']?>"><h2> <?php echo $row['post_title'] ?> </h2></a>  
                    </div>
                  </div>
                </div>
              </div>
              <?php
            }?>
            <?php
          }
       ?>
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
