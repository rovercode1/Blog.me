<?php $count = 0;
$active = 'active show';
$id = 'f';
$sql = "SELECT * FROM `blogs` WHERE `category` LIKE '%Featured%'";
$result = mysqli_query($conn, $sql);
$total = mysqli_num_rows($result);
if ($total < 1) {?>
  <p>Blog not found.</p>
<?php }
else{
  $limit = 3;
  $blogs ="SELECT * FROM `blogs` WHERE `category` LIKE '%Featured%'";
  $Blogresult = mysqli_query($conn, $blogs);
  $Blogtotal = mysqli_num_rows($Blogresult);
  if ($Blogtotal < 1) {?>
    <p>Blog(s) not found.</p>
  <?php }
  else{
    while ($row = mysqli_fetch_assoc($Blogresult)) {
      $count = $count + 1;
    ?>
    <li class="nav-item">
      <a class="nav-link <?php echo $active ?>" id="<?php echo $id.$count.'-tab' ?>" data-toggle="tab" href="<?php echo '#'.$id.$count ?>" role="tab" aria-controls="<?php echo $id.$count ?>" aria-selected="true"><?php echo $row['post_title'] ?></a>
    </li>
    <?php
      $active = '';
    }
    ?>
    <?php
  }
}
?>
