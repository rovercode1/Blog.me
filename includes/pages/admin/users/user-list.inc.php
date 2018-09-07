<!--  -->
<?php

$search = '';
if (isset($_POST['submit'])) {
  $search = mysqli_real_escape_string($conn,$_POST['search']);
}

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
  $limit = 8;
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
      <form class="" action="includes\pages\admin\users\user-list.inc.php" method="post">
        <!-- Limit input -->
        <input type="text" name="search">
        <button type="submit" name="submit">Submit</button>
      </form>
  <?php

  while ($rowuser = mysqli_fetch_assoc($uresult)) {
  ?>
    <div class="row">
      <div class="col-lg-12">
        <div id='user-inline'>
          <a href="profile.php?user=<?php echo $rowuser['user_id'] ?>">
            <h4> <?php echo $rowuser['user_first'] .' '. $rowuser['user_last'] ?></h4>
          </a>
          <h4>(<?php echo $rowuser['user_uid'] ?>)</h4>
        </div>
        <?php
          if (isset($search)) {
            ?>
              <h1><?php echo $search ?></h1>
            <?php
          }
         ?>
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

<!--  -->
