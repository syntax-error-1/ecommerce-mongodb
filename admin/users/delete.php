<?php 
session_start();
require '../../vendor/autoload.php'; 
$client = new MongoDB\Client;

$ecommerce = $client->ecommerce;
$orders = $ecommerce->orders;
$products = $ecommerce->products;
$customer = $ecommerce->customer;

if(!isset($_SESSION["admin"])){
	header('location: ../login');
}

$id = $_GET["id"];
 

$sql = $customer->deleteMany([
   "_id" => (int)$id
]); 
 
 echo '<script>alert("User Deleted!");window.location.href = "./";</script>';
 
 
?>
 