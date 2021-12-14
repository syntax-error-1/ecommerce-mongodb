<?php 

session_start();
require 'vendor/autoload.php'; 
$client = new MongoDB\Client;

$ecommerce = $client->ecommerce;
$products = $ecommerce->products;
$cart = $ecommerce->cart;
$orders = $ecommerce->orders;

if (isset($_GET['customerid'])) {
  $customer_id = $_GET['customerid'];

  $userProducts = $cart->find([
    "customer_id" => (int)$customer_id
  ]);

foreach($userProducts as $userProduct){
  $product_id = $userProduct->product_id;
  $quantity = $userProduct->quantity;
  $id  = $userProduct->id;
  $currentdate = date('d-m-y');

          
  $product_query = $products->findOne([
    "product_id" => (int)$product_id
  ]);
  $productname = $product_query->name;
  $price = $product_query->price; 
  $grosstotal = $quantity * $price;
  $lastDocument = $orders->findOne(
      [],
      [
          'limit' => 1,
          'sort' => ['id' => -1]        
      ]
  );
  $lastInsertedId = $lastDocument->id;
  if($lastInsertedId == null){
    $lastInsertedId = 0;
  }
  $orders->insertOne([
    "id" => $lastInsertedId + 1,
    "customer_id" => (int)$customer_id,
    "product_id" => (int)$id,
    "quantity" => (int)$quantity,
    "date" => $currentdate,
    "price" => (int)$price
  ]);

  // Delete from cart after order is completed
  $cart->deleteMany([
    "customer_id" => (int)$customer_id
  ]);
  header("Location:order_success.php");
}
}
?>
  