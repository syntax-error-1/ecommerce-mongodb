
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
        </li>		<li class="nav-item mx-3">
          <a class="nav-link btn btn-primary text-light" href="../products">View Products</a>
        </li>
      </ul> 
    </div>
  </div>
</nav>

 <br>
 
<center style="background-color:lightgray;margin-top:-25px;"> <br> <div class="card text-white bg-secondary border-light mb-3" style="max-width: 18rem;">

  <div class="card-body text-center">
    <h2 class="card-title">ADD PRODUCT</h2>
  
  </div>
</div><br></center>

<div class="container">
 
 <br><br>
 
  <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
		
<?php 

if(isset($_POST["addproductbtn"])){
	$product_name = $_POST["name"];
	$price = $_POST["price"];
	$stock = $_POST["stock"];
	$description = $_POST["description"];
	$target_dir = "../../images/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	if (file_exists($target_file)) {
	  echo '<script>alert("Sorry, image already exists.")</script>';
	} else {
		move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
		$fileName = $_FILES["fileToUpload"]["name"];
    $lastDocument = $products->findOne(
      [],
      [
          'limit' => 1,
          'sort' => ['product_id' => -1]        
      ]
  );
  $lastInsertedId = $lastDocument->product_id;
 

    $query = $products->insertOne([
      "product_id" => $lastInsertedId + 1,
      "name" => $product_name,
      "description" => $description,
      "price" => $price,
      "stock" => $stock,
      "image" => $fileName
    ]);
    echo '<script>alert("Success!")</script>';
	}


}
?>
		<div class="card text-dark bg-light mb-3" >
   <div class="card-header"><center><b>Product Details</b></center></div>
  <div class="card-body">
  <form method="POST" action="" enctype="multipart/form-data">
 
 
 <div class="input-group mb-3">
  <span class="input-group-text" id="basic-addon1">Product Name: </span>
  <input type="text" name="name" class="form-control" placeholder="Product Name"  >
</div>
 <div class="input-group mb-3">
  <span class="input-group-text" id="basic-addon1">Price in $ </span>
  <input type="number" name="price" step="0.01" class="form-control" placeholder="0">
</div>
 <div class="input-group mb-3">
  <span class="input-group-text" id="basic-addon1">Stock Available:</span>
  <input type="number" name="stock" class="form-control" placeholder="1">
</div>
 <div class="input-group">
  <span class="input-group-text">Description: </span>
  <textarea name="description" class="form-control"></textarea>
</div>
 
<br><div class="input-group mb-3">
  <label class="input-group-text" for="inputGroupFile01">Upload Image</label>
  <input type="file" name="fileToUpload" id="fileToUpload" class="form-control" required>
</div>

<input type="submit" name="addproductbtn" value="Add Product" class="btn btn-success">
 </form>
   
  </div>
</div>
		
		
		
		
		
		</div>
        <div class="col-sm-2"></div>
		
	</div>

</div>

   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

 
  </body>
</html>