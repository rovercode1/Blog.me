<?php include 'header.php';
  if (isset($_SESSION['u_id'])) {
    $user_id = $_SESSION['u_id'];
    $sql = "SELECT * FROM user_priv WHERE `id` = $user_id";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $u_priv = $row['priv'];
        if ($u_priv == 2) {?>
          <div class="container">
          <?php
          $category = "SELECT * FROM `category`";
          $catResults = mysqli_query($conn, $category);
          $catResultCheck = mysqli_num_rows($catResults);
          if ($catResultCheck < 1) {?>
              <p>No Results</p>
            <?php }else{
              ?>
                <ul>
              <?php
              while($rowCat = mysqli_fetch_assoc($catResults)){?>
                <a href="archive.php?s=<?php echo $rowCat['Category']?>">
                  <li><?php echo $rowCat['Category']?></li>
                </a>
              <?php } ?>
            </ul>
              <label>New Category</label>
                <form action="includes/admin/category.inc.php" method="post">
                  <label>Name</label>
                  <input class='form-control'type="text" name="name" value="">
                  <button type="submit" name="submit">Submit</button>
                </form>
              </div>
            <?php
          }
        }else{
          header('Location: index.php?user=false');
          exit();}
        }
    }else{
      header('Location: index.php?user=false');
      exit();}
}else{
  header('Location: index.php?loggin=false');
  exit();}
include 'footer.php'?>
