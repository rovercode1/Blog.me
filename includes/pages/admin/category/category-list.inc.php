<?php
while($rowCat = mysqli_fetch_assoc($catResults)){?>
  <?php $categoryName = $rowCat['Category'];
  $categoryCount = $rowCat['count'];
  $newCount = "SELECT COUNT(`category`) AS `$categoryName` FROM `blogs` WHERE `category` LIKE '%$categoryName%'";
  $countResult = mysqli_query($conn, $newCount);
  while ($count = mysqli_fetch_assoc($countResult)) {
    $nCount = $count[$categoryName];
    $sql = "UPDATE `category` SET `count` = '$nCount' WHERE `category`.`Category` = '$categoryName';";
    mysqli_query($conn, $sql);
    ?>
    <li class="list-group-item d-flex justify-content-between align-items-center">
      <a href="archive.php?s=<?php echo $rowCat['Category']?>">
      <?php echo $rowCat['Category']?>
      </a>
      <span class="badge badge-primary badge-pill"><?php echo $nCount ?></span>
      <span id='cat-delete'> <form class="" action="includes/admin/category/delete_category.inc.php?c=<?php echo $rowCat['Category'] ?>" method="post">
        <button type="submit" name="submit"></button>
      </form> </span>
    </li>
<?php } }?>
