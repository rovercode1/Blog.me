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
  if ($priv > 0) {?>
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
            <!-- <input class="form-control"type="text" name="category" placeholder="Blog Category" required> -->
            <label>Blog Body</label>
            <textarea rows='20'class="form-control"type="text" name="body" placeholder="What's on your mind?" required></textarea>
            <button id='btn'class="form-control btn btn-primary"type="submit" name="submit">Post</button>
          </form>
        </div>
      </div>
    </section>
    <?php
  }else{
  header("Location: index.php?error");
  exit();}
  }
  }
include 'footer.php';
?>
