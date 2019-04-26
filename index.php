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
require_once 'config.php';

if(isset($_POST['login'])) {
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
    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <!--Font Awesome-->
    <link rel="stylesheet" href="assets/all.min.css">
    <!--Personal Style sheet -->
    <link rel="stylesheet" type="text/css" media="screen" href="assets/style.css" />
</head>

<body>
    <div class="container">
        <div id="lgn-content">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="needs-validation"
                novalidate>
                <div id="lgn-div-username" class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" name="username" class="form-control" placeholder="username" autocomplete="off"
                        required />
                </div>
                <div id="lgn-div-password" class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
                    <input type="password" name="password" class="form-control" placeholder="password" required />
                </div>
                <div id="lgn-div-btn" class="text-right mt-4">
                    <div class="btn">
                        <a href="" class="" style="color:red">Forgot password?</a>
                    </div>
                    <button type="submit" name="login" class="btn btn-success"><i class="fas fa-sign-in-alt"></i>
                        Login</button>
                </div>
            </form>
        </div>
    </div>

    <!--Bootstrap-->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="assets/jquery-3.3.1.js"></script>
    <script src="assets/popper.js"></script>
    <script src="assets/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>