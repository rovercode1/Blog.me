<?php include 'header.php';
      if (!isset($_SESSION['u_id'])) {
        header("Location: index.php?loggedin=false");
        exit();
      }elseif (isset($_SESSION['u_id'])) {
        $post_id = $_GET['blog'];
        $sql = "SELECT * FROM `blogs` WHERE `post_id` = '$post_id'";
        // result = what is found in the database
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
          // If there are no results in the database...
        if ($resultCheck < 1) {
            header("Location: index.php?blog=noblog");
            exit();
        }else{
          $row = mysqli_fetch_assoc($result);
          // If the current user is not the author
           // of the blog, redirect to home page.
          if($_SESSION['u_id'] == $row['post_author']){
      ?>
  <section>
    <div class="container">
      <div id='signup' class="main-wrapper">
        <h2>Update blog</h2>
        <form  action="includes/blogs/update_blog.inc.php<?php echo '?blog='. $row['post_id']?>" method="post" enctype="multipart/form-data">
            <label>Image (Optional)</label>
            <div class="">
              <input type='file' name='Image'>
            </div>
            <label>Blog Title</label>
          <input class="form-control"type="text" name="title" placeholder="Blog Title" value="<?php echo $row['post_title'] ?> "required>
          <input class="form-control"type="text" name="tag" placeholder="ex. a quote from your blog or a shorter version of your title" required>
            <label>Category (Custom inputs will be deleted.)</label>
            <div class="container">
              <input id='input'type="text" name='category' class="form-control" value='<?php echo $row['category']?>'>
              <ul class='block-item'>
                <li class='li-item'>Politics</li>
                <li class='li-item'>World</li>
                <li class='li-item'>Ideas</li>
                <li class='li-item'>Tech</li>
                <li class='li-item'>Entertainment</li>
                <li class='li-item'>Health</li>
                <li class='li-item'>Sport</li>
                <li class='li-item'>Movies</li>
                <li class='li-item'>Music</li>
              </ul>
            </div>
            <label>Blog Body</label>
          <textarea rows='15'class="form-control"type="text" name="body" placeholder="What's on your mind?" required><?php echo $row['post_body'] ?> </textarea>
          <button id='btn'class="form-control btn btn-primary"type="submit" name="submit">Update</button>
        </form>
      </div>
    </div>
  </section>
<?php
} else{
    header("Location: http://localhost/project-website/index.php?update_blog_form=error");
    exit();
      };
    };
  };
include 'footer.php';
 ?>
