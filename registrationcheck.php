
<?php
include "connection.php";
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

    $query = "SELECT email from customer where email = '{$useremail}'";
    $userregisterquery = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_array($userregisterquery)) {
        $samecount = $samecount + 1;
    }

    if ($samecount == 0) {
        $query = "INSERT INTO customer (name, surname, email, password, address , contact_info) ";
        $query .= "VALUES ('$firstname', '$lastname', '$useremail', '$userpassword', '$useraddress' , '$usercontactnumber') ";
        $add_query = mysqli_query($connection, $query);
        if (!$add_query) {
            die(mysqli_error($connection));
        }
        header("Location: index.php");
    } else {
        echo "user registered already";
    }
}
?>