<?php
session_start();
require 'vendor/autoload.php'; 
$client = new MongoDB\Client;

$ecommerce = $client->ecommerce;
$products = $ecommerce->products;
$cart = $ecommerce->cart;

if (!isset($_SESSION['email'])) {
  header("Location: login.php");
}

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
  <title>Cart</title>
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
    <p class="display-6 mb-5">Hello ,  <?php echo $username; ?></p>
    <table class="table  table-striped text-center my-4">
      <thead>
        <tr>
          <th scope="col">Serial No</th>
          <!-- <th scope="col">product id</th> -->
          <th scope="col">Product</th>
          <th scope="col">Quantity</th>
          <th scope="col">Unit Price</th>
          <th scope="col">Gross Price</th>
          <th scope="col">Delete</th>
        </tr>
      </thead>
      <tbody>


        <?php
        $showCart = $cart->find([
          "customer_id" => (int)$customer_id
        ]);
        $serialnumberdepictor = 1;
        foreach($showCart as $userCart){
          $product_id = $userCart->product_id;
          $quantity = $userCart->quantity;
          $id  = $userCart->id;
          
          $product_query = $products->findOne([
            "product_id" => (int)$product_id
          ]);

          $productname = $product_query->name;
          $price = $product_query->price; 
          $grosstotal = $quantity * $price;
          $totalprice = $totalprice + $grosstotal;
        ?>
          <tr>
            <th scope="row"><?php echo $serialnumberdepictor; ?></th>
            <!-- <td><?php echo $product_id; ?></td> -->
            <td><?php echo $productname; ?></td>
            <td><?php echo $quantity; ?></td>
            <td>$<?php echo $price; ?></td>
            <td>$<?php echo $grosstotal; ?></td>
            <td><a href='delete.php?deleteid=<?php echo $id; ?>' class="btn btn-danger btn-xs" name="deletebutton">Delete </a></td>
          </tr>
        <?php
          $serialnumberdepictor = $serialnumberdepictor + 1;
        }
        ?>
      </tbody>
    </table>
    <div class="container w-25  text-center mt-5">
      <span class="h2">$<?php echo $totalprice; ?></span>
      <br>
      <a href='buypage.php?customerid=<?php echo $customer_id; ?>' name='buybutton' class="btn btn-success mt-2 btn-block col-md-8">Check Out</a>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>