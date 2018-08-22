<?php  include 'header.php';?>
<section id='main-site'>
    <!-- <h1>hotspot</h1> -->
    <div class="modal fade" id="logginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form class="" action="includes/index/login.inc.php" method="POST">
            <label>Username/E-mail</label>
              <input class="form-control"type="text" name="uid" placeholder="Username/E-mail">
              <label>Password</label>
              <input class="form-control"type="password" name="pwd" placeholder='Enter Your Password'>
              <button class="btn btn-primary btn-sm"type="submit" name="submit">Sign In</button>
            </form>
          </div>
          <div class="modal-footer">
            <a class="btn btn-warning btn-sm"href="signup.php">Need an account? Sign Up!</a>
          </div>
        </div>
      </div>
    </div>
    <div class="top-story">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-lg-6 right-border">
            <div id="top-story">
            <?php
              $sql = "SELECT * FROM `blogs` WHERE `category` LIKE '%Top%'";
              $result = mysqli_query($conn, $sql);
              while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <img src="uploads/blogs/<?php echo $row['post_image'] ?>" alt="">
                <a href="blogs.php?blog=<?php echo $row['post_id'] ?>">
                  <h4><?php echo $row['post_title'] ?></h4>
                </a>
                <p class='post_body'><?php echo $row['post_body'] ?></p>

                <?php
              }
             ?>
             <div class="container view-more">
               <a href="#">View More</a>
             </div>
           </div>
          </div>
          <div class="col-lg-6 md-6">
            <h1 class='main-header'>Most Recent</h1>
          <?php
          // if (isset($_SESSION['u_id'])) {
            $sql = "SELECT * FROM blogs";
            $result = mysqli_query($conn, $sql);
            $total = mysqli_num_rows($result);
              if ($total < 1) {?>
                <p>Blog not found.</p>
              <?php
                }else{
              $limit = 4;
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
                        <!-- <p id='post_author'>Posted by <a href="http://localhost/news-website/profile.php?user=<?php echo $row['post_author']?>"> <em><?php echo $Userrow['user_uid'] ?></em></a></p> -->
                      </div>
                      <p id='post_date'><?php echo $row['post_date'] ?></p>
                      </div>
                      </div>
                  <?php }
                  }
                }
              }
            ?>
            <div class="container view-more" >
              <a href="#">View More</a>
            </div>
          </div>
        </div>
      </div>
    </div>
      <div id='featured'>
        <div class="container">
          <h1 class='main-header'>Featured Articles</h1>
        <div class="blog_desc" id='featured'>
          <div class="row">
            <div class="col-lg-12">
              <!-- <header>
                <h1 class='main-header'>Top Stories</h1>
              </header> -->
              <div id="featured-box">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <?php $count = 0;
                  $active = 'active show';
                  $id = 'f';
                  $sql = "SELECT * FROM `blogs` WHERE `category` LIKE '%Featured%'";
                  $result = mysqli_query($conn, $sql);
                  $total = mysqli_num_rows($result);
                  if ($total < 1) {?>
                    <p>Blog not found.</p>
                  <?php }
                  else{
                    $limit = 3;
                    $blogs ="SELECT * FROM `blogs` WHERE `category` LIKE '%Featured%'";
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
                        <a class="nav-link <?php echo $active ?>" id="<?php echo $id.$count.'-tab' ?>" data-toggle="tab" href="<?php echo '#'.$id.$count ?>" role="tab" aria-controls="<?php echo $id.$count ?>" aria-selected="true"><?php echo $row['post_title'] ?></a>
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
                $sql = "SELECT * FROM `blogs` WHERE `category` LIKE '%Featured%'";
                $result = mysqli_query($conn, $sql);
                $total = mysqli_num_rows($result);
                if ($total < 1) {?>
                  <p>Blog not found.</p>
                <?php }
                else{
                $limit = 3;
                $offset = $total + 1 - $limit;
                $blogs ="SELECT * FROM `blogs` WHERE `category` LIKE '%Featured%'";
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
                      <div id="featured">
                        <img src="uploads/blogs/<?php echo $row['post_image'] ?>" alt="">
                        <p class='featured_body'> <?php echo $row['post_body'] ?> </p>
                      </div>
                    </div>
                    <?php
                        $activeTab = '';} ?>
                    </div>
                  <?php }
                }
              ?>
              <div class="container view-more">
                <a href="#">View More</a>
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <section>
      <div class="container">
      <div class="row" id='content'>
<!--  -->
        <div class="col-lg-4 col-md-4 right-border">
          <div class="col-lg-12">
            <div id="article-len" >
            <!--  Articles under 700 words -->
            <h1 class='main-header'>To The Point</h1>
              <?php
                $sql = "SELECT * FROM `blogs` WHERE CHAR_LENGTH(`post_body`) < 2000 ORDER BY `post_id` DESC LIMIT 2";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                  $body = $row['post_body'];
                    ?>
                    <div id="article">
                      <div class="img">
                        <img src="uploads/blogs/<?php echo $row['post_image'] ?>" alt="">
                        <a href="blogs.php <?php echo '?blog='. $row['post_id']?>" ><h5><?php echo $row['post_title'] ?> </h5></a>
                      </div>
                    </div>
                    <?php
                  }
               ?>
               <div class="container view-more">
                 <a href="#">View More</a>
               </div>
          </div>
        </div>
      </div>
      <div class="col-lg-8 col-md-12">
        <h2 class='main-header'>Most Popular</h2>
      </div>
    </div>
  </section>
</section>

<!-- Row/Container/Main-site -->

<?php include 'footer.php';?>
