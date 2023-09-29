<?php
session_start();
$email = $_SESSION['email'];
$uid = $_SESSION['uid'];

$show = NULL;

$conn = mysqli_connect("localhost","root","","shopmax");
$sql = "SELECT * FROM user WHERE email = '$email'";
$result = mysqli_query($conn,$sql);
$rows = mysqli_fetch_array($result);

//Disp Cart
$sql_c = "SELECT * FROM cart WHERE uid = '$uid'";
$result_c = mysqli_query($conn,$sql_c);
$rows_count = mysqli_num_rows($result_c);

//Logout
if (isset($_REQUEST['logout'])) {
  session_destroy();
  header("location:log.php");
  exit;
}

if (isset($_REQUEST['view'])) {
  $pid = $_REQUEST['getdata'];
  $sql_v = "SELECT * FROM product WHERE pid = '$pid'";
  $result_v = mysqli_query($conn,$sql_v);
  $rows_v = mysqli_fetch_array($result_v);
}

if (isset($_REQUEST['add'])) {
  $pid = $_REQUEST['pid'];
  $qty = $_REQUEST['qt'];
  $price = $_REQUEST['price'];

  $qty = (int)$qty;

  if ($qty == 0) {
    $show = "Can't Add 0 Items!";
  }
  else{
    $view = "SELECT * FROM cart WHERE pid = '$pid'";
    $exe = mysqli_query($conn,$view);
    $rrr = mysqli_fetch_array($exe);
    if ($rrr) {
      $pqt = (int)$rrr[3];
      $pqt = $qty + $pqt;
      $price = (int)$price;
      $total = bcmul($pqt, $price);

      $insr = "UPDATE cart SET qty = '$pqt', price = '$total' WHERE pid = '$pid'";
      $res_r = mysqli_query($conn,$insr);
      if ($res_r) {
        header("location:cart.php");
        exit;
      }
    }
    else{
      $price = (int)$price;
      $total = bcmul($qty, $price);

      $ins = "INSERT INTO cart (uid, pid, qty, price) VALUES('$uid','$pid', '$qty', '$total')";
      $res_ins = mysqli_query($conn,$ins);

      if($res_ins){
        header("location:cart.php");
        exit;
      }

    }
  }
}


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>ShopMax &mdash; View Item</title>
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
    <script type="text/javascript">
      function a()
      {
        num = c1.value;
        c2.value = num;
        document.getElementById("c2").innerHTML=num;
      }
    </script>
  
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
                <li><a href="index.php">Home</a></li>
                <li class="active"><a href="shop.php">Shop</a></li>
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
    
   

    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span> <a href="shop.php">Shop</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">View</strong></div>
        </div>
      </div>
    </div>  

    <div class="site-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-7 site-section-heading text-center pt-4">
            <h2>Selected Product</h2>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-6">
            <div class="item-entry">
              <a href="#" class="product-item md-height bg-gray d-block">
                <img src="<?php echo "images/product/".$rows_v[6]; ?>" alt="Image" class="img-fluid">
              </a>
              
            </div>

          </div>
          <div class="col-md-6">
            <form action="" method="POST">
              <h2 class="text-black"><?php echo $rows_v[3]; ?></h2>
              <p><?php echo $rows_v[4]; ?></p>
              <p><strong class="text-primary h4">₹<?php echo $rows_v[5]; ?></strong></p>
              <div class="mb-5">
                <div class="input-group mb-3" style="max-width: 120px;">
                <div class="input-group-prepend">
                  <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                </div>
                <input type="text" class="form-control text-center" id="c1" name="qt" value="1" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                <div class="input-group-append">
                  <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                </div>
              </div>
              <p><?php echo $show; ?></p>
              </div>
              <p>
                <input type="text" style="display:none;" name="pid" value="<?php echo $rows_v[0]; ?>">
                <input type="text" style="display:none;" name="price" value="<?php echo $rows_v[5]; ?>">
              </p>
              <button class="buy-now btn btn-sm height-auto px-4 py-3 btn-primary col-lg-3" name="add" type="submit">Add To Cart</button>
            </form><br>
            <form action="checkout.php" method="POST">
              <input type="text" style="display:none;" name="pid" value="<?php echo $rows_v[0]; ?>">
              <input type="text" style="display:none;" name="price" value="<?php echo $rows_v[5]; ?>">
              <input type="text" style="display:none;" id="c2" name="qty" value="">
              <button name="buy" type="submit" class="col-lg-3 buy-now btn btn-sm height-auto px-4 py-3 btn-primary" onmouseover="a()">Buy Now</button>
            </form>           
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