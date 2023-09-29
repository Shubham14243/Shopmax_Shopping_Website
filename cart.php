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

if (isset($_REQUEST['del'])) {
  $pid = $_REQUEST['idget'];
  $sn = $_REQUEST['single'];

  $getd = "SELECT * FROM cart WHERE pid = '$pid'";
  $runn = mysqli_query($conn,$getd);
  $ex = mysqli_fetch_array($runn);
  $qt = (int)$ex[3];
  $pr = (int)$ex[4];
  if ($qt <= 1) {
    $dell = "DELETE FROM cart WHERE pid = '$pid'";
  }
  else{
    $qt = $qt - 1;
    $pr = $pr - $sn;
    $dell = "UPDATE cart SET qty = '$qt', price = '$pr' WHERE pid = '$pid'";
  }
  $rr = mysqli_query($conn,$dell);
  if ($rr) {
    header("location:cart.php");
    exit;
  }
  
}

if (isset($_REQUEST['pro'])) {
  header("location:checkout1.php");
  exit;
}



?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>ShopMax &mdash; Cart</title>
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
          <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Cart</strong></div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row mb-5">
          <form class="col-md-12" method="post">
            <div class="site-blocks-table">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="product-thumbnail">Image</th>
                    <th class="product-name">Product</th>
                    <th class="product-price">Price</th>
                    <th class="product-quantity">Quantity</th>
                    <th class="product-total">Total</th>
                    <th class="product-remove">Remove</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $sql_p = "SELECT * FROM cart WHERE uid = '$uid'";
                    $result_p = mysqli_query($conn,$sql_p);
                    $len = mysqli_num_rows($result_p);
                    
                    if ($len > 0){
                      while($rows_p = mysqli_fetch_array($result_p)){
                        $pid = $rows_p[2];
                        $get = "SELECT * FROM product WHERE pid = '$pid'";
                        $getr = mysqli_query($conn,$get);
                        $putr = mysqli_fetch_array($getr);
                  ?>
                  <tr>
                    <td class="product-thumbnail">
                      <img src="<?php echo"images/product/".$putr[6]; ?>" alt="Image" class="img-fluid">
                    </td>
                    <td class="product-name">
                      <h2 class="h5 text-black"><?php echo $putr[3]; ?></h2>
                    </td>
                    <td><?php echo $putr[5]; ?></td>
                    <td><?php echo $rows_p[3]; ?></td>
                    <td><?php echo $rows_p[4]; ?></td>
                    <td><form>
                      <input type="text" name="single" style="display:none;" value="<?php echo $putr[5]; ?>">
                      <input type="text" name="idget" style="display:none;" value="<?php echo $rows_p[2]; ?>">
                      <button type="submit" name="del" class="btn btn-primary height-auto btn-sm">X</button>
                    </form></td>
                  </tr>
                  <?php 
                      
                      }
                    }
                 ?>
                </tbody>
              </table>
            </div>
          </form>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="row justify-content-end">
              <div class="col-md-7" style="border: 2px solid black;">
                <div class="row">
                  <div class="col-md-12 text-right border-bottom mb-5">
                    <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                  </div>
                </div>
                <div class="row mb-5">
                  <div class="col-md-6">
                    <span class="text-black">Total</span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong class="text-black">
                      <?php
                      $sum = "SELECT SUM(price) FROM cart WHERE uid = '$uid'";
                      $ress = mysqli_query($conn,$sum);
                      $roww = mysqli_fetch_array($ress);
                      echo $roww[0];
                      ?>
                    </strong>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 pl-5">
            <div class="row mb-5">
              <div class="col-md-6">
                <a href="shop.php"><button class="btn btn-outline-primary btn-sm btn-block">Continue Shopping</button></a>
              </div>
              <div class="col-md-6">
                <input type="text" style="display:none;" name="pid" value="<?php echo $rows_v[0]; ?>">
                <input type="text" style="display:none;" name="price" value="<?php echo $rows_v[5]; ?>">
                <input type="text" style="display:none;" id="c2" name="qty" value="">
                <form action="checkout1.php" method="POST">
                  <button type="submit" name="pro" class="btn btn-primary btn-lg btn-block">Proceed To Checkout</button>
                </form>
              </div>
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