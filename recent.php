<?php include 'header.php';
// If user is signed in
if (isset($_SESSION['u_id'])) {
  $sql = "SELECT * FROM blogs";
  $result = mysqli_query($conn, $sql);
  $total = mysqli_num_rows($result);
    if ($total < 1) {?>
      <p>Blog not found.</p>
    <?php
      }else{
    $limit = 3;
    $offset = $total + 1 - $limit;
    $blogs ="SELECT * FROM blogs LIMIT $limit OFFSET $offset";
    $Blogresult = mysqli_query($conn, $blogs);
    $Blogtotal = mysqli_num_rows($Blogresult);
      if ($Blogtotal < 1) {  ?>
      <p>Blog not found.</p>
      <?php
      }else{
        while ($row = mysqli_fetch_assoc($Blogresult)) {
        $user_id = $row['post_author'];
        $sql  ="SELECT * FROM `users` WHERE `user_id` = $user_id";
        // result = what is found in the database
        $Userresult = mysqli_query($conn, $sql);
        $UserresultCheck = mysqli_num_rows($Userresult);
        // If there are no results in the database...
          if ($UserresultCheck < 1) {
            header("Location: http://localhost/news-website/index.php?user=nouser");
            exit();
          }else{
            $Userrow = mysqli_fetch_assoc($Userresult);
            ?>
            <div class="col-lg-12 col-md-12">
            <div class="blog_desc">
            <a href="blogs.php <?php echo '?blog='. $row['post_id']?>" ><h4><?php echo $row['post_title'] ?> </h4></a>
            <p>Posted by <a href="http://localhost/news-website/profile.php?user=<?php echo $row['post_author']?>"> <em><?php echo $Userrow['user_uid'] ?></em></a></p>
            <p><?php echo $row['post_date'] ?></p>
            </div>
            </div>
        <?php }
        }
      }
    }

  }else{
    header("Location: ../../index.php");
    exit();
  }
include 'footer.php';?>
