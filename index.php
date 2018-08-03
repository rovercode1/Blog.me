<?php include 'header.php' ?>
<section>
  <?php
  if (!isset($_SESSION['u_id'])) {
    ?>
    <?php include 'front-page.php' ?>
    <?php }
     ?>
</section>

  <section>
    <div class="container">
      <div class="row">
        <?php   if (isset($_SESSION['u_id'])) {
        ?>
          <!-- <h1>YOU ARE LOGEGD IN!</h1> -->
        <?php } ?>
        </div>
      </div>
    </div>
  </section>
<?php include 'footer.php' ?>
