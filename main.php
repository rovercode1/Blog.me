<section>
  <div class="container">
    <div class="row">
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
          while ($row = mysqli_fetch_assoc($blogResult)) {?>
            <div class="col-lg-6 col-md-6">
              <a href="blogs.php <?php echo '?blog='. $row['post_id']?>" ><h4><?php echo $row['post_title'] ?> </h4></a>
              <p> <?php echo $row['post_body'] ?> </p>
              <p> <?php echo $row['post_author'] ?> </p>
              <p> <?php echo $row['post_date'] ?> </p>
            </div>
          <?php }
          }
        ?>
        <?php
      }
    ?>
    </div>
  </div>
</section>
