<?php
session_start();
if (isset($_SESSION['guest_id'])) {
    header('location: home.php');
}
include_once __DIR__ . '/includes/toast.php';
require_once __DIR__ . '/classes/Guest.php';
$errors = array();
$name = $email = $mobile = $password = "";
if (isset($_POST['submit'])) {
    $name = ucwords(strtolower($_POST['name']));
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    if (empty($name)) $errors[] = "Please enter your name";
    if (empty($email)) $errors[] = "Please enter your email";
    if (empty($mobile)) $errors[] = "Please enter your mobile number";
    if (empty($password)) $errors[] = "You did not enter the password";
    $guestObj = new Guest();
    if ($guestObj->checkEmail($email)) $errors[] = "Email already exists.";
    if ($guestObj->checkMobile($mobile)) $errors[] = "Mobile number already exists.";

    if (empty($errors)) {
        $register = $guestObj->register($name, $email, $mobile, $password);
        if ($register) {
            toast('success', 'You are registered successfully, please login.');
            header('refresh: 2; url= login.php');
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Hotel Resevation System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" integrity="sha256-+N4/V/SbAFiW1MPBCXnfnP9QSN3+Keu+NlB+0ev/YKQ=" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>

<body class="">
    <div class="container">
        <div class="min-vh-100 m-0 d-flex flex-column justify-content-center">
            <div class="card my-5 mx-auto">
                <div class="card-header text-center font-weight-bold">REGISTRATION FORM
                </div>
                <div class="card-body card-block">
                    <?php if (!empty($errors)) :
                        foreach ($errors as $error) : ?>
                            <p class="bg-dark text-danger text-center"><?= $error ?> </p>
                    <?php endforeach;
                    endif; ?>
                    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
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
                                    <input type="email" class="form-control" value="<?= $email ?? "" ?>" name="email" placeholder="Email" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="mobile">Mobile</label>
                                    <input type="tel" class="form-control" value="<?= $mobile ?? "" ?>" name="mobile" placeholder="Mobile" />
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
                    <span>Have an account?
                        <a class="rounded font-weight-bold badge badge-warning text-dark text-uppercase" href="login.php">
                            <span class="text-dark text-uppercase">Login </span>
                        </a>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix mt-5"></div>
    <footer class="text-center fixed-bottom bg-dark" style="height:70px">
        <div class="container">
            <div class="row mt-3 mt-lg-4">
                <div class="col-sm-6">
                    <span class="text-light">Copyright &copy; 2019
                        <a href="#" class="text-white font-weight-bold">Hotel Resevation System</a>
                    </span>
                </div>
                <div class="col-sm-6">
                    <span class="text-light">Designed by
                        <a href="https://www.linkedin.com/in/iamhomesh" class="text-white font-weight-bold">HOMESH KUMAR VERMA</a>
                    </span>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
        $().ready(function() {
            $('.toast').toast('show');
        });
    </script>
</body>

</html>