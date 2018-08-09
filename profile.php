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
        <div class="img">
          <img src="https://www.mycustomer.com/sites/all/themes/pp/img/default-user.png" alt="">
        </div>
        <div id="user">
          <h1> <em><?php echo $row['user_uid']?></em>  <?php if ($_SESSION['u_id'] == $row['user_id']): ?>
            <a href="profile_update.php <?php echo '?user='. $row['user_id']?>" ><i class="fas fa-edit"></i></a>
          <?php endif; ?></h1>
          <h6> <?php echo $row['user_about'] ?> </h6>
        </div>
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
    <?php
    }
  }
  else{
    header("Location: ../../index.php");
    exit();
  }
include 'footer.php';
?>
