<?php include 'header.php';
  $sql = "SELECT * FROM blogs";
  // result = what is found in the database
  $result = mysqli_query($conn, $sql);
  $total = mysqli_num_rows($result);
  // If there are no results in the database...
  if ($total < 1) {
      // header("Location: ../../index.php?blog=error");
      // exit();
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
      $prevlink = ($page > 1) ? '<a href="?page=1&title="First page">&laquo;</a> <a href="?page=' . ($page - 1) . '" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';

      // The "forward" link
      $nextlink = ($page < $pages) ? '<a href="?page=' . ($page + 1).'"title="Next page">&rsaquo;</a> <a href="?page=' . $pages . '" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';

      $blogs ="SELECT * FROM blogs ORDER BY `post_id` DESC LIMIT $limit OFFSET $offset";
      $Blogresult = mysqli_query($conn, $blogs);
      $Blogtotal = mysqli_num_rows($Blogresult);
      // If there are no results in the database...
      if ($Blogtotal < 1) {
        ?>
          <p>Blog not found.</p>
        <?php
      }else{
        ?>
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-6">
        <?php
    while ($row = mysqli_fetch_assoc($Blogresult)) {
      $category = explode(',',$row['category']);?>
        <div class="container blog">
          <h6>Posted in
            <?php
              foreach ($category as $cat ) {
                if (sizeof($category)>1) {
                  $nxt = '/';
                  ?>
                    <a href=""><?php print_r($cat); ?></a>
                    <p class='nxt'><?php echo $nxt ?></p>
                  <?php
                }else
                {
                  ?>
                    <a href=""><?php print_r($cat); ?></a>
                  <?php
                }

              }
             ?>
          </h6>
          <div class="archive-block">
            <img src="uploads/blogs/<?php echo $row['post_image'] ?>" alt="">
            <a href="blogs.php <?php echo '?blog='. $row['post_id']?>" ><p><?php echo $row['post_title'] ?> </p></a>
            <!-- <p class='featured_body'> <?php echo $row['post_body'] ?> </p> -->
          </div>
          <p><?php echo $row['post_date'] ?></p>
        </div>
      <?php
    }
    ?>
    </div>
  </div>
</div>
    <?php
    echo '<div id="paging"><p>', $prevlink, ' Page ', $page, ' of ', $pages, ' pages, displaying ', $start, '-', $end, ' of ', $total, ' results ',
    $nextlink, ' </p></div>';
  }

}
include 'footer.php'; ?>
