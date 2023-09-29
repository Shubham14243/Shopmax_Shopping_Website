<?php
session_start();
$email = $_SESSION['email'];
$show = "Your Order was Successfully Completed!!!";

$conn = mysqli_connect("localhost","root","","shopmax");
$sql = "SELECT * FROM user WHERE email = '$email'";
$result = mysqli_query($conn,$sql);
$rows = mysqli_fetch_array($result);

//Disp Cart
$uid = $rows[0];

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
  $dell = "DELETE FROM orders WHERE pid = '$pid'";
  $rr = mysqli_query($conn,$dell);
  $show = "Your Order Was Successfully Cancelled!!!";
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

    <div class="custom-border-bottom py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Profile</strong></div>
        </div>
      </div>
    </div>


    <div class="site-section">
      <div class="container">
        <div class="row">
          <form method="post" class="col-12 mb-5">
            <div class="p-3 p-lg-5 border">
              <h2 class="h3 mb-3 text-black">POFILE DETAILS</h2>
              <div class="form-group">
                <div class="form-group row">
                  <div class="col-md-3">
                    <label for="c_fname" class="text-black">Name </label>
                    <input type="text" class="form-control" id="c_fname" name="name" value="<?php echo $rows[1]; ?>"disabled>
                  </div>

                  <div class="col-md-3">
                    <label for="c_phone" class="text-black">Phone No </label>
                    <input type="text" class="form-control" id="c_phone" name="phone" value="<?php echo $rows[2]; ?>"disabled>
                  </div>
                  <div class="col-md-6">
                    <label for="c_email_address" class="text-black">Email Address </label>
                    <input type="text" class="form-control" id="c_email_address" name="email"value="<?php echo $rows[3]; ?>" disabled>
                  </div>
                </div>

                <div class="form-group">
                  <label for="c_address" class="text-black">Address</label>
                  <textarea name="address" id="c_address" cols="30" rows="4" class="form-control" disabled><?php echo $rows[5]; ?></textarea>
                </div>

              </div>
            </div>
          </form>
        </div>

        <div class="row" id="tq">
          <div class="col-md-12 text-center">
            <span class="icon-check_circle display-3 text-success"></span>
            <h2 class="display-3 text-black">Thank you!</h2>
            <p><a href="shop.php" class="btn btn-sm height-auto px-4 py-3 btn-primary">Back to shop</a></p>
          </div>
        </div>

        <div class="row">
          <form method="post" class="col-12">
            <div class="p-3 p-lg-5 border">
              <div class="row">
                <h2 class="h3 mb-3 text-black">YOUR ORDERS</h2>
                <h5 class="text-danger" style="position:absolute;right:10%;"><span class="icon-info2 text-black"></span><?php echo $show; ?></h5>
              </div>
              <div class="form-group">
                <div class="form-group row">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th class="product-thumbnail">Image</th>
                        <th class="product-name">Product</th>
                        <th class="product-price">Status</th>
                        <th class="product-quantity">Payment Mode</th>
                        <th class="product-quantity">Date & Time</th>
                        <th class="product-total">Total</th>
                        <th class="product-total">Cancel Order</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $sql_p = "SELECT * FROM orders WHERE uid = '$uid'";
                        $result_p = mysqli_query($conn,$sql_p);
                        $len = mysqli_num_rows($result);
                        
                        if ($len > 0){
                          while($rows_p = mysqli_fetch_array($result_p)){
                            $pid = $rows_p[2];
                            $get = "SELECT * FROM product WHERE pid = '$pid'";
                            $getr = mysqli_query($conn,$get);
                            $putr = mysqli_fetch_array($getr);
                      ?>
                      <tr>
                        <td class="col-md-3">
                          <img src="<?php echo"images/product/".$putr[6]; ?>" style="height: 70%;width: 70%;" alt="Image" class="img-fluid">
                        </td>
                        <td class="product-name">
                          <h2 class="h5 text-black"><?php echo $putr[3]; ?></h2>
                        </td>
                        <td><?php echo $rows_p[4] ?></td>
                        <td><?php echo $rows_p[5]; ?></td>
                        <td><?php echo "DATE - ".date('d:m:y', strtotime($rows_p[6])); ?><br><?php echo "TIME - ".date("H:i",strtotime($rows_p[6])); ?></td>
                        <td><?php echo $rows_p[3]; ?></td>
                        <td>
                          <form>
                            <input type="text" name="idget" style="display:none;" value="<?php echo $rows_p[2]; ?>">
                            <button type="submit" name="del" class="btn btn-primary height-auto btn-sm">X</button>
                          </form>
                        </td>
                      </tr>
                      <?php 
                          
                          }
                        }
                     ?>
                     <tr>
                       <td colspan="4" class="h6 text-danger text-black">YOUR PRODUCT WILL BE DELIVERED WITHIN 10 WORKING DAYS!!!</td>
                       <td><h2 class="h6 text-black">TOTAL AMOUNT</h2></td>
                       <td><?php
                        $tot = "SELECT SUM(price) FROM orders WHERE uid = '$uid'";
                        $resu = mysqli_query($conn,$tot);
                        $dis = mysqli_fetch_array($resu);
                        echo $dis[0];
                        ?></td>
                     </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
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