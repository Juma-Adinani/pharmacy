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
            <div class="input-group-prepend">
              <span class="input-group-text bg-transparent border-0 pr-2 pr-sm-3" id="basic-addon1"><i class="mdi mdi-magnify"></i></span>
            </div>
            <input type="search" class="form-control" placeholder="Search Dashboard" aria-label="Search Dashboard" />
            <div class="drop-down d-md-none">
              <form action="#">
                <input type="text" class="form-control" placeholder="Search" />
              </form>
            </div>
          </div>
        </div>
        <div class="header-right">
          <ul class="clearfix">
            <!-- <li class="icons dropdown">
              <a href="javascript:void(0)" data-toggle="dropdown">
                <i class="mdi mdi-email-outline"></i>
                <span class="badge gradient-1 badge-pill badge-primary">3</span>
              </a>
              <div class="drop-down animated fadeIn dropdown-menu">
                <div class="dropdown-content-heading d-flex justify-content-between">
                  <span class="">3 New Messages</span>
                </div>
                <div class="dropdown-content-body">
                  <ul>
                    <li class="notification-unread">
                      <a href="javascript:void()">
                        <img class="float-left mr-3 avatar-img" src="images/avatar/1.jpg" alt="" />
                        <div class="notification-content">
                          <div class="notification-heading">Saiful Islam Pharmacy Limited</div>
                          <div class="notification-timestamp">
                            01 Hour ago
                          </div>
                          <div class="notification-text">
                            Can we excahnge panadol for ezymotylcorticotrophin?..
                          </div>
                        </div>
                      </a>
                    </li>
                    <li class="notification-unread">
                      <a href="javascript:void()">
                        <img class="float-left mr-3 avatar-img" src="images/avatar/2.jpg" alt="" />
                        <div class="notification-content">
                          <div class="notification-heading">Shibayi Pharmacy Company</div>
                          <div class="notification-timestamp">
                            08 Hours ago
                          </div>
                          <div class="notification-text">
                            Can you do me a favour for 3boxes of aspirin?
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a href="javascript:void()">
                        <img class="float-left mr-3 avatar-img" src="images/avatar/3.jpg" alt="" />
                        <div class="notification-content">
                          <div class="notification-heading">Mlugaluga Pharmacy</div>
                          <div class="notification-timestamp">
                            08 Hours ago
                          </div>
                          <div class="notification-text">
                            Hi Jay, can you send me ...
                          </div>
                        </div>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </li>
            <li class="icons dropdown">
              <a href="javascript:void(0)" data-toggle="dropdown">
                <i class="mdi mdi-bell-outline"></i>
                <span class="badge badge-pill gradient-2 badge-primary">2</span>
              </a>
              <div class="drop-down animated fadeIn dropdown-menu dropdown-notfication">
                <div class="dropdown-content-heading d-flex justify-content-between">
                  <span class="">2 New Notifications</span>
                </div>
                <div class="dropdown-content-body">
                  <ul>
                    <li>
                      <a href="javascript:void()">
                        <span class="mr-3 avatar-icon bg-success-lighten-2"><i class="icon-present"></i></span>
                        <div class="notification-content">
                          <h6 class="notification-heading">
                            New medicine shared
                          </h6>
                          <span class="notification-text">5 hours ago</span>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a href="javascript:void()">
                        <span class="mr-3 avatar-icon bg-danger-lighten-2"><i class="icon-present"></i></span>
                        <div class="notification-content">
                          <h6 class="notification-heading">New order made</h6>
                          <span class="notification-text">1 day ago</span>
                        </div>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </li>
            <li class="icons dropdown d-none d-md-flex">
              <a href="javascript:void(0)" class="log-user" data-toggle="dropdown">
                <span>English</span>
                <i class="fa fa-angle-down f-s-14" aria-hidden="true"></i>
              </a>
              <div class="drop-down dropdown-language animated fadeIn dropdown-menu">
                <div class="dropdown-content-body">
                  <ul>
                    <li><a href="javascript:void()">English</a></li>
                    <li><a href="javascript:void()">Swahili</a></li>
                  </ul>
                </div>
              </div>
            </li> -->
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
                    <li>
                      <a href="#"><i class="icon-envelope-open"></i> <span>Inbox</span>
                        <div class="badge gradient-3 badge-pill badge-primary">
                          3
                        </div>
                      </a>
                    </li>

                    <hr class="my-2" />
                    <li>
                      <a href="#"><i class="icon-lock"></i> <span>Lock Screen</span></a>
                    </li>
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

          <!-- <li class="nav-label">Pages</li> -->
          <li>
            <a class="has-arrow" href="javascript:void()" aria-expanded="false">
              <i class="icon-notebook menu-icon"></i><span class="nav-text">Pages</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="./view-medicine.php">Available Medicines</a></li>
              <li><a href="./post-medicine.php">Post Medicine</a></li>
              <li><a href="./orders-made.php">Orders</a></li>
              <li><a href="./my-posts.php">Posts</a></li>
              <!-- <li><a href="./page-register.php">Register</a></li> -->
              <li><a href="./logout.php">Logout</a></li>
            </ul>
          </li>
          <!-- <li class="nav-label">Apps</li> -->
          <li>
            <a class="has-arrow" href="javascript:void()" aria-expanded="false">
              <i class="icon-bell menu-icon"></i>
              <span class="nav-text">Notifications</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="#">Inbox</a></li>
              <li><a href="#">Read</a></li>
              <li><a href="#">Compose</a></li>
            </ul>
          </li>
          <!-- <li>
            <a class="has-arrow" href="javascript:void()" aria-expanded="false">
              <i class="icon-settings menu-icon"></i><span class="nav-text">Settings</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="#">Profile</a></li>
              <li><a href="#">Date & Time</a></li>
              <li><a href="#">Appearence</a></li>
            </ul>
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
            <li class="breadcrumb-item">
              <a href="javascript:void(0)">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">
              <a href="javascript:void(0)">Medicines</a>
            </li>
          </ol>
        </div>
      </div>
      <!-- row -->

      <div class="container-fluid">
        <div class="row">
          <div class="col-12 m-b-30">
            <h4 class="d-inline text-light">Available Medicines</h4>
            <div class="container mt-4">
              <div class="row">
                <?php

                $sql = "SELECT medicines.id as id, location, name,photo, quantity, price, unit, company, post_date
                                        FROM medicines, users 
                                        WHERE medicines.user_id = users.id 
                                        AND quantity != 0 
                                        AND users.id != '" . $_SESSION['id'] . "'
                                        ORDER BY post_date Desc";
                $result = mysqli_query($con, $sql);

                if (!mysqli_error($con)) {

                  if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {

                ?>
                      <div class="col-6">
                        <div class="card border-primary">
                          <div class="card-header"><?php echo $row['location']; ?></div>
                          <img src="./images/uploads/<?php echo $row['photo']; ?>" alt="" width="100%" height="220">
                          <div class="card-body">
                            <h5 class="card-title"><?php echo $row['name'] ?></h5>
                            <p class="card-text">
                              Quantity: <?php echo $row['quantity'] ?>&nbsp;<?php echo $row['unit']; ?><br />
                              Price: <?php echo $row['price']; ?> TZS/<?php echo $row['unit']; ?>
                            </p>
                            <a href="./order/index.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-info">Order now</a>
                          </div>
                          <div class="card-footer">
                            <small><?php echo $row['company']; ?></small><br />
                            <small>Posted:&nbsp;<?php echo $row['post_date']; ?></small>
                          </div>
                        </div>
                      </div>
                <?php
                    }
                  } else {
                    echo '<div class="container text-muted lead text-center">No available medicines yet..!</div>';
                  }
                } else {
                  echo 'There is an error => ' . mysqli_error($con);
                }

                ?>
              </div>
            </div>
            <!-- End Col -->
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