<?php

include_once './config/connect.php';
session_start();
if (!isset($_SESSION['id'])) {
  header('location: page-login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>PharmaDonner | Smart and Easiest way to share human medicine.</title>
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png" />
  <!-- Custom Stylesheet -->
  <link href="css/style.css" rel="stylesheet" />
</head>

<body>
  <!--*******************
        Preloader start
    ********************-->
  <div id="preloader">
    <div class="loader">
      <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
      </svg>
    </div>
  </div>
  <!--*******************
        Preloader end
    ********************-->

  <!--**********************************
        Main wrapper start
    ***********************************-->
  <div id="main-wrapper">
    <!--**********************************
            Nav header start
        ***********************************-->
    <div class="nav-header">
      <div class="brand-logo">
        <a href="index.php">
          <b class="logo-abbr"><img src="images/logo.png" alt="" /> </b>
          <span class="logo-compact"><img src="./images/logo-compact.png" alt="" /></span>
          <span class="brand-title">
            <img src="images/logo-text.png" alt="" />
          </span>
        </a>
      </div>
    </div>
    <!--**********************************
            Nav header end
        ***********************************-->

    <!--**********************************
            Header start
        ***********************************-->
    <div class="header">
      <div class="header-content clearfix">
        <div class="nav-control">
          <div class="hamburger">
            <span class="toggle-icon"><i class="icon-menu"></i></span>
          </div>
        </div>
        <div class="header-left">
          <div class="input-group icons">
            <div class="drop-down d-md-none">
              <form action="#">
                <input required type="text" class="form-control" placeholder="Search" />
              </form>
            </div>
          </div>
        </div>
        <div class="header-right">
          <ul class="clearfix">
            <li class="icons dropdown">
              <div class="user-img c-pointer position-relative" data-toggle="dropdown">
                <span class="activity active"></span>
                <img src="images/user/1.png" height="40" width="40" alt="" />
              </div>
              <div class="drop-down dropdown-profile dropdown-menu">
                <div class="dropdown-content-body">
                  <ul>
                    <li>
                      <a href="#"><i class="icon-user"></i> <span>Profile</span></a>
                    </li>
                    <!-- <li>
                      <a href="#"><i class="icon-envelope-open"></i> <span>Inbox</span>
                        <div class="badge gradient-3 badge-pill badge-primary">
                          3
                        </div>
                      </a>
                    </li> -->
                    <hr class="my-2" />
                    <li>
                      <a href="logout.php"><i class="icon-key"></i> <span>Logout</span></a>
                    </li>
                  </ul>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

    <!--**********************************
            Sidebar start
        ***********************************-->
    <div class="nk-sidebar">
      <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">
          <li class="nav-label">Dashboard</li>
          <li>
            <a class="has-arrow" href="javascript:void()" aria-expanded="false">
              <i class="icon-home menu-icon"></i><span class="nav-text">Home</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="./index.php">HomePage</a></li>
            </ul>
          </li>
          <li>
            <a class="has-arrow" href="javascript:void()" aria-expanded="false">
              <i class="icon-notebook menu-icon"></i><span class="nav-text">Pages</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="./view-medicine.php">Available Medicines</a></li>
              <?php
              if ($_SESSION['role'] != 'admin') {
              ?>
                <li><a href="./post-medicine.php">Post Medicine</a></li>
                <li><a href="./orders-made.php">Orders made to me</a></li>
                <li><a href="./orders-done.php">Orders made by me</a></li>
                <li><a href="./my-posts.php">Posts</a></li>
              <?php
              }
              ?>
              <li><a href="./logout.php">Logout</a></li>
            </ul>
          </li>
          <!-- <li>
            <a class="nav-link" href="">
              <i class="icon-bell menu-icon"><sup class="text-danger h6">3</sup> </i>
              <span class="nav-text">Notifications</span>
            </a>
          </li> -->
        </ul>
      </div>
    </div>
    <!--**********************************
            Sidebar end
        ***********************************-->

    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body">

      <div class="row page-titles mx-0">
        <div class="col p-md-0">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Posts</a></li>
          </ol>
        </div>
      </div>
      <!-- row -->

      <div class="container-fluid">
        <div class="row d-flex justify-content-center">
          <div class="col-lg-8">

            <div class="card">

              <?php
              if (isset($_FILES['photo'])) {
                $path = "./images/uploads/";
                $filename = basename($_FILES['photo']['name']);
                $filepath = $path . $filename;
                $filetype = pathinfo($filepath, PATHINFO_EXTENSION);
                $medicine = mysqli_real_escape_string($con, $_POST['name']);
                $quantity = mysqli_real_escape_string($con, $_POST['quantity']);
                $price = mysqli_real_escape_string($con, $_POST['price']);
                $unit = mysqli_real_escape_string($con, $_POST['unit']);
                $user = $_SESSION['id'];

                if (isset($_POST['post'])) {
                  //checking the format of a file
                  $format = array('jpg', 'jpeg', 'png');
                  if (in_array($filetype, $format)) {

                    $tmpname = $_FILES['photo']['tmp_name'];

                    //inserting data into a database
                    if (move_uploaded_file($tmpname, $filepath)) {

                      $sql = "INSERT INTO medicines(name, quantity, unit_id, price, photo, user_id) 
                        VALUES ('$medicine', '$quantity', '$unit', '$price', '$filename', '$user')";
                      $result = mysqli_query($con, $sql);

                      if (!mysqli_error($con)) {
                        echo '<div class="alert alert-success text-center text-dark">Posted successfully</div>';
                        // header("Refresh:3;");

                      } else {
                        echo '<div class="alert alert-danger text-center text-dark">There is an error</div>' . mysqli_error($con);
                      }
                    } else {
                      echo '<center class="alert alert-danger">Error Occured on Posting..!</center>';
                    }
                  } else {
                    echo '<center class="alert alert-danger">Make Sure You post photo (jpg, png, jpeg) formats..!</center>';
                  }
                } else {
                  echo "<div class='alert alert-warning'><strong>Select a file to upload!</strong></div>";
                }
              }
              ?>
              <div class="card-body">
                <h4 class="card-title text-light">Post Medicine</h4>
                <div class="basic-form mt-4">
                  <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                      <input required type="text" class="form-control input-default" name="name" placeholder="Enter medicine name">
                    </div>
                    <div class="form-group">
                      <input required type="number" class="form-control input-default" name="quantity" placeholder="Enter Quantity">
                    </div>
                    <div class="form-group">
                      <select name="unit" id="" class="form-control input-default" required>
                        <option value="">choose unit...</option>
                        <?php
                        $sql = $con->query("SELECT * FROM units");
                        while ($row = mysqli_fetch_object($sql)) {
                        ?>
                          <option value="<?php echo $row->id; ?>"><?php echo $row->unit; ?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <input required type="number" class="form-control input-default" name="price" placeholder="Enter Price">
                    </div>
                    <div class="form-group">
                      <input required type="file" class="form-control input-default" name="photo">
                    </div>
                    <div class="form-group text-right">
                      <button type="submit" class="btn btn-primary" name="post">Share</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
      <!-- #/ container -->
    </div>
    <!--**********************************
            Content body end
        ***********************************-->


    <!--**********************************
            Footer start
        ***********************************-->
    <div class="footer">
      <div class="copyright">
        <p>
          Copyright &copy;
          <a href="#">PharmaDonner.com,</a>
          2022
        </p>
      </div>
    </div>
    <!--**********************************
            Footer end
        ***********************************-->
  </div>
  <!--**********************************
        Main wrapper end
    ***********************************-->

  <!--**********************************
        Scripts
    ***********************************-->
  <script src="plugins/common/common.min.js"></script>
  <script src="js/custom.min.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/gleek.js"></script>
  <script src="js/styleSwitcher.js"></script>

</body>

</html>