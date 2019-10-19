<?php
include_once __DIR__ . '/includes/head.php';
include_once __DIR__ . '/includes/left_panel.php';
include_once __DIR__ . '/includes/header.php';
$errors = [];
$success = "";
$password = $new_password = $confirm_password = "";
if (isset($_POST['submit'])) {

    $password = $_POST['password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($password)) $errors[] = 'Please enter current password.';
    if (empty($new_password)) $errors[] = 'Please enter new password.';
    if (empty($confirm_password)) $errors[] = 'Please confirm new password.';
    
    if ($new_password != $confirm_password) {
        $errors[] = "New password and confirm password must be same.";
        $new_password = $confirm_password = "";
    }
    if (empty($errors)) {
        $fields = [
            'id' => $loggedUserId,
            'current_password' => $_POST['password'],
            'new_password' => $_POST['new_password']
        ];
        $changed = $userObj->changePassword($fields);
        if($changed){
            $success = "Password changed successfully.";
            $password = $new_password = $confirm_password = "";
        }else{
            $errors[] = "Current password did not match.";
            $password = $new_password = $confirm_password = "";
        }
    }
}
?>

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="page-header">
            <div class="page-title float-right">
                <ol class="breadcrumb text-right">
                    <li class="breadcrumb-item"><a href="password.php">Password</a></li>
                </ol>
            </div>
        </div>
    </div>
</div>


<!-- Content -->
<div class="content mb-5">
    <!-- Animated -->
    <div class="animated fadeIn">
        <?php
        if (!empty($success)) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> <?= $success ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php endif;
            if (!empty($errors)) :
                foreach ($errors as $error) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> <?= $error ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
        <?php
            endforeach;
        endif;
        ?>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header text-center">
                        <strong class="text-uppercase">CHANGE PASSWORD</strong>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="">
                            <div class="form-row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="password">Current Password</label>
                                        <input type="password" class="form-control" value="<?= $password ?>" name="password" placeholder="Current password" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="new-password">New Password</label>
                                        <input type="password" class="form-control" value="<?= $new_password ?>" name="new_password" placeholder="New password" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="confirm-password">Confirm Password</label>
                                        <input type="text" class="form-control" value="<?= $confirm_password ?>" name="confirm_password" placeholder="Confirm new password" />
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <button name="submit" class="btn btn-danger btn-block btn-sm">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .animated -->
</div>
<!-- /.content -->
<?php include_once __DIR__ . '/includes/footer.php'; ?>