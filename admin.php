<?php include 'header.php';
$url = 'http://localhost/news-website/admin.php?tab=';
?>
<div class="container">
  <div class="row">
    <div class="col-lg-4">
      <div class="list-group" id="list-tab" role="tablist">

      <a class="list-group-item list-group-item-action active" id="list-category-list"  href="<?php echo $url ?>category" role="tab" onclick="tabTrigger(event,'category')">Category</a>

      <a class="list-group-item list-group-item-action" id="list-user-list"  href="<?php echo $url ?>user" role="tab" onclick="tabTrigger(event,'users')">Users</a>

      <a class="list-group-item list-group-item-action" id="list-messages-list"  href="<?php echo $url ?>messages" role="tab" onclick="tabTrigger(event,'messages')">Messages</a>

      <a class="list-group-item list-group-item-action" id="list-settings-list"  href="<?php echo $url ?>settings" role="tab" onclick="tabTrigger(event,'settings')">Settings</a>
      </div>
      <?php
        include 'includes/admin/tabs.inc.php';
       ?>
    </div>
    <div class="col-lg-8">
      <div class="tab-content" id="nav-tabContent">
        <?php if (isset($_SESSION['u_id'])) {
        $user_id = $_SESSION['u_id'];
        $sql = "SELECT * FROM user_priv WHERE `id` = $user_id";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
          if ($resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
            $u_priv = $row['priv'];
            if ($u_priv == 2) {?>
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
                  <form action="includes/admin/category.inc.php" method="post">
                    <input class='form-control'type="text" name="name" placeholder="New Category">
                    <button class='btn btn-primary'type="submit" name="submit">Submit</button>
                  </form>
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
                    <?php } }?>
                  </ul>
                </div>
                <?php
              }?>
              <div class="tab-pane fade" id="list-user" role="tabpanel" aria-labelledby="list-user-list">
                <?php
                $usersql = "SELECT * FROM users";
                // result = what is found in the database
                $userresult = mysqli_query($conn, $usersql);
                $total = mysqli_num_rows($userresult);
                // If there are no results in the database...
                if ($total < 1) {
                  ?>
                    <p>Blog not found.</p>
                  <?php
                }else{
                    $limit = 2;
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
                    $profileUrl = 'http://localhost/news-website/admin.php?tab=user';
                    $prevlink = ($page > 1) ? '<a href="'.$profileUrl.'&page=1title="First page">&laquo;</a> <a href=" '.$profileUrl.'&page=' . ($page - 1).'" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';

                    // The "forward" link
                    $nextlink = ($page < $pages) ? '<a href="'.$profileUrl.'&page=' . ($page + 1).'" title="Next page">&rsaquo;</a> <a href="'.$profileUrl.'&page=' . ($page + 1).'" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';

                    $user ="SELECT * FROM users LIMIT $limit OFFSET $offset";
                    $uresult = mysqli_query($conn, $user);
                    $usertotal = mysqli_num_rows($uresult);
                    // If there are no results in the database...
                    if ($usertotal < 1) {
                      ?>
                        <p>Blog not found.</p>
                      <?php
                    }else{
                      ?>
                        <div class="container" id='blog-box'>
                      <?php

                  while ($rowuser = mysqli_fetch_assoc($uresult)) {
                    ?>
                      <div class="row">
                        <div class="col-lg-12">
                          <h4><?php echo $rowuser['user_uid'] ?></h4>
                        </div>
                      </div>
                    <?php

                  }
                  ?>
                    </div>
                  <?php
                  echo '<div id="paging"><p>', $prevlink, ' Page ', $page, ' of ', $pages, ' pages, displaying ', $start, '-', $end, ' of ', $total, ' results ',
                  $nextlink, ' </p></div>';

                }
              }
               ?>
              </div>
            </div>
          </div>
          <?php
        }else{
        header('Location: index.php?user=false');
        exit();}
        }
      }else{
      header('Location: index.php?user=false');
      exit();}
    }else{
    header('Location: index.php?loggin=false');
    exit();}
    ?>
  </div>
</div>

<?php include 'footer.php'?>
