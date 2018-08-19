<!-- <section id='main-site'>
  <div class="container">
    <div id="content">
      <div id='featured'>
        <div class="blog_desc" id='featured'>
          <div class="row">
            <div class="col-lg-12">
              <header>
                <h1 class='main-header'>Top Stories</h1>
              </header>
              <div id="featured-box">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <?php $count = 0;
                  $active = 'active show';
                  $id = 'f';
                  $sql = "SELECT * FROM blogs WHERE category = 'Featured'";
                  $result = mysqli_query($conn, $sql);
                  $total = mysqli_num_rows($result);
                  if ($total < 1) {?>
                    <p>Blog not found.</p>
                  <?php }
                  else{
                    $limit = 3;
                    $blogs ="SELECT * FROM blogs WHERE category = 'Featured'";
                    $Blogresult = mysqli_query($conn, $blogs);
                    $Blogtotal = mysqli_num_rows($Blogresult);
                    if ($Blogtotal < 1) {?>
                      <p>Blog(s) not found.</p>
                    <?php }
                    else{
                      while ($row = mysqli_fetch_assoc($Blogresult)) {
                        $count = $count + 1;
                      ?>
                      <li class="nav-item">
                        <a class="nav-link <?php echo $active ?>" id="<?php echo $id.$count.'-tab' ?>" data-toggle="tab" href="<?php echo '#'.$id.$count ?>" role="tab" aria-controls="<?php echo $id.$count ?>" aria-selected="true">Featured Post</a>
                      </li>
                      <?php
                        $active = '';
                      }
                      ?>
                        </ul>
                      <?php
                    }
                  }
                $count = 0;
                $activeTab = 'active show';
                $id = 'f';
                $sql = "SELECT * FROM blogs WHERE category = 'Featured'";
                $result = mysqli_query($conn, $sql);
                $total = mysqli_num_rows($result);
                if ($total < 1) {?>
                  <p>Blog not found.</p>
                <?php }
                else{
                $limit = 3;
                $offset = $total + 1 - $limit;
                $blogs ="SELECT * FROM blogs WHERE category = 'Featured' ";
                $Blogresult = mysqli_query($conn, $blogs);
                $Blogtotal = mysqli_num_rows($Blogresult);
                if ($Blogtotal < 1) {?>
                  <p>Blog(s) not found.</p>
                <?php }
                else{
                  ?>
                  <div class="tab-content" id="myTabContent">
                  <?php while ($row = mysqli_fetch_assoc($Blogresult)) {
                    $count = $count + 1; ?>
                    <div class="tab-pane fade <?php echo $activeTab ?>" id="<?php echo $id.$count ?>" role="tabpanel" aria-labelledby="<?php echo $id.$count.'-tab' ?>">
                      <a href="blogs.php <?php echo '?blog='. $row['post_id']?>" ><h2><?php echo $row['post_title'] ?> </h2></a>
                      <p class='featured_body'> <?php echo $row['post_body'] ?> </p>
                    </div>
                    <?php
                        $activeTab = '';} ?>
                    </div>
                  <?php }
                }
              ?>
                </div>
              </div>
            </div>
          </div>
        </div>

      <div class="row" id='content'>
        <div class="col-lg-4 md-4">
          <h1 class='main-header'>Most Recent</h1>
        <?php
        if (isset($_SESSION['u_id'])) {
          $sql = "SELECT * FROM blogs";
          $result = mysqli_query($conn, $sql);
          $total = mysqli_num_rows($result);
            if ($total < 1) {?>
              <p>Blog not found.</p>
            <?php
              }else{
            $limit = 3;
            $blogs ="SELECT * FROM blogs ORDER BY `post_id` DESC LIMIT $limit ";
            $Blogresult = mysqli_query($conn, $blogs);
            $Blogtotal = mysqli_num_rows($Blogresult);
              if ($Blogtotal < 1) {  ?>
                <p>Blog not found.</p>
              <?php
              }else{
                while ($row = mysqli_fetch_assoc($Blogresult)) {
                $user_id = $row['post_author'];
                $sql  ="SELECT * FROM `users` WHERE `user_id` = $user_id";
                // result = what is found in the database
                $Userresult = mysqli_query($conn, $sql);
                $UserresultCheck = mysqli_num_rows($Userresult);
                // If there are no results in the database...
                  if ($UserresultCheck < 1) {
                    header("Location: http://localhost/news-website/index.php?user=nouser");
                    exit();
                  }else{
                    $Userrow = mysqli_fetch_assoc($Userresult);
                    ?>
                    <div class="col-lg-12 col-md-12">
                    <div class="blog_desc">
                    <a href="blogs.php <?php echo '?blog='. $row['post_id']?>" ><h4><?php echo $row['post_title'] ?> </h4></a>
                    <div class="">
                      <p id='post_author'>Posted by <a href="http://localhost/news-website/profile.php?user=<?php echo $row['post_author']?>"> <em><?php echo $Userrow['user_uid'] ?></em></a></p>
                    </div>
                    <p id='post_date'><?php echo $row['post_date'] ?></p>
                    </div>
                    </div>
                <?php }
                }
              }
            }
          }else{
            header("Location: ../../index.php");
            exit();
          }?>
    </div>
    <div class="col-lg-4 col-md-4">
      <div class="col-lg-12">
        <h1 class='main-header'>To The Point</h1>

      </div>
    </div>

<!-- Row/Container/Main-site -->
    </div>
  </div>
</section> -->
