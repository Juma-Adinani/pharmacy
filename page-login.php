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

                <?php
                if (isset($_POST['login'])) {
                  $email = mysqli_real_escape_string($con, $_POST['email']);
                  $password = mysqli_real_escape_string($con, $_POST['password']);
                  // $hash = sha1($password);

                  $sql = $con->query("SELECT users.id as id, company, name
                                      FROM users, roles
                                      WHERE users.role_id = roles.id
                                      AND email = '" . $email . "' 
                                      AND password = '" . $password . "'");

                  if (!mysqli_error($con)) {
                    if (mysqli_num_rows($sql) == 1) {

                      $row = mysqli_fetch_assoc($sql);
                      $_SESSION['company'] = $row['company'];
                      $_SESSION['role'] = $row['name'];
                      $_SESSION['id'] = $row['id'];
                      echo '<div class="alert alert-success text-center text-dark">Login successfully</div>';
                      header("Refresh:3; url=view-medicine.php");
                    } else {
                      echo '<div class="alert alert-danger text-center text-dark">Invalid credentials, Try Again</div>';
                    }
                  } else {
                    echo '<div class="alert alert-danger text-center text-dark">There is an error in database query</div>';
                  }
                }
                ?>
                <a class="text-center" href="index.php">
                  <h4 class="text-info">PharmaDonner</h4>
                </a>

                <form class="mt-5 mb-5 login-input" action="" method="post">
                  <div class="form-group">
                    <input required type="email" class="form-control" name="email" placeholder="Email" />
                  </div>
                  <div class="form-group">
                    <input required type="password" class="form-control" name="password" placeholder="Password" />
                  </div>
                  <button type="submit" name="login" class="btn login-form__btn submit w-100">
                    Sign In
                  </button>
                  <p class="mt-5 login-form__footer">
                    Forgot password?
                    <a href="forgot-password.php" class="text-primary">Click here</a>
                  </p>
                  <p class="mt-1 login-form__footer">
                    Dont have account?
                    <a href="page-register.php" class="text-primary">Sign Up</a>
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