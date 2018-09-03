<?php
$sql = "SELECT * FROM `blogs` WHERE `category` LIKE '%Top%'";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
  ?>
  <img src="uploads/blogs/<?php echo $row['post_image'] ?>" alt="">
  <a href="blogs.php?blog=<?php echo $row['post_id'] ?>">
    <h4><?php echo $row['post_title'] ?></h4>
  </a>
  <p class='post_body'><?php echo $row['post_body'] ?></p>
  <?php
}

 ?>
