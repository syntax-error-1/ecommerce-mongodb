<?php 

session_start();
require '../../vendor/autoload.php'; 
$client = new MongoDB\Client;

$ecommerce = $client->ecommerce;
$orders = $ecommerce->orders;
$products = $ecommerce->products;
$admins = $ecommerce->admins;

if(isset($_SESSION["admin"])){
	header('location: ../');
}
$LoginFail = false;
if(isset($_POST["loginbtn"])){
	$email = $_POST["email"]; 
	$password= $_POST["password"]; 
	
  $findUser = $admins->findOne([
    "email" => $email,
    "password" => $password
]);

if($findUser->email == null){
  $LoginFail = true;
} else {
  $_SESSION["admin"] = true;
  header('location: ../');
}
 
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

    <title>Login - Admin Panel</title>
  </head>
  <body>
  
  <div class="container">
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
		<br><br><br><br><br><br><br><br><br><br>
		<?php if ($LoginFail) { echo '<div class="alert alert-danger">Invalid Credentials.</div>';} ?>  
		<div class="card text-dark bg-light mb-3" >
  <div class="card-header"><b>Admin Panel Login</b></div>
  <div class="card-body">
     
<form action="" method="POST">
<div class="input-group mb-3">
  <span class="input-group-text bg-light" id="inputGroup-sizing-default">Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
  <input type="email" class="form-control" name="email" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
</div>

<div class="input-group mb-3">
  <span class="input-group-text bg-light" id="inputGroup-sizing-default">Password</span>
  <input type="text" class="form-control" name="password" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
</div>
<input type="submit" class="btn btn-success" name="loginbtn" value="Login">
</form>
  </div>
</div>
		
		</div>
        <div class="col-sm-4"></div>
    </div>
</div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
  </body>
</html>