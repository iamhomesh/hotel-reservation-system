<?php

session_start();

include_once __DIR__ . '/../classes/Guest.php';
$guest = new Guest();


$id = $name = $email = $mobile = $id_card = $city = $state_id = $pin_code = $address = "";

if (isset($_SESSION['guest_id'])) {


    $id = $_SESSION['guest_id']; //session id

    //Fetch data from database and assign to the variables
    $row = $guest->fetchData($id); //Fetching data
    $id = $row['guest_id'];
    $name = $row['name'];
    $mobile = $row['mobile'];
    $email = $row['email'];
    $id_card = $row['id_card'];
    $city = $row['city'];
    $state_id = $row['state_id'];
    $pin_code = $row['pin_code'];
    $address = $row['address'];
}




if (isset($_POST['submit'])) {
    $string = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $code = "";
    for ($i = 0; $i <= 4; $i++) {
        $random = rand(0, strlen($string) - 1);
        $code .= substr($string, $random, 1);
    }

    $code = $code . rand(0, 9999999);
    echo $code;
}


?>



<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Hotel Resevation System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <!--MDB Bootstrap Material Design-->
    <!-- <link rel="stylesheet" href="../assets/MDB-Free_4.7.7/css/mdb.min.css"> -->
    <!--Font Awesome-->
    <link rel="stylesheet" href="../assets/fontawesome-free-5.8.1-web/css/all.min.css">
    <!--Personal Style sheet -->
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/custom/style.css" />




</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <!-- <i class="fas fa-bars"></i> -->
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="active nav-item">
                    <a href="home.php" class="nav-link"><i class="d-none d-lg-block text-center fa fa-laptop" style="font-size: 20px"></i>Home</a>
                </li>


                <li class="nav-item">
                    <a href="book.php" class="nav-link"><i class="d-none d-lg-block text-center fas fa-bed" style="font-size: 20px"></i>Book</a>
                </li>
                <li class="nav-item">
                    <a href="bookings.php" class="nav-link"><i class="d-none d-lg-block text-center fas fa-history" style="font-size: 20px"></i>Bookings</a>
                </li>
                <li class="nav-item">
                    <a href="support.php" class="nav-link"><i class="d-none d-lg-block text-center fas fa-envelope" style="font-size: 20px"></i>Support</a>
                </li>
            </ul>

        </div>
        <div class="navbar-brand">

            <div class="user-area dropdown">

                <a href="#" class="active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <!--dropdown-toggle-->
                    <p class="text-uppercase nav-link m-1 text-dark font-weight-bold"><?= $name ?? "" ?> <i class="fas fa-chevron-circle-down"></i></p>
                    <!-- <img class="user-avatar rounded-circle" src="images/admin.jpg" alt="User Avatar"> -->
                </a>

                <style>
                    .user-menu {
                        left: inherit !important;
                        right: 0;
                    }

                    .user-menu .nav-link {
                        font-size: 14px;

                    }
                </style>

                <div class="user-menu dropdown-menu bg-dark position-absolute">

                    <a class="text-secondary nav-link" href="profile.php"><i class="fas fa-user mr-2"></i>Profile</a>

                    <a class="text-secondary nav-link" href="change_password.php"><i class="fas fa-cog mr-2"></i>Password</a>

                    <a class="text-danger nav-link" href="logout.php"><i class="fas fa-sign-out-alt mr-2"></i>Logout</a>
                </div>
            </div>
        </div>



    </nav>



    <div class="container">
        <div class="row m-auto" style="">
            <!--ROW START-->
            <div class="col-lg-12 overflow-auto" style="max-height: 590px">

                <div class="card mt-5 mt-lg-5">
                    <div class="card-header"><strong>Profile</strong></div>
                    <div class="">

                        <div class="card-body card-block overflow-auto" style="max-height: 300px">
                            <div class="row">

                                <div class="col-12 col-sm-12 col-lg-12 text-center">
                                    <p class="text-right badge">30-07-1992 10:20:00</p>
                                    <p class="badge badge-secondary">ABCDE12345</p>
                                    <p class="badge badge-dark">Payment</p>

                                    <p class="text-right badge badge-danger">Unread</p>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <label for=""><strong>MESSAGE: </strong></label>
                                    <p>fhhsf hkfhskfhk fkahfkahfkafh khfaf</p>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <label for=""><strong>COMMENT: </strong></label>
                                    <p>We are trying our best to solve your problem.</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 justify-content-center" style="height: 200px">
                                    
                                    <a href=""><img src="../bg.jpg" alt="screenshot" style="height: 100%; width: 100%"></a>
                                    
                                </div>

                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </div>

    </div>


    <?php include_once __DIR__ . '../includes/footer.php' ?>