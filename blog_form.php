<?php include 'header.php';
      if (!isset($_SESSION['u_id'])) {
        header("Location: index.php?loggedin=false");
        exit();
      }elseif (isset($_SESSION['u_id'])) {
?>
  <section>
    <div class="container">
      <div id='signup' class="main-wrapper">
        <h2>New Blog</h2>
        <form  action="includes/new_blog.inc.php" method="post">
            <label>Blog Title</label>
          <input class="form-control"type="text" name="title" placeholder="Blog Title" required>
            <label>Blog Url</label>
          <input class="form-control"type="text" name="url" placeholder="Blog Url" required>
            <label>Blog Body</label>
          <textarea rows='10'class="form-control"type="text" name="body" placeholder="What's on your mind?" required></textarea>
          <button class="form-control btn btn-primary"type="submit" name="submit">Post</button>
        </form>
      </div>
    </div>
  </section>
<?php
};
include 'footer.php';
 ?>