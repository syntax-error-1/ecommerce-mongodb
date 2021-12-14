<?php 
session_start();
include "connection.php";
?>


<?php
if (!isset($_SESSION['email'])) {
  header("Location: login.php");
}

?>
<?php
$username = $_SESSION['name'];
$customer_id = $_SESSION['id'];
$totalprice = 0;
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <title>Order Success!</title>
</head>

<body style="font-family:Verdana;">
  <?php
  if (isset($_SESSION['email'])) {
    include "navigationwhenuserloggedin.php";
  } else {
    include "navigationwhenusernotloggedin.php";
  }
  ?>
  <div class="container  ">
   <h2 class="text-center">Hello <?php echo $username; ?> !</h2>
  <center> <img src="images/order_success.png" style="width:30%;height:auto;">
   <h3>Order Successful !</h3>
   <p class="lead">We will try our best to deliver your order as soon as possible!</p>
  </center>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>