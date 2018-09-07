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
          <label>Category (Custom inputs will be deleted.)</label>
            <div class="container">
              <input id='input'type="text" name='category' class="form-control">
              <ul class='block-item'>
                <?php include 'blog_form_category.inc.php'; ?>
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
