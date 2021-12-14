<?php 
session_start();
require '../../vendor/autoload.php'; 
$client = new MongoDB\Client;

$ecommerce = $client->ecommerce;
$orders = $ecommerce->orders;
$products = $ecommerce->products;
$admins = $ecommerce->admins;


if(!isset($_SESSION["admin"])){
	header('location: ../login');
}

$id = $_GET["id"];
 
 $products->deleteMany([
    "product_id" => (int)$id
 ]);

  echo '<script>alert("Product Deleted!");window.location.href = "./";</script>';
 
 
?>
 