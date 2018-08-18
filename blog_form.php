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
        <form  action="includes/blogs/new_blog.inc.php" method="post"  enctype="multipart/form-data">
          <label>Image (Optional)</label>
          <div class="">
            <input type='file' name='UploadImage'>
          </div>
            <label>Blog Title</label>
          <input class="form-control"type="text" name="title" placeholder="Blog Title" required>
            <label>Tagline</label>
          <input class="form-control"type="text" name="tag" placeholder="ex. a quote from your blog or a shorter version of your title" required>
            <label>Category (Custom inputs will be deleted.)</label>

            <div class="container">
              <input id='input'type="text" name='category' class="form-control">
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
              <!-- <input class="form-control"type="text" name="category" placeholder="Blog Category" required> -->
            <label>Blog Body</label>
          <textarea rows='20'class="form-control"type="text" name="body" placeholder="What's on your mind?" required></textarea>
          <button id='btn'class="form-control btn btn-primary"type="submit" name="submit">Post</button>
        </form>
      </div>
    </div>
  </section>
<?php
};
include 'footer.php';
 ?>
