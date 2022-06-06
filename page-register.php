<?php
include_once './config/connect.php';
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
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous" />
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
                if (isset($_POST['register'])) {

                  $firstname = mysqli_real_escape_string($con, $_POST['firstname']);
                  $surname = mysqli_real_escape_string($con, $_POST['surname']);
                  $company = mysqli_real_escape_string($con, $_POST['company']);
                  $location = mysqli_real_escape_string($con, $_POST['location']);
                  $phone = mysqli_real_escape_string($con, $_POST['phone']);
                  $password = mysqli_real_escape_string($con, $_POST['password']);
                  $email = mysqli_real_escape_string($con, $_POST['email']);

                  $sql = "INSERT INTO users (firstname, surname, company, email, phone, location, role_id, password)
                        VALUES ('$firstname', '$surname', '$company', '$email', '$phone', '$location', 2, '$password')";
                  $result = mysqli_query($con, $sql);

                  if (!mysqli_error($con)) {
                    echo '<div class="alert alert-success text-center text-dark">Registered successfully</div>';
                    header("Refresh:3; url=page-login.php");
                  } else {
                    echo 'There is an error => ' . mysqli_error($con);
                  }
                }
                ?>
                <a class="text-center" href="index.php">
                  <h4 class="text-info">PharmaDonner</h4>
                </a>
                <form class="mt-5 mb-5 login-input" method="POST" action="">
                  <div class="form-group row">
                    <div class="col-6">
                      <input required type="text" class="form-control" name="firstname" placeholder="firstname" />
                    </div>

                    <div class="col-6">
                      <input required type="text" class="form-control" name="surname" placeholder="surname" />
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-6">
                      <input required type="email" class="form-control" name="email" placeholder="email" />
                    </div>

                    <div class="col-6">
                      <input required type="number" class="form-control" name="phone" placeholder="phone number" />
                    </div>
                  </div>
                  <div class="form-group">
                    <input required type="text" class="form-control" name="company" placeholder="pharmacy name" />
                  </div>
                  <div class="form-group row">
                    <div class="col-6">
                      <input required type="text" class="form-control" name="location" placeholder="Location" />
                    </div>
                    <div class="col-6">
                      <input required type="password" class="form-control" name="password" placeholder="Password" />
                    </div>
                  </div>
                  <button type="submit" name="register" class="btn login-form__btn submit w-100">
                    Sign up
                  </button>

                </form>
                <p class="mt-5 login-form__footer">
                  Have account
                  <a href="page-login.php" class="text-primary">Sign in </a>
                </p>
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