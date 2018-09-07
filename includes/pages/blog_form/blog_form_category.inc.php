<?php
if ($userpriv = 2) {
  ?>
    <li class='li-item'>Featured</li>
    <li class='li-item'>Top</li>
    <p></p>
  <?php
}
$sql = "SELECT * FROM category";
$result = mysqli_query($conn, $sql);
$check = mysqli_num_rows($result);
if ($check < 1) {
  header("Location: $fullurl/index.php?blog_form?category=null");
  exit();
}else{

  while ($row = mysqli_fetch_assoc($result)){?>
    <?php if ($row['Category'] != 'Top' && $row['Category'] != 'Featured'){ ?>
      <li class='li-item'><?php echo $row['Category'] ?></li>
    <?php } ?>
    <?php
  }
}
 ?>
