<?php  include 'header.php';?>
<section id='main-site'>
  <div class="top-story">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-lg-6 right-border">
          <div id="top-story">
            <?php include 'includes/pages/index/top-story.inc.php';?>
            <div class="container view-more">
              <a href="<?php echo $fullUrl ?>/archive.php?s=top">View More</a>
            </div>
          </div>
        </div>
        <div class="col-lg-6 md-6">
          <h1 class='main-header'>Most Recent</h1>
          <?php include 'includes/pages/index/most-recent.inc.php';?>
          <div class="container view-more" >
            <a href="<?php echo $fullUrl ?>/archive.php?s=top">View More</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id='featured'>
    <div class="container">
      <h1 class='main-header'>Featured Articles</h1>
      <div class="blog_desc" id='featured'>
        <div class="row">
          <div class="col-lg-12">
            <div id="featured-box">
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <?php include 'includes\pages\index\featured-tabs.inc.php';?>
              </ul>
              <?php include 'includes\pages\index\featured-div.inc.php'?>
              <div class="container view-more">
                <a href="<?php echo $fullUrl ?>/archive.php?s=Featured">View More</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <section>
    <div class="container">
      <div class="row" id='content'>
        <div class="col-lg-4 col-md-4 right-border">
          <div class="col-lg-12">
            <div id="article-len" >
              <h1 class='main-header'>To The Point</h1>
              <?php include 'includes\pages\index\short-articles.inc.php' ?>
              <div class="container view-more">
                <a href="<?php echo $fullUrl ?>/archive.php?s=all">View More</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-8 col-md-12">
          <h2 class='main-header'>Most Popular</h2>
        </div>
      </div>
    </div>
  </section>
</section>
<?php include 'footer.php';?>
