
<?php 
session_start();
require '../../vendor/autoload.php';
$client = new MongoDB\Client;

$ecommerce = $client->ecommerce;
$orders = $ecommerce->orders;
$products = $ecommerce->products;
$admins = $ecommerce->admins;
$customer = $ecommerce->customer;

if(!isset($_SESSION["admin"])){
	header('location: ../login');
}
if(isset($_POST["submitbutton"])){
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $usercontactnumber = $_POST['usercontactnumber'];
  $useremail = $_POST['useremail'];
  $userpassword = $_POST['userpassword'];
  $useraddress= $_POST['useraddress'];
  $id = $_GET["id"];

if(!empty($userpassword)){
	$sql = "UPDATE customer SET name='$firstname',surname='$lastname',email='$useremail',password='$userpassword',contact_info='$usercontactnumber',address='$useraddress' WHERE id='$id'";
  $sql = $customer->updateMany(
    ['_id' => (int)$id],
    ['$set' => ['name'=>$firstname,'surname'=>$lastname,'email'=>$useremail,'password'=>$userpassword,'contact_info'=>$usercontactnumber,'address'=>$useraddress]]
  );
} else {
  $sql = $customer->updateMany(
    ['_id' => (int)$id],
    ['$set' => ['name'=>$firstname,'surname'=>$lastname,'email'=>$useremail,'contact_info'=>$usercontactnumber,'address'=>$useraddress]]
  );
}
  echo "<script>alert('Changes Saved!');</script>";
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
    <h2 class="card-title">MANAGE USER #<?php echo $_GET["id"]; ?></h2>
  </div>
</div><br></center>

<?php 
$id = $_GET["id"];
 
$row = $customer->findOne(["_id" => (int)$id]);
?>
<div class="container">
   <form action="" method="post">
	 <div class="row my-3">
    <div class="col">
      <input type="text" class="form-control" placeholder="First name" name='firstname' value="<?php echo $row->name;?> ">
    </div>
    <div class="col">
      <input type="text" class="form-control" placeholder="Last name" name='lastname'  value="<?php echo $row->surname;?> " >
    </div>
  </div>
   <div class="form-group row my-3">
    <div class="col-sm-12">
      <input type="email" class="form-control my-3" id="useremail" placeholder="Email.." name='useremail'   value="<?php echo $row->email;?> ">
      <input type="password" class="form-control my-3" id="userpassword" placeholder="Password .." name='userpassword'  >
    </div>
  </div>   
   
  <div class="form-group  my-3">
    
    <input type="text" class="form-control my-3" id="useraddress" placeholder="Delivery address "name='useraddress'  value="<?php echo $row->address;?> " >
    <input type="text" class="form-control my-3" id="contactnumber" placeholder="Contact Number" name='usercontactnumber'   value="<?php echo $row->contact_info;?> ">
  </div>
  <button type="submit" class="btn btn-primary mt-3" name='submitbutton'>Save</button>
</form>
    </div>

   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

 
  </body>
</html>