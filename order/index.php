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
        $sql = $con->query("SELECT name, price, unit, quantity FROM medicines WHERE id = $id");
        $row = mysqli_fetch_assoc($sql);
        echo 'medicine: ' . $row['name'] . '<br/>Available quantity: ' . $row['quantity'] . '<br/>
          price is ' . $row['price'] . ' per ' . $row['unit'] . '';
        ?>
      </div>
      <?php
      if (isset($_POST['submit'])) {
        $quantity = mysqli_real_escape_string($con, $_POST['quantity']);
        $phone = mysqli_real_escape_string($con, $_POST['phone']);
        $amount = mysqli_real_escape_string($con, $_POST['amount']);
        $pin = mysqli_real_escape_string($con, $_POST['pin']);

        $fetch_mpesa_numbers = $con->query("SELECT pin, phone FROM mpesa WHERE phone = $phone");
        $fetch_pin = mysqli_fetch_assoc($fetch_mpesa_numbers);
        $mpesa_pin = $fetch_pin['pin'];
        if (mysqli_num_rows($fetch_mpesa_numbers) == 1) {
          $sql_balance = $con->query("SELECT balance FROM mpesa WHERE phone = $phone");
          $fetch_balance = mysqli_fetch_assoc($sql_balance);
          $initialBalance = $fetch_balance['balance'];
          if ($amount <= 0) {
            echo '<div class="alert alert-danger text-center">Invalid quantity</div>';
          } else {
            if ($amount <= $initialBalance) {
              $sql_quantity = $con->query("SELECT quantity, price FROM medicines WHERE id = $id");
              $fetch_medicine_details = mysqli_fetch_assoc($sql_quantity);
              $price = $fetch_medicine_details['price'];
              $fetch_quantity = $fetch_medicine_details['quantity'];
              if ($quantity <= 0) {
                echo '<div class="alert alert-danger text-center">Invalid quantity</div>';
              } else {
                if ($quantity <= $fetch_quantity) {
                  $priceToPay = $price * $quantity;
                  if ($amount == $priceToPay) {
                    if ($pin === $mpesa_pin) {
                      $newBalance = $initialBalance - $amount;
                      $newQuatity = $fetch_quantity - $quantity;
                      $sql = $con->query("INSERT INTO orders (medicine_id,ordered_quantity, amount, phoneNumber, user_id) 
                                          VALUES ('$id', '$quantity', '$amount','$phone','$_SESSION[id]')");
                      if (!mysqli_error($con)) {
                        $query_pesa = $con->query("UPDATE mpesa SET balance ='" . $newBalance . "' WHERE phone = $phone");
                        $query_quantity = $con->query("UPDATE medicines SET quantity ='" . $newQuatity . "' WHERE id = $id");
                        echo '<div class="alert alert-success text-center">Order made successfully</div>';
                        header('Refresh:2; url=../view-medicine.php');
                      } else {
                        echo '<div class="alert alert-danger">There is an error' . mysqli_error($con) . '</div>';
                      }
                    } else {
                      echo '<div class="alert alert-danger text-center">Invalid mpesa pin</div>';
                    }
                  } else {
                    echo '<div class="alert alert-danger text-center">you have to pay ' . $priceToPay . ' only, Try again!</div>';
                  }
                } else {
                  echo '<div class="alert alert-danger text-center w-100">Ordered quantity exceeds available quantity</div>';
                }
              }
            } else {
              echo '<div class="alert alert-danger text-center">Insufficient fund to approve a transaction</div>';
            }
          }
        } else {
          echo '<div class="alert alert-danger text-center">A phone number is not registered to use mpesa service</div>';
        }
      }
      ?>
      <hr>
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
              <input type="number" required class="form-control mb-3" name="quantity" placeholder="Enter quantity">
            </div>
            <div class="col-6">
              <input type="number" required class="form-control mb-3" name="phone" placeholder="Enter Phone Number">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-6">
              <input type="number" required class="form-control mb-3" name="amount" placeholder="Enter Amount">
            </div>
            <div class="col-6">
              <input type="number" required class="form-control mb-3" name="pin" placeholder="Enter mpesa pin">
            </div>
          </div>
          <div class="col-12">
            <button type="submit" class="btn btn-success" name="submit" value="submit">Order now</button>
          </div>
        </form>
        <!--bs5 input-->
      </div>
      <div class="w-100 mt-5 text-end">
        <a href="../index.php">return to home</a>
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