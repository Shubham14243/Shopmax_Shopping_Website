<?php 
$url = NULL;
session_start();
if(isset($_SESSION['uid'])){
  $url = "shop.php";
}else{
  $url = "log.php";
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>ShopMax &mdash; Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700"> 
    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">


    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/style.css">
    
  </head>
  <body>
  
  <div class="site-wrap">
    

    <div class="site-navbar bg-white py-2">
      <div class="container">
        <div class="d-flex align-items-center justify-content-between">
          <div class="logo">
            <div class="site-logo">
              <a href="index.php" class="js-logo-clone">ShopMax</a>
            </div>
          </div>
          <div class="main-nav d-none d-lg-block">
            <nav class="site-navigation text-right text-md-center" role="navigation">
              <ul class="site-menu js-clone-nav d-none d-lg-block">
                <li class="active"><a href="index.php">Home</a></li>
                <li><a href="<?php echo $url; ?>">Shop</a></li>
                <li><a href="reg.php">Get Started</a></li>
                <li><a href="log.php">Login</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>

    <div class="site-blocks-cover" data-aos="fade">
      <div class="container">
        <div class="row">
          <div class="col-md-6 ml-auto order-md-2 align-self-start">
            <div class="site-block-cover-content">
            <h2 class="sub-title">#New Collection 2022</h2>
            <h1>Arrivals Sales</h1>
            <p><a href="<?php echo $url; ?>" class="btn btn-black rounded-0">Shop Now</a></p>
            </div>
          </div>
          <div class="col-md-6 order-1 align-self-end">
            <img src="images/model_3.png" alt="Image" class="img-fluid">
          </div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="title-section mb-5">
          <h2 class="text-uppercase"><span class="d-block">Discover</span> The Collections</h2>
        </div>
        <div class="title-section mb-5">
          <center>
            <h2 class="text-uppercase"><span class="d-block">Fashion</span></h2>
          </center>
        </div>
        <div class="row align-items-stretch">
          <div class="col-lg-8">
            <div class="product-item sm-height full-height bg-gray">
              <a href="<?php echo $url; ?>" class="product-category">Women <span>25 items</span></a>
              <img src="images/model_4.png" alt="Image" class="img-fluid">
            </div>
          </div>
          <div class="col-lg-4">
            <div class="product-item sm-height bg-gray mb-4">
              <a href="<?php echo $url; ?>" class="product-category">Men <span>25 items</span></a>
              <img src="images/model_5.png" alt="Image" class="img-fluid">
            </div>

            <div class="product-item sm-height bg-gray">
              <a href="<?php echo $url; ?>" class="product-category">Shoes <span>25 items</span></a>
              <img src="images/model_6.png" alt="Image" class="img-fluid">
            </div>
          </div>
        </div><br><br>
        <div class="title-section mb-5">
          <center>
            <h2 class="text-uppercase"><span class="d-block">Electronics</span></h2>
          </center>
        </div>
        <div class="row align-items-stretch">
          <div class="col-lg-4">
            <div class="product-item sm-height bg-gray mb-4">
              <a href="<?php echo $url; ?>" class="product-category">Laptop <span>25 items</span></a>
              <img src="images/laptop.jpg" alt="Image" class="img-fluid">
            </div>

            <div class="product-item sm-height bg-gray">
              <a href="<?php echo $url; ?>" class="product-category">Earbuds <span>25 items</span></a>
              <img src="images/buds.jpg" alt="Image" class="img-fluid">
            </div>
          </div>
          <div class="col-lg-8">
            <div class="product-item sm-height full-height bg-gray">
              <a href="<?php echo $url; ?>" class="product-category">Smartphone <span>25 items</span></a>
              <img src="images/phone.png" alt="Image" class="img-fluid">
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="site-blocks-cover inner-page py-5" data-aos="fade">
      <div class="container">
        <div class="row">
          <div class="col-md-6 ml-auto order-md-2 align-self-start">
            <div class="site-block-cover-content">
            <h2 class="sub-title">#New Collection 2022</h2>
            <h1>New Shoes</h1>
            <p><a href="<?php echo $url; ?>" class="btn btn-black rounded-0">Shop Now</a></p>
            </div>
          </div>
          <div class="col-md-6 order-1 align-self-end">
            <img src="images/model_6.png" alt="Image" class="img-fluid">
          </div>
        </div>
      </div>
    </div>
    <hr>
    <footer class="site-footer custom-border-top">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
              <div class="site-logo">
                <a href="index.php" class="js-logo-clone">ShopMax</a>
              </div>
          </div>
          <div class="col-lg-5 ml-auto mb-5 mb-lg-0">
            <div class="row">
              <div class="col-md-12">
                <h3 class="footer-heading mb-4">Quick Links</h3>
              </div>
              <div class="col-md-6 col-lg-4">
                <ul class="list-unstyled">
                  <li><a href="log.php">Shop</a></li>
                  <li><a href="about.php">About</a></li>
                  <li><a href="contact.php">Contact</a></li>
                </ul>
              </div>
              <div class="col-md-6 col-lg-4">
                <ul class="list-unstyled">
                  <li><a href="reg.php">Get Started</a></li>
                  <li><a href="log.php">Login</a></li>
                  <li><a href="log_adm.php">Admin Login</a></li>
                </ul>
              </div>
            </div>
          </div>
          
          <div class="col-md-6 col-lg-3">
            <div class="block-5 mb-5">
              <h3 class="footer-heading mb-4">Contact Info</h3>
              <ul class="list-unstyled">
                <li class="address">Ranchi, India</li>
                <li class="phone">+91 99887 76655</li>
                <li class="email">shubham@email.com</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </footer>
  </div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>

  <script src="js/main.js"></script>
    
  </body>
</html>