<?php include 'header.php';
// If user is signed in
if (isset($_SESSION['u_id'])) {
    $sql = "SELECT * FROM blogs";
    $result = mysqli_query($conn, $sql);
    $total = mysqli_num_rows($result);
    if ($total < 1) {
      ?>
        <p>Blog not found.</p>
      <?php
    }else{
        $limit = 3;
        $offset = $total + 1 - $limit;
        $blogs ="SELECT * FROM blogs LIMIT $limit OFFSET $offset";
        $Blogresult = mysqli_query($conn, $blogs);
        $Blogtotal = mysqli_num_rows($Blogresult);
        if ($Blogtotal < 1) {
          ?>
            <p>Blog not found.</p>
          <?php
        }else{

      while ($row = mysqli_fetch_assoc($Blogresult)) {
        ?>
          <h5> <?php echo $row['post_title'] ?> </h5>
          <p> <?php echo $row['post_id'] ?> </p>
        <?php
      }
    }
}
}else{
    header("Location: ../../index.php");
    exit();
  }
include 'footer.php';
?>
