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
  <meta Medicine name="viewport" content="width=device-width,initial-scale=1" />
  <title>PharmaDonner | Smart and Easiest way to share human medicine.</title>
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png" />
  <!-- Custom Stylesheet -->
  <link href="./plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />
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
                <input type="text" class="form-control" placeholder="Search" />
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

          <!-- <li class="nav-label">Pages</li> -->
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
              <a href="javascript:void(0)">Orders</a>
            </li>
          </ol>
        </div>
      </div>
      <!-- row -->

      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title text-light">Orders Made</h4>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered zero-configuration">
                    <thead>
                      <tr>
                        <th>Sn</th>
                        <th>Medicine name</th>
                        <th>Ordered by</th>
                        <th>Location</th>
                        <th>Phone number</th>
                        <th>Quantity</th>
                        <th>Total Price (TZS(K))</th>
                        <th>Order date</th>
                        <th class="text-center">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $sql = "SELECT name, company, location_name, users.phone as phone, ordered_quantity, amount, paid_date
                              FROM orders, medicines, users, location
                              WHERE orders.medicine_id = medicines.id
                              AND users.location_id = location.id
                              AND orders.user_id = users.id
                              AND medicines.user_id = '" . $_SESSION['id'] . "'";
                      $result = mysqli_query($con, $sql);

                      if (!mysqli_error($con)) {
                        if (mysqli_num_rows($result) > 0) {
                          $Sn = 0;
                          while ($row = mysqli_fetch_assoc($result)) {
                            $Sn++;
                      ?>
                            <tr>
                              <td><?php echo $Sn; ?></td>
                              <td><?php echo $row['name']; ?></td>
                              <td><?php echo $row['company']; ?></td>
                              <td><?php echo $row['location']; ?></td>
                              <td><?php echo $row['phone']; ?></td>
                              <td><?php echo $row['ordered_quantity']; ?></td>
                              <td><?php echo $row['amount']; ?></td>
                              <td><?php echo $row['paid_date']; ?></td>
                              <td class="text-center">
                                <span><a href="#" data-toggle="tooltip" data-placement="top" title="Not Shared"><i class="fa fa-ban color-muted m-r-5 text-info"></i> </a><a href="#" data-toggle="tooltip" data-placement="top" title="Shared"><i class="fa fa-check text-success"></i></a></span>
                              </td>
                            </tr>
                      <?php
                          }
                        } else {
                          echo '<tr><td colspan="9" class="alert alert-info">Orders are not yet made!</td></tr>';
                        }
                      } else {
                        echo '<div class="alert alert-danger">There is an error => ' . mysqli_error($con) . '</div>';
                      }
                      ?>
                    </tbody>
                    <!-- <tfoot>
                      <tr>
                        <th>Sn</th>
                        <th>Medicine name</th>
                        <th>Ordered by</th>
                        <th>Location</th>
                        <th>Phone number</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Order date</th>
                        <th class="text-center">Status</th>
                      </tr>
                    </tfoot> -->
                  </table>
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

  <script src="./plugins/tables/js/jquery.dataTables.min.js"></script>
  <script src="./plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
  <script src="./plugins/tables/js/datatable-init/datatable-basic.min.js"></script>
</body>

</html>