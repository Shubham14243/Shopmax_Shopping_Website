<?php
session_start();
$email = $_SESSION['email'];
$show = NULL;

$conn = mysqli_connect("localhost","root","","shopmax");

$ad = "SELECT * FROM admin WHERE email = '$email'";
$adm = mysqli_query($conn,$ad);
$admin = mysqli_fetch_array($adm);

//Logout
if (isset($_REQUEST['logout'])) {
  session_destroy();
  header("location:index.php");
  exit;
}

if (isset($_REQUEST['del_u'])) {
  $id_u = $_REQUEST['get_uid'];
  $dell_u1 = "DELETE FROM user WHERE uid = '$id_u'";
  $dell_u2 = "DELETE FROM cart WHERE uid = '$id_u'";
  $dell_u3 = "DELETE FROM orders WHERE uid = '$id_u'";
  $res_u1 = mysqli_query($conn,$dell_u1);
  $res_u2 = mysqli_query($conn,$dell_u2);
  $res_u3 = mysqli_query($conn,$dell_u3);
}

if (isset($_REQUEST['add_u'])) {

  $name = $_REQUEST['name'];
  $phone = $_REQUEST['phone'];
  $email = $_REQUEST['email'];
  $pswd = $_REQUEST['password'];
  $pswd1 = $_REQUEST['password1'];
  $address = $_REQUEST['address'];

  if ($pswd == $pswd1){
    $conn = mysqli_connect("localhost","root","","shopmax");

    $sql = "INSERT INTO user (name, phone, email, password, address) VALUES ('$name', '$phone', '$email',  '$pswd', '$address')";
    if (mysqli_query($conn,$sql)) {
      $show = "User Added!";
    }
    else 
    {
      $show = "Error Occured! Try Again Later!";
    }
  }
  else
  {
    $show = "Password Not Matched! Try Again!";
  }
}


if (isset($_REQUEST['del_p'])) {
  $id_p = $_REQUEST['get_pid'];
  $dell_p = "DELETE FROM product WHERE pid = '$id_p'";
  $res_p = mysqli_query($conn,$dell_p);
}

if(isset($_REQUEST['add_p'])){
  $type = $_REQUEST['type'];
  $category = $_REQUEST['category'];
  $name = $_REQUEST['name'];
  $desc = $_REQUEST['desc'];
  $price = $_REQUEST['price'];

  $filename = $_FILES["image"]["name"];
  $target_dir = "images/product/"; 
  
  $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    $extensions_arr = array("jpg","jpeg","png","gif","jfif","webp");
    
    if( in_array($imageFileType,$extensions_arr) ){
      if(move_uploaded_file($_FILES['image']['tmp_name'],$target_dir.$filename)){ 
        $sql_p = "INSERT INTO product (type, category, name, description, price, image) VALUES ('$type', '$category', '$name',  '$desc', '$price', '$filename')";
        $result_p = mysqli_query($conn,$sql_p);
        }
    }
    
}

