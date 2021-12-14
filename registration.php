<?php
require 'vendor/autoload.php'; 
$client = new MongoDB\Client;

$ecommerce = $client->ecommerce;
$customer = $ecommerce->customer;
?>
<?php
if (isset($_POST['registerbutton'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $usercontactnumber = $_POST['usercontactnumber'];
    $useremail = $_POST['useremail'];
    $userpassword = $_POST['userpassword'];
    $useraddress = $_POST['useraddress'];
    $samecount = 0;

 

    $isUserExist = $customer->findOne([
        "email" => $useremail
    ]);

    if($isUserExist == null){
        // Register Karo
        // Get Last Inserted Id 
        $lastDocument = $customer->findOne(
            [],
            [
                'limit' => 1,
                'sort' => ['_id' => -1]        
            ]
        );
        $lastInsertedId = $lastDocument->_id;
        
        $customer->insertOne([
            "_id" => $lastInsertedId + 1,
            "name" => $firstname,
            "surname" => $lastname,
            "email" => $useremail,
            "password" => $userpassword,
            "address" => $useraddress,
            "contact_info" => $usercontactnumber
        ]); 
        echo '<div class="alert alert-success">User registered successfully, <a href="./">Click Here</a> To Go To Homepage.</div>';
    } else {
        echo '<div class="alert alert-danger">That email is already taken . Try again with a different one or try logging in again</div>';
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Hello, world!</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-3 "></div>
            <div class="col-sm-6 mt-5">
                <br><br>
                <br><br>
                <div class="card text-dark bg-light mb-3 ">
                    <div class="card-header"><b>User Registration</b></div>
                    <div class="card-body">

                        <form action="" method="POST">

                            <div class="input-group mb-3">
                                <span class="input-group-text bg-light" id="inputGroup-sizing-default">First Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                <input type="text" class="form-control" name="firstname" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-light" id="inputGroup-sizing-default">Last Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                <input type="text" class="form-control" name="lastname" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                            </div>

                            <div class="input-group mb-3">
                                <span class="input-group-text bg-light" id="inputGroup-sizing-default">Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                <input type="email" class="form-control" name="useremail" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                            </div>

                            <div class="input-group mb-3">
                                <span class="input-group-text bg-light" id="inputGroup-sizing-default">Password</span>
                                <input type="password" class="form-control" name="userpassword" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                            </div>

                            <div class="input-group mb-3">
                                <span class="input-group-text bg-light" id="inputGroup-sizing-default">Address&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                <input type="text" class="form-control" name="useraddress" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                            </div>

                            <div class="input-group mb-3">
                                <span class="input-group-text bg-light" id="inputGroup-sizing-default">Contact Number&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                <input type="text" class="form-control" name="usercontactnumber" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                            </div>
                            <div class="input-group mb-3 col-lg-6">
                                <input type="submit" class="btn btn-success btn-block" name="registerbutton" value="Register">
                            </div>

                        </form>
                    </div>
                </div>

            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>


</body>

</html>