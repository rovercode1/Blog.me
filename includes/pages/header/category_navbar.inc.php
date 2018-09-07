<?php
if (isset($_SESSION['u_id'])) {
  $sql = "SELECT Category from category limit 4";
  $result = mysqli_query($conn, $sql);
  while ($row = mysqli_fetch_assoc($result)) {
    ?>
    <li class="nav-item">
      <a href="archive.php?s=<?php echo $row['Category']?>">
        <?php echo $row['Category']?>
      </a>
    </li>
    <?php
  }
}
?>
