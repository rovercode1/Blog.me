<?php include 'header.php';
// include 'includes/dbh.inc.php';
$url = 'http://localhost/news-website/admin.php?tab=';
if (!isset($_GET['tab'])) {
  header("Location: http://localhost/news-website/admin.php?tab=category");
}
if (isset($_SESSION['u_id'])) {
$user_id = $_SESSION['u_id'];
$sql = "SELECT * FROM user_priv WHERE `id` = $user_id";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
if ($resultCheck > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $u_priv = $row['priv'];
    if ($u_priv == 2) {
      $category = "SELECT * FROM `category`";
      $catResults = mysqli_query($conn, $category);
      $catResultCheck = mysqli_num_rows($catResults);
      if ($catResultCheck < 1){
        ?>
        <p>No Result(s)</p>
        <?php
      }else {
      ?>
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <?php include 'includes\pages\admin\tabs.inc.php';?>
          </div>
          <div class="col-lg-8">
            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active" id="list-category" role="tabpanel" aria-labelledby="list-category-list">
                <form action="includes/admin/category/new_category.inc.php" method="post">
                  <input class='form-control'type="text" name="name" placeholder="New Category">
                  <button class='btn btn-primary'type="submit" name="submit">Submit</button>
                </form>
                <ul class="list-group">

                <?php include 'includes\pages\admin\category\category-list.inc.php';?>
                </ul>
              </div>
              <div class="tab-pane fade" id="list-user" role="tabpanel" aria-labelledby="list-user-list">
                <?php include 'includes\pages\admin\users\user-list.inc.php';?>
              </div>
            </div>
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
          ?>
        </div>
      </div>
<script type="text/javascript" src='assets/js/tabs.js'></script>
<script type="text/javascript">
  tabTrigger();
</script>
<?php include 'footer.php'?>
