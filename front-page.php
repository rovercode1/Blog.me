<?php
  include_once 'includes/dbh.inc.php';
?>
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
        }else{
          ?>
          <form class="" action="includes/index/login.inc.php" method="POST">
            <label>Username/E-mail</label>
            <input class="form-control"type="text" name="uid" placeholder="Username/E-mail">
            <label>Password</label>
            <input class="form-control"type="password" name="pwd" placeholder='Enter Your Password'>
              <button class="btn btn-primary btn-sm"type="submit" name="submit">Sign In</button>
          </form>
          <?php
        }
       ?>
    </div>
      <div class="modal-footer">
        <a class="btn btn-warning btn-sm"href="signup.php">Need an account? Sign Up!</a>
      </div>
    </div>
  </div>
</div>
<section id='showcase'>
  <h1>Create your blog today!</h1>
  <a class="btn "href="#">Get started!</a>
</section>
<section >
  <div class="container">
    <div class="text-field">
      <h1 id='main-text'>Powerful Features </h1>
      <h1>for <span>Your</span>  Website</h1>
    </div>
    <div id="icons">
      <div class="row">
        <div class="col-lg-4">
          <img src="assets/img/desktop.png" alt="">
          <p class='tag'>Beautiful Blogs</p>
        </div>
        <div class="col-lg-4">
          <img src="assets/img/phone.png" alt="">
          <p class='tag'>Mobile Friendly</p>
        </div>
        <div class="col-lg-4">
          <img src="assets/img/seo.png" alt="">
          <p class='tag'>Industry-leading seo</p>
        </div>
      </div>
    </div>
  </div>
</section>
<section>
  <div class="container">
    <div id='features'>
      <h3>Unlease your creativity with our Uniquie Domains, Blog Customizer and <span id='more'>much more!</span> </h3>
      <div id="feature-box">
        <div class="text-box">
          <h2>Your Blog</h2>
          <h2 id='freedom'>Your Freedom</h2>
        </div>
          <img src="assets/img/blog.jpg" alt="">
      </div>
    </div>
  </div>
</section>
<section>
  <div class="container">
    <h2>Spotlight Blogs</h2>
    <div id="blogs">
      <div class="row">
        <div class="col-lg-4">
          (**Blogs go here**)
        </div>
      </div>
    </div>
  </div>
</section>
<section>
  <div class="container">
    <h2>Testimonals</h2>
    <div id='testimonial'>
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="testimonial-box">
              <h1>[USERNAME]</h1>
              <p>Review</p>
            </div>
          </div>
          <div class="carousel-item">
          <div class="testimonial-box">
            <h1>[USERNAME]</h1>
            <p>Review</p>
          </div>
          </div>
          <div class="carousel-item">
          <div class="testimonial-box">
            <h1>[USERNAME]</h1>
            <p>Review</p>
          </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
  </div>
</section>
<section id='contact-us'>
  <div class="container">
    <div id="contact-box">
      <h2>Have any questions?</h2>
      <a href="#">Contact us</a>
      <h2>Ready to get started?</h2>
      <a href="#">Get started!</a>
    </div>
  </div>
</section>
