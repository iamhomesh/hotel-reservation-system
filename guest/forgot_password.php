<?php

session_start();
if (isset($_SESSION['guest_id'])) {
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

    <script src="../assets/js/jquery-3.3.1.min.js"></script>
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
                if (empty($username)) $errors[] = "Please enter username(email)";
                if (!empty($errors)) : ?>
                    <?php foreach ($errors as $error) : ?>
                        <p class="bg-dark text-danger text-center"><?= $error ?> </p>
                    <?php endforeach; ?>
                <?php else :
                    $guest = new Guest();
                    $email = $guest->checkEmail($username);
                    if (!$email) :
                        $errors[] = "You are not registered with us.";
                        foreach ($errors as $error) : ?>
                            <p class="bg-dark text-danger text-center"><?= $error ?> </p>
                        <?php endforeach;
                    else :
                        $success = $guest->passwordReset($username);
                        if ($success) : ?>
                            <div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center">
                                <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
                                    <div class="toast-header">
                                        <i class="fas fa-check text-success"></i>&nbsp;
                                        <strong class="mr-auto text-success">Success</strong>
                                        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="toast-body">
                                        Password reset request has been sent successfully you'll be notified soon.
                                    </div>
                                </div>
                            </div>
                            <script>
                                $().ready(function() {
                                    $('.toast').toast('show');
                                })
                            </script>

                        <?php else :
                        endif;
                    endif;

                //$logged = $guest->login($username, $password);
                //$_SESSION['guest_id'] = $logged;
                //echo $logged ? header("location:home.php") : "<script>alert('Username and password did not match.')</script>";

                endif; // $if not empty $errors
            endif; // isset $_POST

            ?>


            <div class="card" style="background-color: rgba(245, 245, 235, .5); width:300px">

                <div class="card-header text-center"><strong>Forgot Password</strong>

                </div>
                <div class="card-body card-block">
                    <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" class="needs-validation">
                        <div class="form-group">
                            <div class="form-row">
                                <div id="lgn-div-username" class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user text-dark"></i></span>
                                    </div>
                                    <input type="text" name="username" value="<?= $username ?? "" ?>" class="form-control" placeholder="username" />
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" name="submit" class="btn btn-elegant btn-sm">Submit</button>
                        </div>

                    </form>
                </div>
                <div class="card-footer text-center">
                    <a class="rounded font-weight-bold badge badge-warning" href="index.php">
                        <span class="text-dark text-uppercase">Login</span>
                    </a>

                    <a class="rounded font-weight-bold badge badge-warning" href="register.php">
                        <span class="text-dark text-uppercase">Register</a>

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