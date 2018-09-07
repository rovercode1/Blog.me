<?php
while ($row = mysqli_fetch_assoc($Blogresult)) {
  $category = explode(',',$row['category']);?>
  <div class=" blog">
    <h6 class='tag'>Posted in
    <?php foreach ($category as $cat ) {
      if (sizeof($category) > 1) {
        ?>
          <a href='<?php echo $Url.$cat?>'><?php print_r($cat)?></a>
          /
        <?php
      }elseif (sizeof($category)==1) {?>
          <a href='<?php echo $Url.$cat?>'><?php print_r($cat)?></a>
        <?php
      }
    }
    ?>
    </h6>
    <div class="archive-block">
      <img src="uploads/blogs/<?php echo $row['post_image'] ?>" alt="">
      <a href="blogs.php <?php echo '?blog='. $row['post_id']?>" ><p><?php echo $row['post_title'] ?> </p></a>
    </div>
    <p class='tag'><?php echo $row['post_date'] ?></p>
    <?php
      $user_id = $row['post_author'];
      $sql = "SELECT * FROM users WHERE `user_id` = $user_id";
      $result = mysqli_query($conn, $sql);
      $resultCheck = mysqli_num_rows($result);
      if ($resultCheck < 1) {
        header("Location: index.php?user=false");
        exit();
      }else{
        while ($userrow = mysqli_fetch_assoc($result)) {
        ?>
        <p class='tag'>Posted by <a href="profile.php?user=<?php echo $user_id ?>"> <?php echo $userrow['user_uid'] ?></a></p>
        <?php
        }
      }
     ?>
    </div>
  <?php
    }
  
 ?>
