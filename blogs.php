<?php
include 'header.php';
include 'includes/dbh.inc.php';
  ?>
  <div class="container">
  <?php
  $post_id = $_GET['blog'];
  // If user is logged in...
  if (isset($_SESSION['u_id'])) {
    // Find the blog in database
    $sql  ="SELECT * FROM blogs WHERE post_id ='$post_id'";
    // result = what is found in the database
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    // If there are no results in the database...
    if ($resultCheck < 1) {
      ?>
        <p>Blog not found.</p>
      <?php
    }else{
      $row = mysqli_fetch_assoc($result);
      $user_id = $row['post_author'];
      $sql  ="SELECT * FROM `users` WHERE `user_id` = $user_id";
      // result = what is found in the database
      $Userresult = mysqli_query($conn, $sql);
      $UserresultCheck = mysqli_num_rows($Userresult);
      // If there are no results in the database...
      if ($UserresultCheck < 1) {
        header("Location: http://localhost/project-website/index.php?user=nouser");
        exit();
      }else{
        $Userrow = mysqli_fetch_assoc($Userresult);
      ?>
      <div id="blog_post">
        <ul>
          <li> <?php echo $row['category'] ?> </li>
        </ul>
        <h1><?php echo $row['post_title'] ?> </h1>
        <?php if ($row['post_image']===NULL) {
        }else{ ?>
        <img src="uploads/blogs/<?php echo $row['post_image'] ?> " alt="">
      <?php } ?>
        <p>Posted by <a href="http://localhost/project-website/profile.php?user=<?php echo $Userrow['user_id'] ?>"> <em><?php echo $Userrow['user_uid'] ?></em></a> <span><?php echo $row['post_date'] ?></span> </p>
        <div id="buttons">
          <a class='btn btn-primary btn-sm'href="http://localhost/project-website">Back</a>
          <?php if ($_SESSION['u_id'] == $row['post_author']): ?>
            <form class="" action="includes/blogs/delete_blog.inc.php  <?php echo '?blog='. $row['post_id']?>" method="post">
              <button class='btn btn-danger btn-sm'type="submit" name="submit">Delete</button>
            </form>
            <a class='btn btn-warning btn-sm' href="blog_update.php <?php echo '?blog='. $row['post_id']?>" >Update</a>
          <?php endif; ?>
        </div>
        <p id='post_body'> <?php echo $row['post_body'] ?> </p>
      </div>
    </div>
    <?php
    }
  }
}else{
    header("Location: index.php?loggedin=false");
    exit();
}
include 'footer.php' ?>
</div>
