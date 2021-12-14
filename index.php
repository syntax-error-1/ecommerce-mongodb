<?php
require 'vendor/autoload.php'; 
$client = new MongoDB\Client;

$ecommerce = $client->ecommerce;
$products = $ecommerce->products;

$allProducts = $products->find([]);
?>
<?php session_start(); ?>



<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <title>E-commerce</title>
</head>
<style>
</style>

<body>
  <?php
  if (isset($_SESSION['email'])) {
    include "navigationwhenuserloggedin.php";
    $username = $_SESSION['name'];
   
  } else {
    include "navigationwhenusernotloggedin.php";
  }
  ?>

  <div class="container">
  
  
    <div class="row">

      <?php
        foreach($allProducts as $myProduct){
          $product_id = $myProduct->product_id;
          $name = $myProduct->name;
          $description = $myProduct->description;
          $price = $myProduct->price;
          $stock = $myProduct->stock;
          $image = $myProduct->image;
      ?>
      
        <div class="card my-3 mx-3 border border-dark" style="width: 13rem;">
          <img src="images/<?php echo $image; ?>" alt="Card image cap" height="170px" class="mt-3">
          <div class="card-body">
            <h5 class="card-title"><?php echo $name; ?></h5>
            <p class="card-text">$<?php echo $price; ?></p>
            <p class="class-text"><small><?php echo $stock; ?> left in stock</small></p>
          </div>
          <a class="btn btn-dark btn-block mb-4 mx-3 " href='product.php?product_id=<?php echo $product_id; ?>'>View Product</a>
        </div>

      <?php } ?>

    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</body>

</html>