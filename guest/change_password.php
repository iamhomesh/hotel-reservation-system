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
                    <a href="home.php" class="nav-link"><i class="d-none d-lg-block text-center fa fa-laptop" style="font-size: 20px"></i>Dashboard</a>
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


        <div class="navbar-brand" style="width:10%">
            <div class="user-area dropdown float-right">
                <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="user-avatar rounded-circle" src="images/admin.jpg" alt="User Avatar">
                </a>

                <div class="user-menu dropdown-menu">
                    <a class="nav-link" href="profile.php"><i class="fas fa-user mr-2"></i>Profile</a>

                    <a class="nav-link" href="change_password.php"><i class="fas fa-cog mr-2"></i>Password</a>

                    <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt mr-2"></i>Logout</a>
                </div>
            </div>
        </div>
    </nav>


    <?php

    $id = $curr = $new = $conf = "";
    $errors = array();

    include_once __DIR__ . '/../classes/Guest.php';
    if (isset($_POST['submit'])) {
        //change this session ID
        $id = $_POST['id'];


        $curr = $_POST['password'];
        $new = $_POST['new-pass'];
        $conf = $_POST['con-pass'];



        if (empty($curr)) $errors[] = "Enter current password";
        if (empty($new)) $errors[] = "Enter new password";
        if (empty($conf)) $errors[] = "Confirm new password";

        if ($new != $conf) $errors[] = "New and confirm password must match";

        if (empty($errors)) {
            $user = new Guest();
            $test = $user->changePassword($id, $curr, $new);
            if ($test == true) : ?>

                <script>
                    alert("Password chnaged successfully");
                </script>

            <?php else : ?>
                <script>
                    alert("Something went wrong, may be current password did match to database");
                </script>

            <?php endif;
    }
}


?>
    <div class="container">
        <div class="row m-auto" style="max-width:500px">
            <!--ROW START-->
            <div class="col-lg-12">

                <div class="card mt-5 mt-lg-4">
                    <div class="card-header"><strong>Change Password</strong></div>
                    <div class="">

                        <div class="card-body card-block ">
                            <form method="POST" action="">
                                <div class="text-center">


                                    <?php
                                    foreach ($errors as $error) : ?>
                                        <p class="badge badge-danger"><?= $error ?></p>
                                    <?php endforeach;
                                ?>
                                </div>

                                <div class="form-group">

                                    <div class="form-row">
                                        <input type="hidden" value="<?= $id ?>" name="id">
                                        <div class="col-lg-12 ">
                                            <label for="guest-name">Current Password</label>
                                            <input type="password" class="form-control" value="<?= $curr ?? "" ?>" name="password" placeholder="Current Password" autocomplete="off">

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="form-row">
                                        <div class="col-lg-12">
                                            <label for="mobile">New Password</label>
                                            <input type="password" class="form-control" value="<?= $new ?? "" ?>" name="new-pass" placeholder="New Password" autocomplete="off">

                                        </div>
                                    </div>
                                </div>
                                

                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-lg-12">
                                            <label for="mobile">Confirm Password</label>
                                            <input type="text" class="form-control" value="<?= $conf ?? "" ?>" name="con-pass" placeholder="Confirm Password" autocomplete="off">

                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button id="submit" type="submit" name="submit" class="btn btn-info btn-block"><strong>Submit</strong></button>
                                </div>
                            </form>
                        </div>

                    </div>


                </div>
            </div>
        </div>

    </div>
    <footer id="footer" class="text-center bg-light fixed-bottom" style="height: 70px; bottom: 0; width: 100%;">
        <div class="container">

            <div class="row mt-3 mt-lg-4">
                <div class="col-sm-6">
                    <span class="text-dark">Copyright &copy; 2019 <a href="#" class="text-dark font-weight-bold">Hotel Resevation System</a></span>
                </div>
                <div class="col-sm-6">
                    <span class="text-dark">Designed by <a href="" class="text-dark font-weight-bold">HOMESH KUMAR VERMA</a></span>
                </div>
            </div>
        </div>
    </footer>
    <!-- /.site-footer -->

    <!-- Scripts -->
    <script src="assets/script/jquery-3.3.1.min.js"></script>
    <script src="assets/script/popper-1.14.7.min.js"></script>
    <script src="assets/script/bootstrap.min.js"></script>

    <!-- <script src="assets/script/main.js"></script> -->

    <script>

    </script>

</body>

</html>