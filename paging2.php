<?php include 'header.php';
// If user is signed in
if (isset($_SESSION['u_id'])) {
    $sql  ="SELECT * FROM blogs WHERE category ='Politics'";
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
        $limit = 3;
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
        $prevlink = ($page > 1) ? '<a href="?page=1" title="First page">&laquo;</a> <a href="?page=' . ($page - 1) . '" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';

        // The "forward" link
        $nextlink = ($page < $pages) ? '<a href="?page=' . ($page + 1) . '" title="Next page">&rsaquo;</a> <a href="?page=' . $pages . '" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';


        $blogs ="SELECT * FROM blogs WHERE category ='Politics' LIMIT $limit OFFSET $offset";
        $Blogresult = mysqli_query($conn, $blogs);
        $Blogtotal = mysqli_num_rows($Blogresult);
        // If there are no results in the database...
        if ($Blogtotal < 1) {
          ?>
            <p>Blog not found.</p>
          <?php
        }else{

      while ($row = mysqli_fetch_assoc($Blogresult)) {
        ?>
          <h5> <?php echo $row['post_title'] ?> </h5>
          <p> <?php echo $row['category'] ?> </p>
        <?php
      }
      // Display the paging information
      echo '<div id="paging"><p>', $prevlink, ' Page ', $page, ' of ', $pages, ' pages, displaying ', $start, '-', $end, ' of ', $total, ' results ',
      $nextlink, ' </p></div>';
    }

}
}else{
    header("Location: ../../index.php");
    exit();
  }
include 'footer.php';
?>
