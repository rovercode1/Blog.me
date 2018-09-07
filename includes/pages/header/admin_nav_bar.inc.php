<nav id ='admin-bar' class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <?php
        if (isset($_SESSION['u_id'])) {
          $id = $_SESSION['u_id'];
          $sql = "SELECT * FROM `user_priv` WHERE id = $id";
          $result = mysqli_query($conn, $sql);
          while($row = mysqli_fetch_assoc($result)){
            $author = $row['author'];
            $priv = $row['priv'];
            if ($priv >= 1) {
              ?>
                <li class="nav-item ">
                  <a class="nav-link" href="blog_form.php">Post New Blog</a>
                </li>
                <?php
            }if ($priv == 2) {
              ?>
              <li class="nav-item ">
                <a class="nav-link" href="admin.php">Dashboard</a>
              </li>
              <?php
            }
          }
        }
        ?>
      </ul>
    </div>
  </div>
</nav>
<!--  -->
