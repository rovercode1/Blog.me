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
          header("Location: ../../admin.php?success");}
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
