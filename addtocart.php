<?php 
session_start();
require 'vendor/autoload.php'; 
$client = new MongoDB\Client;

$ecommerce = $client->ecommerce;
$cart = $ecommerce->cart;

if (!isset($_SESSION['email'])) {
  header("Location: login.php");
}

if (isset($_POST['addtocartbutton'])) {
    $id = $_GET['product_id'];
    $quantity = $_POST['quantity'];

      // Get Last Inserted Id 
      $lastDocument = $cart->findOne(
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
    $customer_id = $_SESSION['id'];

 
    $cart->insertOne([
      "id" => $lastInsertedId + 1,
      "customer_id" => $customer_id,
      "product_id" => $id,
      "quantity" => $quantity
    ]);

    header("Location: usercart.php");
}
?>