if (isset($_REQUEST['del_o'])) {
  $id_o = $_REQUEST['get_oid'];
  $dell_o = "DELETE FROM orders WHERE oid = '$id_o'";
  $res_o = mysqli_query($conn,$dell_o);
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>ShopMax &mdash; Admin</title>
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
      function close_u()
      {
        document.getElementById("ad_u").style="display:none";
      }
      function disp_add_u()
      {
        document.getElementById("ad_u").style="display:block";
      }
      function close_p()
      {
        document.getElementById("ad_p").style="display:none";
      }
      function disp_add_p()
      {
        document.getElementById("ad_p").style="display:block";
      }
    </script>
  
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
                <li><a href="#">ADMIN <span class="icon-arrow-right"></span></a></li>
                <li><a href="admin.php" class="icons-btn d-inline-block"><span class="icon-user"><?php echo $admin[1]; ?></span></a></li>
              </ul>
            </nav>
          </div>
          <div class="icons">
            <form>
              <button class="btn btn-black d-inline-block" type="submit" name="logout"><span class="icon-exit_to_app">Logout</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="custom-border-bottom py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">ADMIN PANEL</strong>
          </div>
          <br><br><br>
          <a href="#ud" class="btn btn-primary height-auto btn-sm">USER DETAIL</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="#pd" class="btn btn-primary height-auto btn-sm">PRODUCT DETAIL</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="#od" class="btn btn-primary height-auto btn-sm">ORDER DETAIL</a>
        </div>
      </div>
    </div>



    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-12 mb-5">
            <div class="p-3 p-lg-5 border"  id="ud">
              <div class="form-group row">
                <div class="col-md-3">
                  <h2 class="h3 mb-3 text-black">USER DETAILS</h2>
                </div>
                <div class="col-md-3">
                    <button onclick="disp_add_u()" class="btn btn-primary height-auto btn-sm">ADD USER</button>
                </div>
              </div>
              <div class="form-group">
                <div id="ad_u" style="display:none;">
                <form method="post">
                  <div class="p-3 p-lg-5 border">
                    <div class="form-group">
                      <div class="form-group row">
                        <div class="col-md-6">
                          <label for="c_fname" class="text-black">Name <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="c_fname" name="name">
                        </div>
                        <div class="col-md-6">
                          <label for="c_phone" class="text-black">Phone No <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="c_phone" name="phone">
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-md-12">
                          <label for="c_email_address" class="text-black">Email Address <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="c_email_address" name="email">
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-md-6">
                          <label for="c_password" class="text-black">Password <span class="text-danger">*</span></label>
                          <input type="password" class="form-control" id="c_password" name="password">
                        </div>
                        <div class="col-md-6">
                          <label for="c_password1" class="text-black">Confirm Password <span class="text-danger">*</span></label>
                          <input type="password" class="form-control" id="c_password1" name="password1">
                        </div>
                      </div>

                      <div class="form-group mb-5">
                        <label for="c_address" class="text-black">Address</label>
                        <textarea name="address" id="c_address" cols="30" rows="4" class="form-control" placeholder="Enter Your Detailed Address With PinCode!!!"></textarea>
                      </div>
                      <label class="text-danger"><?php echo $show; ?></label>
                      <div class="form-group row">
                        <div class="col-md-6">
                          <button class="btn btn-primary btn-lg btn-block" type="submit" name="add_u">ADD USER</button>
                        </div>
                        <div class="col-md-6">
                          <button class="btn btn-primary btn-lg btn-block" onclick="close_u()" >CLOSE FORM</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
                </div>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th class="product-thumbnail">USER ID</th>
                      <th class="product-name">NAME</th>
                      <th class="product-price">PHONE</th>
                      <th class="product-quantity">EMAIL</th>
                      <th class="product-total">ADDRESS</th>
                      <th class="product-remove">Remove</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $sql_u = "SELECT * FROM user WHERE name != 'ADMIN'";
                      $result_u = mysqli_query($conn,$sql_u);
                      $len = mysqli_num_rows($result_u);
                      
                      if ($len > 0){
                        while($rows_u = mysqli_fetch_array($result_u)){
                    ?>
                    <tr>
                      <td class="product-thumbnail">
                        <?php echo $rows_u[0]; ?>
                      </td>
                      <td class="product-name">
                        <h2 class="h5 text-black"><?php echo $rows_u[1]; ?></h2>
                      </td>
                      <td><?php echo $rows_u[2]; ?></td>
                      <td><?php echo $rows_u[3]; ?></td>
                      <td><?php echo $rows_u[5]; ?></td>
                      <td><form>
                        <input type="text" name="get_uid" style="display:none;" value="<?php echo $rows_u[0]; ?>">
                        <button type="submit" name="del_u" class="btn btn-primary height-auto btn-sm">X</button>
                      </form></td>
                    </tr>
                    <?php 
                        
                        }
                      }
                   ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12 mb-5">
            <div class="p-3 p-lg-5 border" id="pd">
              <div class="form-group row">
                <div class="col-md-3">
                  <h2 class="h3 mb-3 text-black">PRODUCT DETAILS</h2>
                </div>
                <div class="col-md-3">
                    <button onclick="disp_add_p()" class="btn btn-primary height-auto btn-sm">ADD PRODUCT</button>
                </div>
              </div>
              <div class="form-group">
                <div id="ad_p" style="display:none;">
                <form method="post" enctype="multipart/form-data">
                  <div class="p-3 p-lg-5 border">
                    <div class="form-group">
                      <div class="form-group row">
                        <div class="col-md-6">
                          <label for="c_fname" class="text-black">Type <span class="text-danger">*</span></label>
                          <select class="form-control" id="c_fname" name="type">
                            <option>Select Product Type</option>
                            <option value="elec">Electronics</option>
                            <option value="fash">Fashion</option>
                          </select>
                        </div>
                        <div class="col-md-6">
                          <label for="c_phone" class="text-black">Category <span class="text-danger">*</span></label>
                          <select class="form-control" id="c_phone" name="category">
                            <option>Select Product Category</option>
                            <option value="laptop">Laptop</option>
                            <option value="phone">Smartphone</option>
                            <option value="buds">Earbuds</option>
                            <option value="men">Men</option>
                            <option value="women">Women</option>
                            <option value="shoe">Shoes</option>
                          </select>
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-md-6">
                          <label for="c_password" class="text-black">Name <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="c_password" name="name">
                        </div>
                        <div class="col-md-6">
                          <label for="c_password1" class="text-black">Price <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="c_password1" name="price">
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-md-12">
                          <label for="c_email_address" class="text-black">Description <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="c_email_address" name="desc">
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-md-6">
                          <label for="c_password" class="text-black">Image <span class="text-danger">*</span></label>
                          <input type="file" class="form-control" id="c_password" name="image">
                        </div>
                      </div>

                      <label class="text-danger"><?php echo $show; ?></label>
                      <div class="form-group row">
                        <div class="col-md-6">
                          <button class="btn btn-primary btn-lg btn-block" type="submit" name="add_p">ADD PRODUCT</button>
                        </div>
                        <div class="col-md-6">
                          <button class="btn btn-primary btn-lg btn-block" onclick="close_p()" >CLOSE FORM</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
                </div>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th class="product-thumbnail">PRODUCT ID</th>
                      <th class="product-name">TYPE</th>
                      <th class="product-price">CATEGORY</th>
                      <th class="product-quantity">NAME</th>
                      <th class="product-total">DESCRIPTION</th>
                      <th class="product-total">PRICE</th>
                      <th class="product-total">IMAGE</th>
                      <th class="product-remove">Remove</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $sql_p = "SELECT * FROM product";
                      $result_p = mysqli_query($conn,$sql_p);
                      $len = mysqli_num_rows($result_p);
                      
                      if ($len > 0){
                        while($rows_p= mysqli_fetch_array($result_p)){
                    ?>
                    <tr>
                      <td class="product-thumbnail">
                        <?php echo $rows_p[0]; ?>
                      </td>
                      <td><?php echo $rows_p[1]; ?></td>
                      <td><?php echo $rows_p[2]; ?></td>
                      <td class="product-name">
                        <h2 class="h5 text-black"><?php echo $rows_p[3]; ?></h2>
                      </td>
                      <td><?php echo $rows_p[4]; ?></td>
                      <td><?php echo $rows_p[5]; ?></td>
                      <td><img src="<?php echo "images/product/".$rows_p[6]; ?>" style="height: 70%;width: 70%;" alt="Image" class="img-fluid"></td>
                      <td><form>
                        <input type="text" name="get_pid" style="display:none;" value="<?php echo $rows_p[0]; ?>">
                        <button type="submit" name="del_p" class="btn btn-primary height-auto btn-sm">X</button>
                      </form></td>
                    </tr>
                    <?php 
                        
                        }
                      }
                   ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12 mb-5">
            <div class="p-3 p-lg-5 border" id="od">
              <div class="form-group row">
                <div class="col-md-3">
                  <h2 class="h3 mb-3 text-black">ORDER DETAILS</h2>
                </div>
              </div>
              <div class="form-group">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th class="product-thumbnail">OREDR ID</th>
                      <th class="product-name">USER ID</th>
                      <th class="product-price">USER NAME</th>
                      <th class="product-quantity">PRODUCT ID</th>
                      <th class="product-total">PRODUCT NAME</th>
                      <th class="product-total">PRICE</th>
                      <th class="product-total">IMAGE</th>
                      <th class="product-price">STATUS</th>
                      <th class="product-quantity">PAYMENT MODE</th>
                      <th class="product-quantity">DATE & TIME</th>
                      <th class="product-remove">CANCEL ORDER</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $sql_o = "SELECT * FROM orders";
                      $result_o = mysqli_query($conn,$sql_o);
                      $len = mysqli_num_rows($result_o);
                      
                      if ($len > 0){
                        while($rows_o= mysqli_fetch_array($result_o)){

                          $nn = $rows_o[1];
                          $un = "SELECT * FROM user WHERE uid = '$nn' ";
                          $un1 = mysqli_query($conn,$un);
                          $un2 = mysqli_fetch_array($un1);

                          $xx = $rows_o[2];
                          $xy = "SELECT * FROM product WHERE pid = '$xx' ";
                          $yz = mysqli_query($conn,$xy);
                          $zz = mysqli_fetch_array($yz);

                    ?>
                    <tr>
                      <td class="product-thumbnail">
                        <?php echo $rows_o[0]; ?>
                      </td>
                      <td><?php echo $rows_o[1]; ?></td>
                      <td><?php echo $un2[1]; ?></td>
                      <td><?php echo $rows_o[2]; ?></td>
                      <td><?php echo $zz[3]; ?></td>
                      <td><?php echo $rows_o[3]; ?></td>
                      <td><img src="<?php echo "images/product/".$zz[6]; ?>" style="height: 70%;width: 70%;" alt="Image" class="img-fluid"></td>
                      <td><?php echo $rows_o[4]; ?></td>
                      <td><?php echo $rows_o[5]; ?></td>
                      <td><?php echo $rows_o[6]; ?></td>
                      <td><form>
                        <input type="text" name="get_oid" style="display:none;" value="<?php echo $rows_o[0]; ?>">
                        <button type="submit" name="del_o" class="btn btn-primary height-auto btn-sm">X</button>
                      </form></td>
                    </tr>
                    <?php 
                        
                        }
                      }
                   ?>
                  </tbody>
                </table>
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