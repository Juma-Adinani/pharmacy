<?php
include_once '../config/connect.php';
session_start();

if (!isset($_GET['id'])) {
  header('location:../view-medicine.php');
}
$id = mysqli_real_escape_string($con, $_GET['id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta Medicine name="viewport" content="width=device-width,initial-scale=1" />
  <title>PharmaDonner | Smart and Easiest way to share human medicine.</title>
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon.png" />
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" />
  <link href="" rel="stylesheet" />
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script type=" text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
  </script>
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Rubik:wght@500&display=swap");
  </style>
  <link rel="stylesheet" href="./style.css">
  <link rel="stylesheet" href="../dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../dist/css/form-validation.css">
</head>

<body oncontextmenu="return false" class="snippet-body">
  <div class="container d-flex justify-content-center">
    <div class="card mt-5 px-3 py-4 w-50 shadow">
      <div class="text-secondary">
        <?php
        $sql = " SELECT name, quantity, price, company, location_name, phone FROM medicines, users, location 
                WHERE medicines.id = $id
                AND medicines.user_id = users.id
                AND users.location_id = location.id";
        $run = mysqli_query($con, $sql);
        $row = mysqli_fetch_object($run);

        echo '<div class="col-sm-12 d-flex justify-content-between">
          <span><strong>Medicine:</strong></span><span>' . $row->name . '</span>
        </div>
        <div class="col-sm-12 d-flex justify-content-between">
          <span><strong>Available Quantity:</strong></span><span>' . $row->quantity . '</span>
        </div>';
        ?>
      </div>
      <hr>
      <?php
      $sql = "SELECT pin, phone, balance, company, location_name FROM mpesa, users, location
              WHERE mpesa.user_id = users.id
              AND users.location_id = location.id
              AND user_id = '" . $_SESSION['id'] . "'";
      $result = mysqli_query($con, $sql);
      $mpesa = mysqli_fetch_object($result);
      // die(json_encode($mpesa));

      if (isset($_POST['submit'])) {
        $quantity = mysqli_real_escape_string($con, $_POST['quantity']);

        if ($quantity <= 0) {
          echo '<div class="alert alert-danger">Invalid quantity</div>';
        } else {
          if ($quantity > $row->quantity) {
            echo '<div class="alert alert-danger">Quantity to be ordered exceeds available quantity</div>';
          } else {
            $totalPrice = $quantity * $row->price;
            $_SESSION['amount'] =  $totalPrice;
            $_SESSION['q'] = $quantity;
          }
        }
      }
      if (isset($_POST['order'])) {
        $pin = mysqli_real_escape_string($con, $_POST['pin']);

        if ($pin == $mpesa->pin) {
          if ($_SESSION['amount'] > $mpesa->balance) {
            echo '<div class="alert alert-danger">Amount exceeds balance</div>';
          } else {
            //reduce money from mpesa balance
            $remained = $mpesa->balance - $_SESSION['amount'];
            $mpesaQuery = $con->query("UPDATE mpesa SET balance = $remained WHERE user_id = '" . $_SESSION['id'] . "'");
            //reduce available quantity
            $quantityRemained =  $row->quantity - $_SESSION['q'];
            $medicalQuery = $con->query("UPDATE medicines SET quantity = $quantityRemained WHERE id = $id");
            //insert into orders
            $insertQuery = $con->query("INSERT INTO orders (medicine_id, ordered_quantity, amount, phoneNumber, user_id) 
                                        VALUES ('$id', '" . $_SESSION['q'] . "', '" . $_SESSION['amount'] . "', '" . $mpesa->phone . "', '" . $_SESSION['id'] . "')");
            if (!mysqli_error($con)) {

              //send sms to customer

              $api_key = '7617b4296f066d58';
              $secret_key = 'Nzc1MzA5ZTE2MjM2YTA4MzZiZjhiYWUzM2E5MTkwOGRlMmNmYjY1ZmNiYTQxN2FhZDljNTgxNDVhYzc3MWIyNQ==';

              $postData = array(
                'source_addr' => 'INFO',
                'encoding' => 0,
                'schedule_time' => '',
                'message' => 'Confirmed at ' . date("d/M/Y, H:i:s") . 'Order made successfully, ' . $_SESSION['q'] . ' quantity of ' . $row->name . ' for total ' . $_SESSION['amount'] . 'Tsh
from ' . $row->company . ' located at ' . $row->location_name . ' to ' . $mpesa->company . ' located at ' . $mpesa->location_name,
                'recipients' => [array('recipient_id' => '1', 'dest_addr' => $mpesa->phone), array('recipient_id' => '2', 'dest_addr' => $row->phone)]
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
              echo '<div class="alert alert-success text-center"><strong>...Order made successfully...</strong></div>';

              unset($_SESSION['amount']);
              unset($_SESSION['q']);
              //end send sms to customer

              header("Refresh:3;url=../view-medicine.php");
            } else {
              echo '<div class="alert alert-danger">There is an error</div>' . mysqli_error($con);
            }
          }
        } else {
          echo '<div class="alert alert-danger">Invalid PIN, Try again</div>';
        }
      }
      ?>
      <div class="d-flex flex-row justify-content-around">
        <div class="mpesa"><span>Mpesa </span></div>
        <div><span>Paypal</span></div>
        <div><span>Card</span></div>
      </div>
      <div class="media mt-4 pl-2 d-flex justify-content-center">
        <img src="./images/1200px-M-PESA_LOGO-01.svg.png" class="" height="100" />
      </div>
      <div class="media mt-3 pl-2">
        <!--bs5 input-->
        <form class="row g-3" action="" method="POST">
          <div class="form-group row">
            <div class="col-6">
              <?php
              if (isset($_SESSION['q'])) {
              ?>
                <label for="">Quantity</label>
                <input type="number" required class="form-control" name="quantity" value="<?php echo $_SESSION['q']; ?>">
              <?php
              } else {
                unset($_SESSION['q']);
              ?>
                <label for="">Quantity</label>
                <input type="number" required class="form-control" name="quantity" placeholder="Enter quantity">
              <?php
              }
              ?>
            </div>
            <div class="col-6">
              <label for="">Phone number</label>
              <input type="number" required class="form-control" name="phone" value="<?php echo $mpesa->phone; ?>" disabled>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-6">
              <label for="">Amount</label>
              <?php
              if (isset($_SESSION['amount'])) {
              ?>
                <input type="number" class="form-control" name="amount" value="<?php echo $_SESSION['amount']; ?>" disabled>
              <?php
              } else {
                unset($_SESSION['amount']);
              ?>
                <input type="number" class="form-control" name="amount" value="" disabled>
              <?php
              }
              ?>
            </div>
            <div class="col-6">
              <?php
              if (isset($_SESSION['amount'])) {
              ?>
                <label for="">PIN</label>
                <input type="number" required class="form-control" name="pin" placeholder="Enter mpesa pin">
              <?php
              } else {
                unset($_SESSION['amount']);
              }
              ?>
            </div>
          </div>
          <?php
          if (isset($_SESSION['amount'])) {
          ?>
            <div class="col-12 d-flex justify-content-end">
              <button type="submit" class="btn btn-success" name="order" value="submit">Complete order</button>
            </div>
          <?php
          } else {
            unset($_SESSION['amount']);
          ?>
            <div class="col-12">
              <button type="submit" class="btn btn-success" name="submit" value="submit">Order quantity</button>
            </div>
          <?php
          }
          ?>
        </form>
        <!--bs5 input-->
      </div>
      <div class="w-100 mt-5 text-end">
        <!-- <a href="../index.php">return to home</a> -->
      </div>
    </div>
  </div>
  </div>
  <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src=""></script>
  <script type="text/javascript" src=""></script>
  <script type="text/Javascript"></script>
</body>

</html>