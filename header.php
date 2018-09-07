<?php session_start();
  include_once 'includes/dbh.inc.php';
  include_once 'includes/allvar.php';?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<meta charset="utf-8">
<title></title>
<link rel="stylesheet" href="style.css">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

<link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto:400,700" rel="stylesheet">
</head>
<body>
<?php
if (isset($_SESSION['u_id'])) {
  $id = $_SESSION['u_id'];
  $sql = "SELECT * FROM `user_priv` WHERE id = $id";
  $result = mysqli_query($conn, $sql);
  while($row = mysqli_fetch_assoc($result)){
    $author = $row['author'];
    $priv = $row['priv'];
if ($priv == 2) {
      include 'includes\pages\header\admin_nav_bar.inc.php';
    }
  }
}
 ?>
    <nav id='user-nav' class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand" href="index.php">hotspot.com</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <?php include 'includes\pages\header\category_navbar.inc.php'; ?>
          </ul>
          <ul class="navbar-nav ml-auto">
            <?php
            if (isset($_SESSION['u_id'])) {
              ?>
              <li class="nav-item active">
                <a class="nav-link" href="http://localhost/news-website/profile.php?user=<?php echo $_SESSION['u_id']?>">Hello, <?php echo $_SESSION['u_uid'] ?>! </a>
              </li>
              <form  action="includes/index/logout.inc.php" method="POST">
                <button class="btn btn-warning btn-sm"type="submit" name="submit">Log Out</button>
              </form>
                <?php
              }
              else{
                ?>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#logginModal">
                  Loggin/Signup
                </button>
                <?php
              }?>
          </ul>
        </div>
      </div>
    </nav>
    <div class="modal fade" id="logginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form class="" action="includes/index/login.inc.php" method="POST">
            <label>Username/E-mail</label>
              <input class="form-control"type="text" name="uid" placeholder="Username/E-mail">
              <label>Password</label>
              <input class="form-control"type="password" name="pwd" placeholder='Enter Your Password'>
              <button class="btn btn-primary btn-sm"type="submit" name="submit">Sign In</button>
            </form>
          </div>
          <div class="modal-footer">
            <a class="btn btn-warning btn-sm"href="signup.php">Need an account? Sign Up!</a>
          </div>
        </div>
      </div>
    </div>
