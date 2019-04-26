<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Hotel Resevation System</title>
    <meta name="description" content="Hotel Management System">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/styles/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fontawesome-free-5.8.1-web/css/all.min.css">
    <!-- <link rel="stylesheet" href="custom.css"> -->



    <style>
        .user-area .dropdown-toggle {
            position: relative;
            z-index: 0;
        }

        .user-area .dropdown-toggle:before {
            content: "";
            position: absolute;
            right: -3px;
            bottom: 10px;
            background: #868e96;
            width: 11px;
            height: 11px;
            border-radius: 100%;
            border: 2px solid white;
            z-index: 1;
        }

        .user-area .dropdown-toggle.active:before {
            background: #49a342;
        }

        .dropdown-menu {
            border-radius: 0;
            -webkit-transform: none !important;
            transform: none !important;
        }

        .for-notification .dropdown-menu .dropdown-item {
            padding: 5px 15px !important;
            text-overflow: ellipsis;
        }

        .for-notification .dropdown-menu .dropdown-item i {
            float: left;
            font-size: 14px;
            margin: 5px 5px 0 0;
            text-align: left;
            width: 20px;
        }

        .for-notification .dropdown-menu .dropdown-item p {
            padding: 0 !important;
            text-overflow: ellipsis;
        }

        .user-area {
            float: right;
            padding-right: 0;
            position: relative;
            padding-left: 20px;
        }

        .user-area .user-menu {
            background: #fff;
            border: none;
            left: inherit !important;
            right: 0;
            top: 54px !important;
            margin: 0;
            max-width: 150px;
            padding: 5px 10px;
            position: absolute;
            width: 100%;
            z-index: 999;
            min-width: 150px;
            -webkit-box-shadow: 0 3px 12px rgba(0, 0, 0, 0.05);
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.05);
        }

        .user-area .user-menu .nav-link {
            color: #607d8b;
            display: block;
            font-size: 13px;
            line-height: 22px;
            padding: 5px 0;
        }

        .user-area .user-menu .nav-link>i {
            margin-right: 10px;
        }

        .user-area .user-avatar {
            float: right;
            width: 40px;
        }

        .user-area .name {
            color: #8c8c8c;
            font-size: 14px;
            position: relative;
            text-transform: uppercase;
        }

        .user-area .count {
            background: #d9534f;
            border-radius: 50%;
            color: #fff;
            font-family: 'Open Sans';
            font-size: 9px;
            font-weight: 700;
            float: right;
            height: 20px;
            width: 20px;
            line-height: 20px;
            text-align: center;
        }

        .user-area .dropdown-toggle {
            line-height: 55px;
            height: 55px;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
        }

        .user-area .dropdown-toggle:after {
            display: none;
        }
    </style>


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
                    <a href="dashboad.html.php" class="nav-link"><i class="d-none d-lg-block text-center fa fa-laptop" style="font-size: 20px"></i>Dashboard</a>
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
                <a class="nav-link" href="profile.php"><i class="fas fa-user"></i>Profile</a>

                    <a class="nav-link" href="change_password.php"><i class="fas fa-cog"></i>Password</a>

                    <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
                </div>
            </div>
        </div>
    </nav>


    <div class="container">
        <div class="row m-auto" style="max-width:500px">
            <!--ROW START-->
            <div class="col-lg-12">
                <div class="card mt-5">
                    <div class="card-header"><strong>Change Password</strong></div>
                    <div class="">
                        <div class="card-body card-block bg-gradient-info">
                            <form method="POST" action="" class="needs-validation" novalidate>
                                <div class="form-group">
                                    <div class="form-row">
                                        <input type="hidden" value="<?= $id ?>" name="id">
                                        <div class="col-lg-12 ">
                                            <label for="guest-name">Current Password</label>
                                            <input type="password" class="form-control" value="" name="password" placeholder="Current Password" autocomplete="off" required>
                                            <div class="invalid-tooltip">
                                                Please enter current password.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="form-row">
                                        <div class="col-lg-12">
                                            <label for="mobile">New Password</label>
                                            <input type="text" class="form-control" value="" name="new-pass" placeholder="New Password" autocomplete="off" required>
                                            <div class="invalid-tooltip">
                                                Please enter mobile number.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-lg-12">
                                            <label for="mobile">Confirm Password</label>
                                            <input type="text" class="form-control" value="" name="con-pass" placeholder="Confirm Password" autocomplete="off" required>
                                            <div class="invalid-tooltip">
                                                Please enter mobile number.
                                            </div>
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
    <footer class="text-center bg-light" style="position: fixed; height: 70px; bottom: 0; width: 100%;">
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
    <script src="assets/script/vendor/jquery-3.3.1.min.js"></script>
    <script src="assets/script/vendor/popper-1.14.7.min.js"></script>
    <script src="assets/script/vendor/bootstrap.min.js"></script>

    <script src="assets/script/vendor/jquery.matchHeight.min.js"></script>
    <script src="assets/script/main.js"></script>

</body>

</html>