<?php
require 'vendor/autoload.php'; 
$client = new MongoDB\Client;

$ecommerce = $client->ecommerce;
$cart = $ecommerce->cart;

if (isset($_GET['deleteid'])) {
    $id = $_GET['deleteid'];

    $cart->deleteOne([
        'id' => (int)$id
    ]);
    
 
    header("Location: usercart.php");
}
?>


