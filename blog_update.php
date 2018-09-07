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
  if ($priv > 0) {
  $post_id = $_GET['blog'];
  $sql = "SELECT * FROM `blogs` WHERE `post_id` = '$post_id'";
  // result = what is found in the database
  $result = mysqli_query($conn, $sql);
  $resultCheck = mysqli_num_rows($result);
  // If there are no results in the database...
  if ($resultCheck < 1) {
    header("Location: index.php?blog=noblog");
    exit();
  }else{
  $row = mysqli_fetch_assoc($result);
  // If the current user is not the author
  // of the blog, redirect to home page.

  $privsql = "SELECT * FROM `user_priv` WHERE id = $id AND priv >  1";
  $privResult = mysqli_query($conn, $privsql);
    $privRow = mysqli_fetch_assoc($privResult);
    $userpriv = $privRow['priv'];
  // If user is admin - allow update.
  if($_SESSION['u_id'] == $row['post_author'] || $userpriv = 2 ) {
    include 'includes\pages\blog_form\update_blog_form.inc.php';
  } else{
    header("Location: http://localhost/project-website/index.php?update_blog_form=error");
    exit();
  };
  };
}else{
  header("Location: http://localhost/project-website/index.php?update_blog_form=error");
  exit();
}
  }
};
include 'footer.php';
?>
