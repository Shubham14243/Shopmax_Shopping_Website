<?php
session_start();
$email = $_SESSION['email'];

$conn = mysqli_connect("localhost","root","","shopmax");
$sql = "SELECT * FROM user WHERE email = '$email'";
$result = mysqli_query($conn,$sql);
$rows = mysqli_fetch_array($result);

//Disp Cart
$uid = $rows[0];
$_SESSION['uid'] = $uid;

$sql_c = "SELECT * FROM cart WHERE uid = '$uid'";
$result_c = mysqli_query($conn,$sql_c);
$rows_count = mysqli_num_rows($result_c);

//Logout
if (isset($_REQUEST['logout'])) {
  session_destroy();
  header("location:log.php");
  exit;
}

$sql_s = "";
if (isset($_POST['search'])) {
  $se = $_REQUEST['search'];
  $sql_s = "SELECT * FROM product WHERE name = '$se'";
  $res_s = mysqli_query($conn,$sql_s);
  $rows_s = mysqli_fetch_array($res_s);
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>ShopMax &mdash; Shop</title>
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

      <div class="search-wrap">
        <div class="container">
          <a href="#" class="search-close js-search-close"><span class="icon-close2"></span></a>
          <form action="" method="POST">
            <input type="text" name="search" class="form-control" placeholder="Search keyword and hit enter...">
          </form>  
        </div>
      </div>

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
                <li><a href="index.php">Home</a></li>
                <li class="active"><a href="shop.php">Shop</a></li>
                <li><a href="#" class="icons-btn d-inline-block js-search-open"><span class="icon-search"></span></a></li>
                <li>
                  <a href="cart.php" class="icons-btn d-inline-block bag">
                    <span class="icon-shopping-bag"></span>
                    <span class="number"><?php echo $rows_count; ?></span>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
          <div class="icons">
            <form>
              <a href="profile.php" class="text-black"><span class="icon-user"></span><?php echo $rows[1]; ?></a>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <button class="btn btn-black d-inline-block" type="submit" name="logout"><span class="icon-exit_to_app">Logout</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="custom-border-bottom py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Shop</strong></div>
        </div>
      </div>
    </div>


    <div class="site-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md-12 order-1">
            <h2 class="text-uppercase text-black"><span class="icon-menu">PRODUCTS</span></h2>
            <div class="row mb-5">
              <?php 
                if(empty($sql_s)){
                $sql_p = "SELECT * FROM product ORDER BY pid";
                $result_p = mysqli_query($conn,$sql_p);
                if (mysqli_num_rows($result) > 0){
                  while($rows_p = mysqli_fetch_array($result_p)){
              ?>
                <div class="col-lg-4 col-md-4 item-entry mb-4">
                  <a href="#" class="product-item md-height bg-gray d-block">
                  <img src="<?php echo "images/product/".$rows_p[6]; ?>" alt="Image" class="img-fluid">
                  </a>
                  <h2 class="item-title"><a href="#"><?php echo $rows_p[3]; ?></a></h2>
                  <h6 class=""><a href="#"><?php echo $rows_p[4]; ?></a></h6>
                  <strong class="item-price">₹<?php echo $rows_p[5]; ?></strong>
                  <form action="shop-single.php" method="POST">
                    <input type="text" style="display:none;" name="getdata" value="<?php echo $rows_p[0]; ?>">
                    <button class="buy-now btn btn-sm height-auto px-4 py-3 btn-primary" type="submit" name="view">VIEW</button>
                  </form>
                </div>
              <?php
                  }
                }
                }
                else
                {
                  if ($rows_s) {
                  ?>
                  <div class="col-lg-6 col-md-6 item-entry mb-4">
                    <a href="#" class="product-item md-height bg-gray d-block">
                    <img src="<?php echo "images/product/".$rows_s[6]; ?>" alt="Image" class="img-fluid">
                    </a>
                    <h2 class="item-title"><a href="#"><?php echo $rows_s[3]; ?></a></h2>
                    <h6 class=""><a href="#"><?php echo $rows_s[4]; ?></a></h6>
                    <strong class="item-price">₹<?php echo $rows_s[5]; ?></strong>
                    <form action="shop-single.php" method="POST">
                      <input type="text" style="display:none;" name="getdata" value="<?php echo $_SESSION['uid']; ?>">
                      <button class="buy-now btn btn-sm height-auto px-4 py-3 btn-primary" type="submit" name="view">VIEW</button>
                    </form>
                  </div>
                  <?php
                }else{
                  ?>
                  <center>
                    <h2 class="text-danger">No <?php echo $se; ?> Found!!!</h2>
                  </center>
                  <?php
                }
                }
              ?>
            </div>
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
                  <li><a href="shop.php">Shop</a></li>
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