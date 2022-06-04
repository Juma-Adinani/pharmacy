<?php
include_once './config/connect.php';
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

<body class="d-flex flex-column justify-content-around align-items-center">
  <div>
    <div class="loader"></div>
  </div>
  <div class="">
    <h1 class="display-4 text-light">PharmDonner</h1>
    <p class="lead">Smart and Easiest way to share human medicine</p>
  </div>
  <?php
  header('Refresh:1.5, url=page-login.php');
  ?>
</body>
<style>
  body {
    overflow-y: hidden;
    min-height: 90vh;
  }

  .loader {
    border: 10px solid #f3f3f3;
    border-top: 10px solid #d6d6d6d6;
    border-bottom: 10px solid #d6d6d6d6;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    animation: spin 2s linear infinite;
  }

  @keyframes spin {
    0% {
      transform: rotate(0deg);
    }

    100% {
      transform: rotate(360deg);
    }
  }
</style>

</html>