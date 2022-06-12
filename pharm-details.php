<?php

include_once './config/connect.php';
session_start();
if (!isset($_SESSION['id'])) {
    header('location: page-login.php');
}

if (!isset($_GET['id'])) {
    header("location:./view-medicine.php");
}

$id = mysqli_real_escape_string($con, $_GET['id']);

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
                            $sql = "SELECT company, email, phone, location_name, count(name) as total
                                    FROM medicines, users, location 
                                    WHERE medicines.user_id = users.id
                                    AND users.location_id = location.id
                                    AND users.id = $id";
                            $result = mysqli_query($con, $sql);
                            $row = mysqli_fetch_object($result);
                            ?>
                            <div class="card-header">
                                <h3 class="h5 text-center"><?php echo $row->company; ?></h3>
                                <hr>
                                <div class="row">
                                    <div class="col-6">
                                        <span><strong>Email:</strong></span>
                                    </div>
                                    <div class="col-6">
                                        <span><?php echo $row->email; ?></span>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-6">
                                        <span><strong>Location:</strong></span>
                                    </div>
                                    <div class="col-6">
                                        <span><?php echo $row->location_name; ?></span>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-6">
                                        <span><strong>Phone number:</strong></span>
                                    </div>
                                    <div class="col-6">
                                        <span><?php echo $row->phone; ?></span>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-6">
                                        <span><strong>Medicine shared:</strong></span>
                                    </div>
                                    <div class="col-6">
                                        <span><?php echo $row->total; ?></span>
                                    </div>
                                </div>
                                <hr>
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