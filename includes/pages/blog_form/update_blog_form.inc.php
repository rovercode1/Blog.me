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
              <?php include 'blog_form_category.inc.php'; ?>
            </ul>
          </div>
        <label>Blog Body</label>
        <textarea rows='15'class="form-control"type="text" name="body" placeholder="What's on your mind?" required><?php echo $row['post_body'] ?> </textarea>
        <button id='btn'class="form-control btn btn-primary"type="submit" name="submit">Update</button>
      </form>
    </div>
  </div>
</section>
