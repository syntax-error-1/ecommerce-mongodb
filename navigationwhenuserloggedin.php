<?php
$username = $_SESSION['name'];
?>

<nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark px-5 mb-5">
    <div class="container-fluid">
        <a class=" navbar-brand" href="index.php"> Ecommerce </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-5">
                <form class="d-flex mx-3">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success text-light" type="submit">Search</button>
                </form>

            </ul>
            <a class="text-success h4 nav-link "><?php echo $username ; ?></a>
            <a class="nav-link text-info h5" href="usercart.php">My Cart</a>
            <a class="nav-link text-warning h5" href="orders.php">My Orders</a>

            <a class="nav-link h5 text-danger " href="logout.php">Logout</a>
        </div>
    </div>
</nav>