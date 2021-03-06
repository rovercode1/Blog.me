<?php include 'header.php';
  $sql = "SELECT * FROM blogs";
  $result = mysqli_query($conn, $sql);
  $total = mysqli_num_rows($result);
  if ($total < 1) {
    ?>
      <p>Blog not found.</p>
    <?php
  }else{
      $limit = 6;
      $pages = ceil($total / $limit);
      $page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
          'options' => array(
              'default'   => 1,
              'min_range' => 1,
          ),
      )));
      // Calculate the offset for the query
      $offset = ($page - 1)  * $limit;

      // Some information to display to the user
      $start = $offset + 1;
        //returns the lowest value in that array
      $end = min(($offset + $limit), $total);
      // The "back" link
      $search = $_GET['s'];
      $Url = 'http://localhost/news-website/archive.php?s=';
      $prevlink = ($page > 1) ? '<a href="'.$Url.$search.'&page=1title="First page">&laquo;</a> <a href=" '.$Url.$search.'&page=' . ($page - 1).'" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';

      // The "forward" link
      $nextlink = ($page < $pages) ? '<a href="'.$Url.$search.'&page=' . ($page + 1).'" title="Next page">&rsaquo;</a> <a href="'.$Url.$search.'&page=' . ($page + 1).'" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';
      if ($search == 'all') {
        $filter = "";
      }else{
        $filter = "WHERE `category` LIKE '%$search%'";
      }
      $blogs ="SELECT * FROM `blogs` $filter ORDER BY `post_id` DESC LIMIT $limit";
      $Blogresult = mysqli_query($conn, $blogs);
      $Blogtotal = mysqli_num_rows($Blogresult);
      if ($Blogtotal < 1) {
        ?>
        <div class="container">
          <div class="row">
            <div class="col-lg-6">
          <h5 class='text-center'>Blog(s) not found.</h5>
        <?php
      }else{?>
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
          <?php while ($row = mysqli_fetch_assoc($Blogresult)) {
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
            }?>
          </div>
          <!-- Sidebar -->
          <div class="col-lg-6">
            <?php $category = "SELECT * FROM `category`";
            $catResults = mysqli_query($conn, $category);
            $catResultCheck = mysqli_num_rows($catResults);
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
                  <span class="badge badge-primary badge-pill"><?php echo $catResultCheck ?></span>
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
            }?>
            <div class="tab-pane fade" id="list-user" role="tabpanel" aria-labelledby="list-user-list">
            <h1>jsjsjsjjs</h1>
            </div>
            <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">

            </div>
            <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php
    echo '<div id="paging"><p>', $prevlink, ' Page ', $page, ' of ', $pages, ' pages, displaying ', $start, '-', $end, ' of ', $total, ' results ',
    $nextlink, ' </p></div>';
  }
include 'footer.php'; ?>
