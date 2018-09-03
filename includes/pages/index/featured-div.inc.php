<?php
$count = 0;
$activeTab = 'active show';
$id = 'f';
$sql = "SELECT * FROM `blogs` WHERE `category` LIKE '%Featured%'";
$result = mysqli_query($conn, $sql);
$total = mysqli_num_rows($result);
if ($total < 1) {?>
  <p>Blog not found.</p>
<?php }
else{
$limit = 3;
$offset = $total + 1 - $limit;
$blogs ="SELECT * FROM `blogs` WHERE `category` LIKE '%Featured%'";
$Blogresult = mysqli_query($conn, $blogs);
$Blogtotal = mysqli_num_rows($Blogresult);
if ($Blogtotal < 1) {?>
  <p>Blog(s) not found.</p>
<?php }
else{
  ?>
  <div class="tab-content" id="myTabContent">
  <?php while ($row = mysqli_fetch_assoc($Blogresult)) {
    $count = $count + 1; ?>
    <div class="tab-pane fade <?php echo $activeTab ?>" id="<?php echo $id.$count ?>" role="tabpanel" aria-labelledby="<?php echo $id.$count.'-tab' ?>">
      <a href="blogs.php <?php echo '?blog='. $row['post_id']?>" ><h2><?php echo $row['post_title'] ?> </h2></a>
      <div id="featured">
        <img src="uploads/blogs/<?php echo $row['post_image'] ?>" alt="">
        <p class='featured_body'> <?php echo $row['post_body'] ?> </p>
      </div>
    </div>
    <?php
        $activeTab = '';} ?>
    </div>
  <?php }
}
?>
