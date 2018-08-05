<?php
include 'header.php';
include 'includes/dbh.inc.php';
$post_id = $_GET['blog'];
  // If user is logged in...
  if (isset($_SESSION['u_id'])) {
    $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
      // Find the blog in database
      $sql  ="SELECT * FROM blogs WHERE post_id ='$post_id'";
      // result = what is found in the database
      $result = mysqli_query($conn, $sql);
      $resultCheck = mysqli_num_rows($result);
      // If there are no results in the database...
      if ($resultCheck < 1) {
        // header("Location: ../blogs.php?blog=error");
        ?>
          <p>Blog not found.</p>
        <?php
        exit();
      }else{
          $row = mysqli_fetch_assoc($result)
          ?>
            <h4><?php echo $row['post_title'] ?> </h4>
            <p> <?php echo $row['post_body'] ?> </p>
            <p> <?php echo $row['post_author'] ?> </p>
            <p> <?php echo $row['post_date'] ?> </p>
          </div>
        <?php
    }
  }else{
    header("Location: ../index.php");
        exit();
  }
?>
<?php include 'footer.php' ?>
