<?php

include_once __DIR__. '../includes/header.php';


$id = $curr = $new = $conf = "";
$errors = array();

if (isset($_POST['submit'])) {
    //change this session ID
    $id = $_SESSION['guest_id'];


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
                location = "home.php";
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

<?php include_once __DIR__.'../includes/footer.php' ?>