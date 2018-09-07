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
    include 'includes\pages\blog_form\new_blog_form.inc.php';
  }else{
  header("Location: index.php?error");
  exit();}
  }
  }
include 'footer.php';
?>
