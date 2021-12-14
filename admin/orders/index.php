
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

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Admin Panel</title>
  </head>
  <style>
/*
      .card {
          display: inline-block
      }    
*/
</style>
  <body>
   <!-- Button trigger modal -->


<!-- Modal -->

    <nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark px-5">
  <div class="container-fluid">
    <a class=" navbar-brand" href="../">ADMIN PANEL</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-5">
		<li class="nav-item mx-3">
          <a class="nav-link btn btn-primary text-light" href="../users">Manage Users</a>
        </li>
		<li class="nav-item mx-3">
          <a class="nav-link btn btn-primary text-light" href="../orders">View Orders</a>
        </li>
		<li class="nav-item mx-3">
          <a class="nav-link btn btn-primary text-light" href="../add">Add Product</a>
        </li>
			<li class="nav-item mx-3">
          <a class="nav-link btn btn-primary text-light" href="../products">View Products</a>
        </li>
      </ul> 
    </div>
  </div>
</nav>

 <br>
 
<center style="background-color:lightgray;margin-top:-25px;"> <br> <div class="card text-white bg-secondary border-light mb-3" style="max-width: 18rem;">

  <div class="card-body text-center">
    <h2 class="card-title">VIEW ORDERS</h2>
  
  </div>
</div><br></center>

<div class="container">
<br><br>
  <table class="table">
  <thead>
    <tr>
      <th scope="col">Order ID</th>
      <th scope="col">Customer Name</th>
      <th scope="col">Product Name</th>
      <th scope="col">Quantity</th>
      <th scope="col">Date</th>
 
    </tr>
  </thead>
  <tbody>
<?php 


$query = $orders->find([],[
  "limit" => 25
]);

 
 
  // output data of each row
  $count = 0;
  forEach($query as $row){
   $customer_id = $row->customer_id;
   $product_id = $row->product_id;

   $cquery = $customer->findOne([
     "_id" => (int)$customer_id
   ]);
   $customerName =  $cquery->name;


   $pquery = $products->findOne([
    "product_id" => $product_id
  ]);
  $productName =  $pquery->name;

 
   echo '<tr>
      <th scope="row">'.$row->id.'</th>
      <td>'.$customerName.'</td>
      <td title="'.$productName.'">'.substr($productName,0,20).'</td>
      <td>'.$row->quantity.'</td>
      <td>'.$row->date.'</td>
    </tr>';
  }
?>
  </tbody>
</table>
</div>
                </div>

            </div>
        </div>
    </div>

   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

 
  </body>
</html>