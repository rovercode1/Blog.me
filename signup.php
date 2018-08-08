<?php include 'header.php' ?>
  <section>
    <div class="container">
      <div class="main-wrapper">
        <h2>SignUp</h2>
        <form id="signup" action="includes/index/signup.inc.php" method="post">
            <label>First Name</label>
          <input class="form-control"type="text" name="first" placeholder="Enter first name"required>
            <label>Last Name</label>
          <input class="form-control"type="text" name="last" placeholder="Enter last name"required>
            <label>E-mail</label>
          <input class="form-control"type="text" name="email" placeholder="Enter email"required>
          <label>Username</label>
          <input class="form-control"type="text" name="uid" placeholder="Enter username"required>
            <label>Password</label>
          <input class="form-control"type="password" name="pwd" placeholder="Password"required>
          <button class="form-control btn btn-primary"type="submit" name="submit">Sign Up</button>
        </form>

      </div>
    </div>
  </section>
<?php include 'footer.php' ?>
