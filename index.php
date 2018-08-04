<?php  include 'header.php';
 if (isset($_SESSION['u_id'])) {
      include 'main.php';
     }
     else {
        include 'front-page.php';
     ?>
  <?php
}
  include 'footer.php';
?>
