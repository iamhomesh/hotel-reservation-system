<?php
session_start();
if (isset($_SESSION['username'])) {
    header("location: admin/dashboard.php");
}

//include_once 'settion.php';

/*
session_start();
if (isset($_SESSION['user'])) {
    header("location: admin/dashboard.php");
}
include 'config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($link, $_POST['username']);
    $password = mysqli_real_escape_string($link, $_POST['password']);

    $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password' ";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_assoc($result);

    $count = mysqli_num_rows($result);
    //if result matched username and password, table row must be 1 row
    if ($count == 1) {
        $_SESSION['user'] = $username;
        header("location: admin/dashboard.php");
    } else {
        ?>
<div class="alert alert-danger text-center" role="alert">
    <b>Opps!</b> username and password did not match.
</div>
<?php
    }
}
*/


if (isset($_POST['login'])) {
    require_once 'process_login.php';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Hotel Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <!--Font Awesome-->
    <link rel="stylesheet" href="assets/fontawesome-free-5.8.1-web/css/all.min.css">
    <!--Personal Style sheet -->
    <link rel="stylesheet" type="text/css" media="screen" href="assets/MDB-Free_4.7.7/css/mdb.min.css" />
</head>

<style>
    body {
        background-image: url(bg1.jpg);
        background-repeat: no-repeat;
        background-size: 100%;
    }
</style>

<body>

    <nav class="navbar navbar-expand-md navbar-light sticky-top">
        <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
            <ul class="navbar-nav mr-auto font-weight-bold">
                <li class="nav-item active">
                    <a class="nav-link text-white" href="#home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Contact</a>
                </li>
            </ul>
        </div>
        <div class="mx-auto order-0">
            <a class="navbar-brand mx-auto text-danger" href="#">HOTEL RESERVATION SYSTEM</a>

        </div>
        <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link orange-text" href="guest">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="guest/register.php">Register</a>
                </li>
            </ul>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>
    <div class="container">


        <div id="home" class="align-items-center justify-content-center h-100">
            <div class="row justify-content-center text-center">
                <div class="col-12">
                    <h1>A place for family vacation</h1>
                </div>

<a href="" class="btn btn-danger">FIND ROOMS</a>
            </div>
            
        </div>
        <div id="about" class="h-100">
            <h1>Welcome to about</h1>
        </div>
    </div>

    <!--Bootstrap-->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/popper-1.14.7.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="js/script.js"></script>
</body>

</html>