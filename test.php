<?php
include 'header.php';
  include_once 'includes/dbh.inc.php';
  $id = $_SESSION['u_id'];
  $privSql = "SELECT * FROM `user_priv` WHERE id = $id";
  $resultPriv = mysqli_query($conn, $privSql);
  while($privrow = mysqli_fetch_assoc($resultPriv)){
    $author = $privrow['author'];
    $priv = $privrow['priv'];
    if ($priv > 0) {
      ?>
        <p><?php echo $author ?></p>
        <p><?php echo $priv ?></p>
        <?php
    }
  }
include 'footer.php';?>
