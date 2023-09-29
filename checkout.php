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

if (isset($_REQUEST['buy'])) {
  $pid = $_REQUEST['pid'];
  $qty = $_REQUEST['qty'];
  $price = $_REQUEST['price'];
  $data = "SELECT * FROM product WHERE pid = '$pid'";
  $dat = mysqli_query($conn,$data);
  $getd = mysqli_fetch_array($dat);
}

if (isset($_REQUEST['place'])) {
  $user = $_REQUEST['uid'];
  $product = $_REQUEST['pid'];
  $pr = $_REQUEST['price'];
  $status = "Out For Delivery!";
  $method = "Cash On Delivery";
  $ss = "INSERT INTO orders(uid, pid, price, status, method) VALUES('$user', '$product', '$pr', '$status', '$method')";
  $rt = mysqli_query($conn,$ss);
  if ($rt) {
    header("location:profile.php#tq");
    exit;
  }
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>ShopMax &mdash; Checkout</title>
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
          <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span> <a href="shop.php">Shop</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Checkout</strong></div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row">
          <form method="post">
            <div class="p-3 p-lg-5 border">
              <h2 class="h3 mb-3 text-black">Billing Details</h2>
              <div class="form-group">
                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="c_fname" class="text-black">Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="c_fname" name="name" value="<?php echo $rows[1]; ?>">
                  </div>

                  <div class="col-md-6">
                    <label for="c_phone" class="text-black">Phone No <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="c_phone" name="phone" value="<?php echo $rows[2]; ?>">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="c_email_address" class="text-black">Email Address <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="c_email_address" name="email"value="<?php echo $rows[3]; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label for="c_address" class="text-black">Address</label>
                  <textarea name="address" id="c_address" cols="30" rows="4" class="form-control" ><?php echo $rows[5]; ?></textarea>
                </div>

              </div>
            </div>
          </form>
          <div class="col-md-6">            
            <div class="row mb-5">
              <div class="col-md-12">
                <h2 class="h3 mb-3 text-black">Your Order</h2>
                <div class="p-3 p-lg-5 border"> 
                  <table class="table site-block-order-table mb-5">
                    <thead>
                      <th>Product</th>
                      <th>Total</th>
                    </thead>
                    <tbody>
                      <tr>
                        <td><?php echo $getd[3];?><strong class="mx-2">x</strong><?php echo $qty; ?></td>
                        <td>₹<?php echo $price; ?></td>
                      </tr>
                      <tr>
                        <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                        <td class="text-black font-weight-bold"><strong>₹<?php echo $price; ?><strong></td>
                      </tr>
                    </tbody>
                  </table>

                  <div class="border p-3 mb-5">
                    <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsepaypal" role="button" aria-expanded="false" aria-controls="collapsepaypal">Cash On Delivery</a></h3>

                    <div class="" id="collapsepaypal">
                      <div class="py-2">
                        <p class="mb-0">Make your payment directly by Cash when your product is Delivered. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                      </div>
                    </div>
                  </div>
                  <form action="" method="POST">
                    <input type="text" style="display: none;" name="uid" value="<?php echo $uid; ?>">
                    <input type="text" style="display: none;" name="pid" value="<?php echo $pid; ?>">
                    <input type="text" style="display: none;" name="price" value="<?php echo $price; ?>">
                    <div class="form-group">
                      <button type="submit" name="place" class="btn btn-primary btn-lg btn-block">Place Order</button>
                    </div>
                  </form>
                </div>
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