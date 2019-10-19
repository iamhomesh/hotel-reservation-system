<?php
include_once __DIR__ . '/includes/head.php';
if (!$isAdmin) header('location:index.php');
include_once __DIR__ . '/includes/left_panel.php';
include_once __DIR__ . '/includes/header.php';

$user_id = $username = $name = $mobile = $email = "";
$errors = [];
$success = "";
if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $user_id = $_POST['user_id'];

    if (empty($username)) $errors[] = 'Please enter username.';
    if (empty($name)) $errors[] = 'Please enter full name.';
    if (empty($mobile)) $errors[] = 'Please enter mobile number.';
    if (empty($email)) $errors[] = 'Please select email id.';
    
    $checkUsername = $userObj->checkUsername($username, $user_id);
    $checkMobile = $userObj->checkMobile($mobile, $user_id);
    $checkEmail = $userObj->checkEmail($email, $user_id);

    if ($checkUsername) $errors[] = 'Username already exists.';
    if ($checkMobile) $errors[] = 'Mobile number already exists.';
    if ($checkEmail) $errors[] = 'Email address already exists.';

    if (empty($errors)) {
        $fields = [
            'username' => trim(strtolower($username)),
            'name' => ucwords(strtolower($name)),
            'email' => $email,
            'mobile' => $mobile
        ];
        $updated = $userObj->update($user_id, $fields);
        if ($updated) {
            $success = "User data updated successfully";
        }
    }
}
if (isset($_GET['user'])) {
    $user_id = $_GET['user'];
    $user = $userObj->getUser($user_id);
    $username = $user['username'];
    $name = $user['name'];
    $mobile = $user['mobile'];
    $email = $user['email'];
}
?>



<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="page-header">
            <div class="page-title float-right">
                <ol class="breadcrumb text-right">
                    <li class="breadcrumb-item"><a href="users.php">Users</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
                        <strong class="text-uppercase">EDIT USER DETAILS</strong>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="">
                            <div class="form-row">
                                <input type="hidden" name="user_id" value="<?= $user_id ?>" />
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" maxlength="20" class="form-control" value="<?= $username ?? "" ?>" name="username" placeholder="Username" />
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label for="full-name">Full Name</label>
                                        <input type="text" maxlength="100" class="form-control" value="<?= $name ?? "" ?>" name="name" placeholder="Full Name" />

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" maxlength="70" class="form-control" value="<?= $email ?? "" ?>" name="email" placeholder="Email" />

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="mobile">Mobile</label>
                                        <input type="tel" maxlength="13" class="form-control" value="<?= $mobile ?? "" ?>" name="mobile" placeholder="Mobile Number" />

                                    </div>
                                </div>



                                <div class="col-lg-12">
                                    <button name="submit" class="btn btn-danger btn-block btn-sm">Update</button>
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
<?php
include_once __DIR__ . '/includes/footer.php';
?>