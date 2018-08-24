<?php include 'header.php';?>
<div class="container">
  <div class="row">
    <div class="col-lg-4">
      <div class="list-group" id="list-tab" role="tablist">
        <a class="list-group-item list-group-item-action active" id="list-category-list" data-toggle="list" href="#list-category" role="tab" aria-controls="home">Category</a>
        <a class="list-group-item list-group-item-action" id="list-user-list" data-toggle="list" href="#list-user" role="tab" aria-controls="user">User</a>
        <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Messages</a>
        <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">Settings</a>
      </div>
    </div>
    <div class="col-lg-8">
      <div class="tab-content" id="nav-tabContent">
        <?php if (isset($_SESSION['u_id'])) {
          $user_id = $_SESSION['u_id'];
          $sql = "SELECT * FROM user_priv WHERE `id` = $user_id";
          $result = mysqli_query($conn, $sql);
          $resultCheck = mysqli_num_rows($result);
            if ($resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              $u_priv = $row['priv'];
              if ($u_priv == 2) {?>
                <?php $category = "SELECT * FROM `category`";
                $catResults = mysqli_query($conn, $category);
                $catResultCheck = mysqli_num_rows($catResults);
                if ($catResultCheck < 1){
                ?>
                  <p>No Result(s)</p>
                <?php
                }else {
                  ?>
                  <div class="tab-pane fade show active" id="list-category" role="tabpanel" aria-labelledby="list-category-list">
                    <ul class="list-group"><?php
                      while($rowCat = mysqli_fetch_assoc($catResults)){?>
                        <?php $categoryName = $rowCat['Category'];
                        $categoryCount = $rowCat['count'];
                        $newCount = "SELECT COUNT(`category`) AS `$categoryName` FROM `blogs` WHERE `category` LIKE '%$categoryName%'";
                        $countResult = mysqli_query($conn, $newCount);
                        while ($count = mysqli_fetch_assoc($countResult)) {
                          $nCount = $count[$categoryName];
                          $sql = "UPDATE `category` SET `count` = '$nCount' WHERE `category`.`Category` = '$categoryName';";
                          mysqli_query($conn, $sql);
                          ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                              <a href="archive.php?s=<?php echo $rowCat['Category']?>">
                                <?php echo $rowCat['Category']?>
                              </a>
                              <span class="badge badge-primary badge-pill"><?php echo $nCount ?></span>
                            </li>
                        <?php }
                      }?>
                    </ul>
                    <label>New Category</label>
                    <form action="includes/admin/category.inc.php" method="post">
                    <label>Name</label>
                    <input class='form-control'type="text" name="name" value="">
                    <button class='btn btn-primary'type="submit" name="submit">Submit</button>
                    </form>
                  </div>
                  <?php
                }?>
                <div class="tab-pane fade" id="list-user" role="tabpanel" aria-labelledby="list-user-list">
                <h1>jsjsjsjjs</h1>
                </div>
                <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">

                </div>
                <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">

                </div>
              </div>
            </div>
            <?php
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

<?php include 'footer.php'?>
