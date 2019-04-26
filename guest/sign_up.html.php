<?php
include_once __DIR__.'/includes/header.php';
?>


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
                echo $logged ? header("location:dashboard.html.php") : "<script>alert('Username and password did not match.')</script>";

            endif; // $if not empty $errors
        endif; // isset $_POST

        ?>


            <div class="card" style="background-color: rgba(245, 245, 235, .5); width:300px">

                <div class="card-header text-center"><strong>Register</strong>

                </div>
                <div class="card-body card-block">

                    <form method="POST" action="" class="needs-validation" novalidate>
                        <div class="form-row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="guest-name">Full Name</label>
                                    <input type="password" class="form-control" value="" name="password" placeholder="Current Password" autocomplete="off" required>
                                    <div class="invalid-tooltip">
                                        Please enter current password.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="guest-name">Full Name</label>
                                    <input type="password" class="form-control" value="" name="password" placeholder="Current Password" autocomplete="off" required>
                                    <div class="invalid-tooltip">
                                        Please enter current password.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="guest-name">Full Name</label>
                                    <input type="password" class="form-control" value="" name="password" placeholder="Current Password" autocomplete="off" required>
                                    <div class="invalid-tooltip">
                                        Please enter current password.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="guest-name">Password</label>
                                    <input type="password" class="form-control" value="" name="password" placeholder="Current Password" autocomplete="off" required>
                                    <div class="invalid-tooltip">
                                        Please enter current password.
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <button id="submit" type="submit" name="submit" class="btn btn-danger btn-block btn-sm"><strong>Submit</strong></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <span>Have an account? <a class="rounded font-weight-bold badge badge-warning" href="index.php">
                            <span class="text-dark text-uppercase">Regisetr</span> </a> </span>

                </div>


            </div>

        </div>
    </div>

    <?php include_once __DIR__.'/includes/footer.html.php'; ?>