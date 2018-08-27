<?php include 'header.php';
// If user is signed in
// if (isset($_SESSION['u_id'])) {
  $user_id = $_GET['user'];
  // If user is logged in...
  // Find the user in database
  $sql = "SELECT *  FROM `users` WHERE `user_id` = $user_id";
  // result = what is found in the database
  $result = mysqli_query($conn, $sql);
  $resultCheck = mysqli_num_rows($result);
  // If there are no results in the database...
  if ($resultCheck < 1) {
    header("Location: http://localhost/news-website/index.php?user=nouser");
    exit();
  }else{
    $row = mysqli_fetch_assoc($result);
    $img = $row['user_av'];
    ?>
    <div class="container-fluid">
      <div class='container' id="user-box">
        <div class="img">
          <img src="uploads/users/<?php echo $img ?>" alt="">
        </div>
        <div id="user">
          <h1> <em><?php echo $row['user_first']?> <?php echo $row['user_last']?></em>
            <?php
            $id = $_SESSION['u_id'];
            $privsql = "SELECT * FROM `user_priv` WHERE id = $id AND priv >  1";
            $privResult = mysqli_query($conn, $privsql);

            $privRow = mysqli_fetch_assoc($privResult);
            $userpriv = $privRow['priv'];
           if ($_SESSION['u_id'] == $row['user_id'] || $userpriv = 2): ?>
              <a href="profile_update.php <?php echo '?user='. $row['user_id']?>" ><i class="fas fa-edit"></i></a>
              <?php endif;
             ?>
           </h1>
          <p> <?php echo $row['user_about'] ?> </p>
        </div>
      </div>
      <?php $user_id = $_GET['user'];
        $sql = "SELECT * FROM blogs WHERE `post_author` = $user_id";
        // result = what is found in the database
        $result = mysqli_query($conn, $sql);
        $total = mysqli_num_rows($result);
        // If there are no results in the database...
        if ($total < 1) {
          ?>
            <p>Blog not found.</p>
          <?php
        }else{
            $limit = 4;
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
            $profileUrl = 'http://localhost/news-website/profile.php?user=';
            $prevlink = ($page > 1) ? '<a href="'.$profileUrl.$user_id.'&page=1title="First page">&laquo;</a> <a href=" '.$profileUrl.$user_id.'&page=' . ($page - 1).'" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';

            // The "forward" link
            $nextlink = ($page < $pages) ? '<a href="'.$profileUrl.$user_id.'&page=' . ($page + 1).'" title="Next page">&rsaquo;</a> <a href="'.$profileUrl.$user_id.'&page=' . ($page + 1).'" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';

            $blogs ="SELECT * FROM blogs WHERE `post_author` = $user_id LIMIT $limit OFFSET $offset";
            $Blogresult = mysqli_query($conn, $blogs);
            $Blogtotal = mysqli_num_rows($Blogresult);
            // If there are no results in the database...
            if ($Blogtotal < 1) {
              ?>
                <p>Blog not found.</p>
              <?php
            }else{
              ?>
                <div class="container" id='blog-box'>
              <?php

          while ($row = mysqli_fetch_assoc($Blogresult)) {
            ?>
              <div class="row">
                <div class="col-lg-12">
                  <a id='blog-link' href="blogs.php <?php echo '?blog='. $row['post_id']?>">
                    <div id="user-blogs">
                      <h4> <?php echo $row['post_title'] ?> </h4>
                      <p class='post_body'> <?php echo $row['post_body'] ?> </p>
                    </div>
                  </a>
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
    <?php
    }
  // }
  // else{
  //   header("Location: ../../index.php");
  //   exit();
  // }
include 'footer.php';
?>
