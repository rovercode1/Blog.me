<?php session_start();
  include_once 'includes/dbh.inc.php';
?>
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
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand" href="index.php">Blog.com</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <?php
            if (isset($_SESSION['u_id'])) {
              ?>
            <li class="nav-item active">
              <a class="nav-link" href="blog_form.php">Post New Blog</a>
            </li>
          <?php }?>
          </ul>

          <ul class="navbar-nav ml-auto">
            <?php
            if (isset($_SESSION['u_id'])) {
              ?>
              <li class="nav-item active">
                <a class="nav-link" href="http://localhost/project-website/profile.php?user=<?php echo $_SESSION['u_id']?>">Hello, <?php echo $_SESSION['u_uid'] ?>! </a>
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
