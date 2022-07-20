<?php

include_once './config/connect.php';
session_start();
if (isset($_SESSION['id'])) {
    header('location: view-medicine.php');
}

?>
<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>PharmaDonner | Smart and Easiest way to share human medicine.</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png" />
    <link href="css/style.css" rel="stylesheet" />
</head>
<?php
$message = "";
if (isset($_POST['reset'])) {
    $code = mysqli_real_escape_string($con, $_POST['code']);
    $pass1 = mysqli_real_escape_string($con, $_POST['pass1']);
    $pass2 = mysqli_real_escape_string($con, $_POST['pass2']);
    // $hash = sha1($password);

    $sql = $con->query("SELECT phone FROM password_reset WHERE code = '" . $code . "'");
    if (mysqli_num_rows($sql) == 1) {
        if ($pass1 == $pass2) {
            $phoneNumber = mysqli_fetch_assoc($sql)['phone'];
            $sql = $con->query("UPDATE users SET password = '$pass2' WHERE phone = '" . $phoneNumber . "'");
            if (!mysqli_error($con)) {
                $sql = $con->query("DELETE FROM password_reset WHERE code = '" . $code . "'");
                $message .= "<div class='alert alert-success'>Password reseted successfully</div>";
                header("Refresh:2;url=./page-login.php");
            }
        } else {
            $message .= '<div class="alert alert-danger">Password donot match</div>';
        }
    } else {
        $message .= '<div class="alert alert-danger">Invalid reset code</div>';
    }
}
?>

<body class="h-100">
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

    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                <?= $message; ?>
                                <a class="text-center" href="index.php">
                                    <h4 class="text-info">PharmaDonner</h4>
                                </a>

                                <form class="mt-5 mb-5 login-input" action="" method="post">
                                    <div class="form-group">
                                        <input required type="text" class="form-control" name="code" placeholder="Code number" />
                                    </div>
                                    <div class="form-group">
                                        <input required type="password" class="form-control" name="pass1" placeholder="New password" pattern=".{8,}" title="required 8 minimum characters"/>
                                    </div>
                                    <div class="form-group">
                                        <input required type="password" class="form-control" name="pass2" placeholder="Confirm password" />
                                    </div>
                                    <button type="submit" name="reset" class="btn login-form__btn submit w-100">
                                        Reset Password
                                    </button>
                                    <p class="mt-5 login-form__footer">
                                        have account?
                                        <a href="page-login.php" class="text-primary">Sign In</a>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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