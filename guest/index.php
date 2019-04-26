<?php 

session_start();
if(isset($_SESSION['user'])) {
    header('location: home.php');
}


?>

<!DOCTYPE html>
<html lang="en">

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
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
</head>




<body class="" style="background-color: cyan">


    <div class="container">


        <div id="lgn-content">
            <?php
            include_once __DIR__ . '../../classes/Guest.php';


            $errors = array();
            $username = $password = "";
            if (isset($_POST['submit'])) :
                $username = $_POST['username'];
                $password = $_POST['password'];
                if (empty($username)) $errors[] = "You did not enter the username";
                if (empty($password)) $errors[] = "You did not enter the password";
                if (!empty($errors)) : ?>
                    <?php foreach ($errors as $error) : ?>
                        <p class="bg-dark text-danger text-center"><?= $error ?> </p>
                    <?php endforeach; ?>
                <?php else :
                $user = new Guest();
                $logged = $user->login($username, $password);
                $_SESSION['user'] = $logged[0];
                echo $logged ? header("location:home.php") : "<script>alert('Username and password did not match.')</script>";

            endif; // $if not empty $errors
        endif; // isset $_POST

        ?>


            <div class="card" style="background-color: rgba(245, 245, 235, .5); width:300px">

                <div class="card-header text-center"><strong>Guest</strong>

                </div>
                <div class="card-body card-block">

                    <form method="post" action="" class="needs-validation">
                        <div class="form-group">
                            <div class="form-row">
                                <div id="lgn-div-username" class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" name="username" value="<?= $username ?? "" ?>" class="form-control" placeholder="username" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div id="lgn-div-password" class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input type="password" name="password" value="<?= $password ?? "" ?>" class="form-control" placeholder="password" />
                                </div>
                            </div>
                        </div>

                        <div class="btn-group">
                            <a href="#" class="nav-link text-danger">Forgot password?</a>
                            <div class="">
                                <button type="submit" name="submit" class="btn btn-pink btn-sm"><i class="fas fa-sign-in-alt"></i> Login</button>
                            </div>




                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <span>Don't have an account? <a class="rounded font-weight-bold badge badge-warning" href="register.php">
                            <span class="text-dark text-uppercase">Register</span> </a> </span>

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