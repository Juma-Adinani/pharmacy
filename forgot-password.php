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
if (isset($_POST['submit'])) {
    $phoneNumber = '255' . substr($_POST['phone'], 1);
    $sql = $con->query("SELECT phone FROM users WHERE phone = '" . $phoneNumber . "'");

    if (mysqli_num_rows($sql) == 1) {

        $phoneNumber = mysqli_fetch_object($sql)->phone;
        $code = rand(1111, 5555);

        $api_key = '7617b4296f066d58';
        $secret_key = 'Nzc1MzA5ZTE2MjM2YTA4MzZiZjhiYWUzM2E5MTkwOGRlMmNmYjY1ZmNiYTQxN2FhZDljNTgxNDVhYzc3MWIyNQ==';

        $postData = array(
            'source_addr' => 'INFO',
            'encoding' => 0,
            'schedule_time' => '',
            'message' => 'From PhamrDoner.co.tz' . "\n" . 'Use this code ' . $code . ' to reset your password',
            'recipients' => [array('recipient_id' => '1', 'dest_addr' => $phoneNumber)]
        );

        $Url = 'https://apisms.beem.africa/v1/send';

        $ch = curl_init($Url);
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt_array($ch, array(
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array(
                'Authorization:Basic ' . base64_encode("$api_key:$secret_key"),
                'Content-Type: application/json'
            ),
            CURLOPT_POSTFIELDS => json_encode($postData)
        ));

        $response = curl_exec($ch);

        if ($response === FALSE) {
            echo $response;

            die(curl_error($ch));
        }
        // var_dump($response);

        $sql = $con->query("INSERT INTO password_reset(phone, code) VALUES ('$phoneNumber', '$code')");

        $message .= "<div class='alert alert-success fw-bold'>A password reset code has been sent to " . $phoneNumber . "\n <a href='./change-password.php' class='fw-bolder'>Click here</a> to proceed</div>";
    } else {
        $message .= "<div class='alert alert-danger'>Phone number doesnot exist, Try again</div>";
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
                            <?= $message; ?>
                            <div class="card-body pt-5">
                                <a class="text-center" href="index.php">
                                    <h4 class="text-info">PharmaDonner</h4>
                                </a>
                                <form class="mt-5 mb-5 login-input" action="" method="post">
                                    <div class="form-group">
                                        <input required type="text" class="form-control" name="phone" placeholder="Enter phone number" />
                                    </div>
                                    <button type="submit" name="submit" class="btn login-form__btn submit w-100">
                                        Submit
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