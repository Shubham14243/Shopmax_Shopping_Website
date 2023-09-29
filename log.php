<?php
session_start();
$show = NULL;
$email = $pswd = "";

if (isset($_REQUEST['log'])) {

  $email = $_REQUEST['email'];
  $pswd = $_REQUEST['password'];

  if (empty($email) || empty($pswd)) {
    $show = "Please Fill All The Fields";
  }
  else{

      $conn = mysqli_connect("localhost","root","","shopmax");

      $sql = "SELECT * FROM user WHERE email = '$email' AND password = '$pswd'";

      $result = mysqli_query($conn,$sql);

      if (($rows=mysqli_fetch_array($result))) {
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $rows[2];
        $_SESSION['uid'] = $rows[0];
        header("location:shop.php");
        exit;
      }
      else{

        $show = "Invalid Login Credentials!!!";

      }

      mysqli_close($conn);
      }

  }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>ShopMax &mdash; Login</title>
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
                <li><a href="log.php">Shop</a></li>
                <li><a href="reg.php">Get Started</a></li>
                <li class="active"><a href="log.php">Login</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>

    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span><strong class="text-black">Login</strong></div>
        </div>
      </div>
    </div>
    
    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-4 mb-5 mb-md-0">
            <h2 class="text-black">Login</h2>
          </div>
          <div class="col-md-6 mb-5 mb-md-0">
            <form method="post">
              <div class="p-3 p-lg-5 border">
                <div class="form-group">

                  <div class="form-group row">
                    <div class="col-md-12">
                      <label for="c_email_address" class="text-black">Email Address <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" value="ankit@email.com" id="c_email_address" name="email">
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-md-12">
                      <label for="c_password" class="text-black">Password <span class="text-danger">*</span></label>
                      <input type="password" class="form-control" value="ankit123" id="c_password" name="password">
                    </div>
                  </div>

                  <label class="text-danger"><?php echo $show; ?></label>

                  <div class="form-group mb-5">
                    <button class="btn btn-primary btn-lg btn-block" type="submit" name="log">LOGIN</button>
                  </div>

                  <div class="col-md-12">
                    <div class="border p-4 rounded" role="alert">
                      <center>New Customer?&nbsp;&nbsp;<a href="reg.php">Get Started</a></center>
                    </div>
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