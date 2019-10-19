<?php
include_once __DIR__ . '/includes/header.php';
$curr = $new = $conf = "";
$errors = array();

if (isset($_POST['submit'])) {
    $curr = $_POST['password'];
    $new = $_POST['new-pass'];
    $conf = $_POST['con-pass'];

    if (empty($curr)) $errors[] = "Enter current password";
    if (empty($new)) $errors[] = "Enter new password";
    if (empty($conf)) $errors[] = "Confirm new password";

    if ($new != $conf) $errors[] = "New and confirm password must match";

    if (empty($errors)) {
        $changed = $guestObj->changePassword($loggedGuestId, $curr, $new);
        if ($changed) {
            toast('success', 'Password changed successfully');
            $curr = $new = $conf = "";
        } else {
            toast('fail', 'Something went wrong, might be current password did not match');
        }
    }
}
?>
<div class="container mb-5">
    <div class="row m-auto" style="max-width:500px">
        <!--ROW START-->
        <div class="col-lg-12">
            <div class="card mb-5 mt-5 mt-lg-5">
                <div class="card-header text-center bg-white">
                    <span class="d-block font-weight-bold text-uppercase">Change Password Form</span>
                </div>
                <div class="card-body card-block ">
                    <form method="POST" action="">
                        <div class="text-center">
                            <?php
                            foreach ($errors as $error) : ?>
                                <p class="text-danger bg-dark"><?= $error ?></p>
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
                            <button id="submit" type="submit" name="submit" class="btn btn-dark btn-sm btn-block">SAVE</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once __DIR__ . '/includes/footer.php' ?>