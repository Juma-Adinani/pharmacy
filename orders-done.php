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
                            <li><a href="./orders-made.php">Orders made to me</a></li>
                            <li><a href="./orders-done.php">Orders made by me</a></li>
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
                                                <th>Ordered to</th>
                                                <th>Location</th>
                                                <th>Phone number</th>
                                                <th>Quantity</th>
                                                <th>Total Price (TZS(K))</th>
                                                <th>Order date</th>
                                                <th class="text-center">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php
                                                $sql = $con->query("SELECT name, company, location, phoneNumber, ordered_quantity, paid_date
                                                 FROM orders, medicines, users 
                                                 WHERE orders.medicine_id = medicines.id
                                                 AND medicines.user_id = users.id
                                                 AND orders.user_id = '" . $_SESSION['id'] . "'");

                                                if (mysqli_num_rows($sql) > 0) {
                                                    $sn = 0;
                                                    while ($row = mysqli_fetch_object($sql)) {
                                                        $sn++;
                                                ?>
                                                        <td><?php echo $sn; ?></td>
                                                        <td><?php echo $row->name; ?></td>
                                                        <td><?php echo $row->company; ?></td>
                                                        <td><?php echo $row->location; ?></td>
                                                        <td><?php echo $row->phoneNumber; ?></td>
                                                        <td><?php echo $row->ordered_quantity; ?></td>
                                                        <td>100</td>
                                                        <td><?php echo $row->paid_date; ?></td>
                                                        <td>YET...</td>
                                            </tr>
                                    <?php
                                                    }
                                                } else {
                                                    echo '<tr><td colspan="9">No orders i made yet</td></tr>';
                                                }

                                    ?>
                                        </tbody>
                                        <tfoot>
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
                                        </tfoot>
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