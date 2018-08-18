<?php
session_start();
    include_once 'includes/dbh.inc.php';
     $sql = "SELECT * FROM users";
     $result = mysqli_query($conn, $sql);
     while($row = mysqli_fetch_assoc($result)){;
    $user_id = $row['user_id'];
    $author = $row['user_uid'];
    ?>
      <p> <?php echo $user_id ?> </p>
      <p> <?php echo $author ?> </p>
    <?php
    $priv = "INSERT INTO `user_priv`(`id`, `priv`,`author`) VALUES ($user_id,0,'$author')";
    mysqli_query($conn, $priv);
    }
    header("Location: index.php?=success");
    exit();
 ?>
