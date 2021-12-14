<?php
session_start();
require 'vendor/autoload.php';
$client = new MongoDB\Client;

$ecommerce = $client->ecommerce;
$products = $ecommerce->products;
$orders = $ecommerce->orders;
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
  <title>My Orders</title>

</head>

<body>
  <?php
  if (isset($_SESSION['email'])) {
    include "navigationwhenuserloggedin.php";
  } else {
    include "navigationwhenusernotloggedin.php";
  }
  ?>
  <div class="container  ">
    <center>
      <h2>My Orders</h2>
    </center><br>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Order ID</th>
          <th scope="col">Product Name</th>
          <th scope="col">Quantity</th>
          <th scope="col">Date</th>

        </tr>
      </thead>
      <tbody>
        <?php

        $ordersData = $orders->find([
          "customer_id" => $customer_id
        ]);

        if ($ordersData == null) {
          echo "No orders found!";
        } else {

          foreach ($ordersData as $order) {
            $order_id = $order->id;
            $customer_id = $order->customer_id;
            $product_id =  $order->product_id;
            $quantity =  $order->quantity;
            $date =  $order->date;

            $productName = $products->findOne([
              "product_id" => $product_id
            ]);
            echo '<tr>
                <th scope="row">' . $order_id . '</th>

                <td title="' . $productName->name . '">' . substr($productName->name, 0, 20) . '</td>
                <td>' . $quantity . '</td>
                <td>' . $date . '</td>

              </tr>';
          }
        }
        ?>
      </tbody>
    </table>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
<script type="text/javascript">
  window.onbeforeunload = function() {
    return "Your work will be lost.";
  };
</script>

</html>