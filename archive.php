<?php include 'header.php';
$search = $_GET['s'];
if ($search == 'all') {
  $filter = "";
}else{
  $filter = "WHERE `category` LIKE '%$search%'";
}
$sql = "SELECT * FROM blogs $filter";
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
  $offset = ($page - 1)  * $limit;
  $start = $offset + 1;
  $end = min(($offset + $limit), $total);
  $Url = 'http://localhost/news-website/archive.php?s=';
  $prevlink = ($page > 1) ? '<a href="'.$Url.$search.'&page=1title="First page">&laquo;</a> <a href=" '.$Url.$search.'&page=' . ($page - 1).'" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';
  $nextlink = ($page < $pages) ? '<a href="'.$Url.$search.'&page=' . ($page + 1).'" title="Next page">&rsaquo;</a> <a href="'.$Url.$search.'&page=' . ($page + 1).'" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';
  if ($search == 'all') {
    $filter = "";
  }else{
    $filter = "WHERE `category` LIKE '%$search%'";
  }
  $blogs ="SELECT * FROM `blogs` $filter ORDER BY `post_id` LIMIT $limit OFFSET $offset";
  $Blogresult = mysqli_query($conn, $blogs);
  $Blogtotal = mysqli_num_rows($Blogresult);
  if ($Blogtotal < 1) {
  ?>
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <h5 class='text-center'>Blog(s) not found.</h5>
      </div>
    </div>
  </div>
<?php
}else{?>
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <?php include 'includes\pages\archive\blog-results.inc.php'; }?>
      </div>
      <!-- Sidebar -->
      <div class="col-lg-6">
        <?php include 'includes\pages\archive\sidebar.inc.php';?>
        <div class="tab-pane fade" id="list-user" role="tabpanel" aria-labelledby="list-user-list">
        <!-- User Archive -->
        </div>
      </div>
    </div>
  </div>
  <?php
  echo '<div id="paging"><p>', $prevlink, ' Page ', $page, ' of ', $pages, ' pages, displaying ', $start, '-', $end, ' of ', $total, ' results ',
  $nextlink, ' </p></div>';
}
include 'footer.php'; ?>
