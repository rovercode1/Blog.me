<section>
  <div class="container-fluid">
    <div class='container' id="user-box">
      <form class="" action="includes/users/update_profile.inc.php?user=<?php echo $row['user_id'] ?>" method="post" enctype="multipart/form-data">
          Send this file: <input name="UploadImage" type="file">
        <input id='uid-edit'class='form-control'type="text" name="uid" value="<?php echo $row['user_uid']?>">
        <input type="text" id='about-edit' class='form-control'name="about" value="<?php echo $row['user_about'] ?>">
        <div class="collapse" id="moreSettings">
          <div class="card card-body">
            <label>First name</label>
            <input class='form-control'type="text" name="first" value="<?php echo $row['user_first'] ?>">
            <label>Last name</label>
            <input class='form-control'type="text" name="last" value="<?php echo $row['user_last'] ?>">
            <label>Email</label>
            <input class='form-control'type="text" name="email" value="<?php echo $row['user_email'] ?>">
          </div>
        </div>
        <button class='btn btn-primary btn-sm'type="submit" name="submit">Update</button>
      </form>
      <a id="fullSettings" data-toggle="collapse" href="#moreSettings" role="button" aria-expanded="false" aria-controls="moreSettings">
        Full Settings
      </a>
        <div class="buttons">
          <form action="includes/user/delete_profile.inc.php  <?php echo '?user='. $row['user_id']?>" method="post">
            <button class='btn btn-danger btn-sm'type="submit" name="submit">Delete</button>
          </form>

          <a class='btn btn-warning btn-sm' href="profile.php <?php echo '?user='. $row['user_id']?>" >Go Back</a>
        </div>
    </div>
  </div>
</section>
