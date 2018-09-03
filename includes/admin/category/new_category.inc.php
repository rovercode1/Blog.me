<?php
session_start();
// If submit button has been clicked...
if (isset($_SESSION['u_id'])) {
  include_once '../dbh.inc.php';
  $id = $_SESSION['u_id'];
  $privSql = "SELECT * FROM `user_priv` WHERE id = $id";
  $resultPriv = mysqli_query($conn, $privSql);
  while($privrow = mysqli_fetch_assoc($resultPriv)){
    $author = $privrow['author'];
    $priv = $privrow['priv'];
      if ($priv == 2) {
        if (isset($_POST['submit'])) {
        $author = $_SESSION["u_id"];
        $name = mysqli_real_escape_string($conn,$_POST['name']);
          if (empty($name)){
            header("Location: ../../admin.php?field=empty");
            exit();
          }
          else{
          $sql = "INSERT INTO category (Category) VALUES ('$name');";
          mysqli_query($conn, $sql);
          $category = "SELECT * FROM `Category`";
          $catResults = mysqli_query($conn, $category);
          $checkCat = mysqli_num_rows($catResults);
          if ($checkCat < 1) {
            header("Location: ../../admin.php?category=false");
            exit();
          }else{
            while ($row = mysqli_fetch_assoc($catResults)) {
              $categoryName = $row['Category'];
              $categoryCount = $row['count'];
              $newCount = "SELECT COUNT(`category`) AS `$categoryName` FROM `blogs` WHERE `category` LIKE '%$categoryName%'";
                $countResult = mysqli_query($conn, $newCount);
                while ($count = mysqli_fetch_assoc($countResult)) {
                  $nCount = $count[`$categoryName`];
                  $sql = "UPDATE `category` SET `count` = '$nCount' WHERE `category`.`Category` = '$categoryName';";
                  mysqli_query($conn, $sql);
                  header("Location: ../../admin.php?success");
                }
              }
            }
          }

      }else{
      header("Location: ../../index.php");
      exit();}
    }else{
    header("Location: ../../index.php");
    exit();}
  }
}else{
header("Location: ../../index.php");
exit();
}
