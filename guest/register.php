<!DOCTYPE html>
<html lang="en">

<?php
session_start();

if(isset($_SESSION['user'])) {
    header('location: home.php');
}

?>
<head>
<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Hotel Resevation System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <!--MDB Bootstrap Material Design-->
    <link rel="stylesheet" href="../assets/MDB-Free_4.7.7/css/mdb.min.css">
    <!--Font Awesome-->
    <link rel="stylesheet" href="../assets/fontawesome-free-5.8.1-web/css/all.min.css">
    <!--Personal Style sheet -->
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/custom/style.css" />
</head>

<body class="" style="background-color: cyan">


    <div class="container">


        <div id="lgn-content">
            <?php
            include_once __DIR__ . '../../classes/Guest.php';


            $errors = array();
            $name = $email = $mobile = $password = "";
            if (isset($_POST['submit'])) :
                $name = $_POST['name'];
                $email = $_POST['email'];
                $mobile = $_POST['mobile'];
                $password = $_POST['password'];
                if (empty($name)) $errors[] = "Please enter your name";
                if (empty($email)) $errors[] = "Please enter your email";
                if (empty($mobile)) $errors[] = "Please enter your mobile number";
                if (empty($password)) $errors[] = "You did not enter the password";

                $user = new Guest();
                if (!empty($user->checkEmail($email))) $errors[] = "Email already exists.";
                if (!empty($user->checkMobile($mobile))) $errors[] = "Mobile number already exists.";

                if (!empty($errors)) : ?>
                    <?php foreach ($errors as $error) : ?>
                        <p class="bg-dark text-danger text-center"><?= $error ?> </p>
                    <?php endforeach; ?>
            <?php else:
                echo $user->register($name, $email, $mobile, $password) ? header('location: home.html.php') : '<script>alert("TT")</script>';

            endif; // $if not empty $errors
        endif; // isset $_POST

        ?>


            <div class="card" style="background-color: rgba(245, 245, 235, .5); width:300px">

                <div class="card-header text-center"><strong>Register</strong>

                </div>
                <div class="card-body card-block">

                    <form method="POST" action="">
                        <div class="form-row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" value="<?= $name ?? "" ?>" name="name" placeholder="Full Name" />

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" value="<?= $email ?? "" ?>" name="email" placeholder="example@example.com" />

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="mobile">Mobile</label>
                                    <input type="tel" class="form-control" value="<?= $mobile ?? "" ?>" name="mobile" placeholder="11234567890" />

                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" value="<?= $password ?? "" ?>" name="password" placeholder="Password" />

                                </div>
                            </div>

                            <div class="col-lg-12">
                                <button name="submit" class="btn btn-danger btn-block btn-sm"><strong>Sign Up</strong></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <span>Have an account? <a class="rounded font-weight-bold badge badge-warning" href="index.php">
                            <span class="text-dark text-uppercase">Login</span> </a> </span>

                </div>


            </div>

        </div>
    </div>

    <div class="clearfix"></div>
    <footer class="text-center fixed-bottom" style="height: 70px; background-color: teal">
        <div class="container">
            <div class="row mt-3 mt-lg-4">
                <div class="col-sm-6">
                    <span class="text-light">Copyright &copy; 2019 <a href="#" class="text-white font-weight-bold">Hotel
                            Resevation System</a></span>
                </div>
                <div class="col-sm-6">
                    <span class="text-light">Designed by <a href="" class="text-white font-weight-bold">HOMESH KUMAR
                            VERMA</a></span>
                </div>
            </div>
        </div>
    </footer>

    <!--Bootstrap-->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../assets/js/jquery-3.3.1.min.js"></script>
    <script src="../assets/js/popper-1.14.7.min.js"></script>
    <script src="../assets/js/bootstrap.js"></script>
    <script src="../assets/MDB-Free_4.7.7/js/mdb.min.js"></script>
    <script src="../assets/js/custom/javascript.js"></script>
</body>

</html>