<?php include 'header.php';
if (!isset($_SESSION['u_id'])) {
  header("Location: index.php?loggedin=false");
  exit();
}elseif (isset($_SESSION['u_id'])) {
  $id = $_SESSION['u_id'];
  $privSql = "SELECT * FROM `user_priv` WHERE id = $id";
  $resultPriv = mysqli_query($conn, $privSql);
  while($privrow = mysqli_fetch_assoc($resultPriv)){
  $author = $privrow['author'];
  $priv = $privrow['priv'];
  if ($priv > 0) {
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

  $privsql = "SELECT * FROM `user_priv` WHERE id = $id AND priv >  1";
  $privResult = mysqli_query($conn, $privsql);
    $privRow = mysqli_fetch_assoc($privResult);
    $userpriv = $privRow['priv'];
  // If user is admin - allow update.
  if($_SESSION['u_id'] == $row['post_author'] || $userpriv = 2 ) {?>
  <section>
    <div class="container">
      <div id='signup' class="main-wrapper">
        <h2>Update blog</h2>
        <form  action="includes/blogs/update_blog.inc.php<?php echo '?blog='. $row['post_id']?>" method="post" enctype="multipart/form-data">
          <label>Image (Optional)</label>
          <div class="img">
            <input type='file' name='Image'>
          </div>
          <label>Blog Title</label>
            <input class="form-control"type="text" name="title" placeholder="Blog Title" value="<?php echo $row['post_title'] ?> "required>
          <label>Category (Custom inputs will be deleted.)</label>
            <div class="container">
              <input id='input'type="text" name='category' class="form-control" value='<?php echo $row['category']?>'>
              <ul class='block-item'>
                <?php
                  if ($userpriv = 2) {
                    ?>
                      <li class='li-item'>Featured</li>
                      <li class='li-item'>Top</li>
                      <p></p>
                    <?php
                  }
                  $sql = "SELECT * FROM category";
                  $result = mysqli_query($conn, $sql);
                  $check = mysqli_num_rows($result);
                  if ($check < 1) {
                    header("Location: blog_form?category=null");
                    exit();
                  }else{

                    while ($row = mysqli_fetch_assoc($result)){?>
                      <?php if ($row['Category'] != 'Top' && $row['Category'] != 'Featured'){ ?>
                        <li class='li-item'><?php echo $row['Category'] ?></li>
                      <?php } ?>
                      <?php
                    }
                  }
                ?>
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
}else{
  header("Location: http://localhost/project-website/index.php?update_blog_form=error");
  exit();
}
  }
};
include 'footer.php';
?>
