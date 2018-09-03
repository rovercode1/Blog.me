<?php
session_start();
// If submit button has been clicked...
if (isset($_SESSION['u_id'])) {
  if (isset($_POST['submit'])) {
    include_once '../../dbh.inc.php';
    $category = $_GET['c'];
    $sql = "DELETE FROM `category` WHERE `category`.`Category` = '$category'";
    $result = mysqli_query($conn, $sql);
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
