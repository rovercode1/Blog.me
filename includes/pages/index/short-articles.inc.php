<?php
  $sql = "SELECT * FROM `blogs` WHERE CHAR_LENGTH(`post_body`) < 2000 ORDER BY `post_id` DESC LIMIT 2";
  $result = mysqli_query($conn, $sql);
  while ($row = mysqli_fetch_assoc($result)) {
    $body = $row['post_body'];
      ?>
      <div id="article">
        <div class="img">
          <img src="uploads/blogs/<?php echo $row['post_image'] ?>" alt="">
          <a href="blogs.php <?php echo '?blog='. $row['post_id']?>" ><h5><?php echo $row['post_title'] ?> </h5></a>
        </div>
      </div>
      <?php
    }
 ?>
