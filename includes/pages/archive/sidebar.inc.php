<?php $category = "SELECT * FROM `category`";
$catResults = mysqli_query($conn, $category);
$catResultCheck = mysqli_num_rows($catResults);
$sql = "SELECT post_id FROM blogs";
$result = mysqli_query($conn, $sql);
$checkresult = mysqli_num_rows($result);
if ($checkresult < 1) {
  ?>
  <p>No Result(s)</p>
  <?php
}else{
  if ($catResultCheck < 1){
    ?>
    <p>No Result(s)</p>
    <?php
  }else {
  ?>
      <div class="tab-pane fade show active" id="list-category" role="tabpanel" aria-labelledby="list-category-list">
      <!-- All Posts -->
      <li class="list-group-item d-flex justify-content-between align-items-center">
        <a href="archive.php?s=all">
          All
        </a>
        <span class="badge badge-primary badge-pill"><?php echo $checkresult ?></span>
      </li>
      <ul class="list-group"><?php
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
          </li>
        <?php }
        }?>
      </ul>
    </div>
  <?php
  }
}?>
