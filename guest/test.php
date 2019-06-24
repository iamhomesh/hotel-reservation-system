
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


        $fields = array(
            'name' => $_POST['name'],
            'mobile' => $_POST['mobile'],
            'email' => $_POST['email'],
            'id_card' => $_POST['id-card'],
            'pin_code' => $_POST['pin-code'],
            'address' => $_POST['address'],
            'city' => $_POST['city'],
            'state_id' => $_POST['state']
        );

        $update = $guest->update(3, $fields);
        if ($update) echo "<script>alert('Data updated successfully')</script>";
        else echo "<script>alert('Data not updated successfully')</script>";
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

                        <div class="card-body card-block ">
                            <form method="POST" action="">
                                <div class="form-row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" value="<?= $name ?? "" ?>" name="name" placeholder="Name" />

                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" value="<?= $email ?? "" ?>" name="email" placeholder="Email" />

                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="mobile">Mobile</label>
                                            <input type="tel" class="form-control" value="<?= $mobile ?? "" ?>" name="mobile" placeholder="Mobile Number" />

                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="id-card">ID Card</label>
                                            <input type="text" class="form-control" value="<?= $id_card ?? "" ?>" name="id-card" placeholder="ID Card" />

                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="city">City</label>
                                            <input type="text" class="form-control" value="<?= $city ?? "" ?>" name="city" placeholder="City" />

                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="state">State</label>
                                            <select name="state" class="form-control" required>

                                                <?php
                                                include_once __DIR__ . '../../classes/State.php';

                                                $state = new State();
                                                $rows = $state->fetchAllState(); ?>
                                                <option value="">Select state</option>

                                                <?php

                                                foreach ($rows as $row) : ?>

                                                    <?php
                                                    if ($row['state_id'] == $state_id) : ?>

                                                        <option value="<?= $row['state_id'] ?>" class="text-danger" selected><?= $row['state_name'] ?></option>
                                                    <?php else : ?>
                                                        <option value="<?= $row['state_id'] ?>"><?= $row['state_name'] ?></option>

                                                    <?php
                                                endif;
                                            endforeach;
                                            ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="pinn-code">Pin Code</label>
                                            <input type="text" class="form-control" value="<?= $pin_code ?? "" ?>" name="pin-code" placeholder="Pin Code" />

                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="password">Address</label>
                                            <textarea name="address" id="" class="form-control"><?= $address ?? "" ?></textarea>

                                        </div>
                                    </div>


                                    <div class="col-lg-12">
                                        <button name="submit" class="btn btn-danger btn-block btn-sm">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>


                </div>
            </div>
        </div>

    </div>
   

    <?php include_once __DIR__. '../includes/footer.php' ?>