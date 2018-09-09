<?php
session_start();
// If submit button has been clicked...
if (isset($_SESSION['u_id'])) {
  if (isset($_POST['submit'])) {
    include_once '../../dbh.inc.php';
    $newCategory ='';
    $category = $_GET['c'];
    $sql = "DELETE FROM `category` WHERE `category`.`Category` = '$category'";
    $result = mysqli_query($conn, $sql);
    // Remove category from blog database
    $categorysql = "SELECT category, post_id from blogs where category like `%$category%`";
    $id = '';
    $cresult = mysqli_query($conn, $categorysql);
    while ($row = mysqli_fetch_assoc($cresult)) {
      $oldcategory = explode(',',$row['category']);
        $x = array_search($category, $oldcategory);
        unset($oldcategory[$x]);
        $id = $row['post_id'];
        if (sizeof($category) > 0) {
            $newCategory = implode(",",$oldcategory);
        }
    }
    $input = "UPDATE `blogs` SET `category` = '$newCategory' WHERE `blogs`.`post_id` = 55";
    mysqli_query($conn, $input);
    header("Location: $fullUrl/admin.php?tab=category&delete=success");
    exit();
  }else {
    header("Location: ../../index.php");
    exit();
  }
}else {
  header("Location: ../../index.php");
  exit();
}
?>
