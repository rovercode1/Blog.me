<section id='main-site'>
  <div class="container">
    <!-- <div id="content"> -->
    <header>
      <h1>Featured Articles</h1>
    </header>
      <div id='featured'>
        <div class="blog_desc" id='featured'>
          <div class="row">
            <div class="col-lg-12">
              <div id="Indicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#Indicators" data-slide-to="0" class="active"></li>
                  <li data-target="#Indicators" data-slide-to="1"></li>
                  <li data-target="#Indicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <div id="featured-box">
                      <h2>Title</h2>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    </div>
                  </div>
                </div>
                <a class="carousel-control-prev" href="#Indicators" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#Indicators" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
            </div>
          </div>
        </div>

      </div>
      <div class="row" id='content'>
        <div class="col-lg-8 md-8">
        <?php
        if (isset($_SESSION['u_id'])) {
          $fullUrl = "http://$_SERVER[HTTP_HOST]";
          $blogs = 'SELECT * FROM blogs';
          $blogResult = mysqli_query($conn, $blogs);
          $blogresultCheck = mysqli_num_rows($blogResult);
          // If there are no results in the database...
          if ($blogresultCheck < 1) {
            ?>
              <h1>There are no blogs.</h1>
            <?php
          }else{
            //Push the result in an array = $row
            while ($row = mysqli_fetch_assoc($blogResult)) {
              $user_id = $row['post_author'];
              $sql  ="SELECT * FROM `users` WHERE `user_id` = $user_id";
              // result = what is found in the database
              $Userresult = mysqli_query($conn, $sql);
              $UserresultCheck = mysqli_num_rows($Userresult);
              // If there are no results in the database...
              if ($UserresultCheck < 1) {
                header("Location: http://localhost/project-website/index.php?user=nouser");
                exit();
              }else{
                $Userrow = mysqli_fetch_assoc($Userresult);
                ?>
                <div class="col-lg-12 col-md-12">
                  <div class="blog_desc">
                    <a href="blogs.php <?php echo '?blog='. $row['post_id']?>" ><h4><?php echo $row['post_title'] ?> </h4></a>
                    <p class='post_body'> <?php echo $row['post_body'] ?></p>
                    <p>Posted by <a href="http://localhost/project-website/profile.php?user=<?php echo $row['post_author']?>"> <em><?php echo $Userrow['user_uid'] ?></em></a></p>
                    <p><?php echo $row['post_date'] ?></p>
                  </div>
                </div>
              <?php }
            }
            ?>
          </div>
          <div class="col-lg-4 col-md-4">
            <div class="col-lg-12">
              <h1>Sidebar</h1>
            </div>
        </div>
      </div>
      <!-- </div> -->
    <?php }
    }
  ?>
  </div>
</section>
