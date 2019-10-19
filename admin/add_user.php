<?php
include_once __DIR__ . '/includes/head.php';
if (!$isAdmin) header('location:index.php');
include_once __DIR__ . '/includes/left_panel.php';
include_once __DIR__ . '/includes/header.php';

$username = $name = $mobile = $email = "";
$errors = [];
$success = "";
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];

    if (empty($username)) $errors[] = 'Please enter username.';
    if (empty($name)) $errors[] = 'Please enter full name.';
    if (empty($mobile)) $errors[] = 'Please enter mobile number.';
    if (empty($email)) $errors[] = 'Please select email id.';

    $checkUsername = $userObj->checkUsername($username);
    $checkMobile = $userObj->checkMobile($mobile);
    $checkEmail = $userObj->checkEmail($email);

    if ($checkUsername) $errors[] = 'Username already exists.';
    if ($checkMobile) $errors[] = 'Mobile number already exists.';
    if ($checkEmail) $errors[] = 'Email address already exists.';
    if (empty($errors)) {
        $fields = [
            'username' => trim(strtolower($username)),
            'name' => ucwords(strtolower($name)),
            'mobile' => $mobile,
            'email' => $email
        ];
        $added = $userObj->add($fields);
        if ($added) {
            $success = "User added successfully";
            $username = $name = $mobile = $email = "";
        }
    }
}
?>
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="page-header">
            <div class="page-title float-right">
                <ol class="breadcrumb text-right">
                    <li class="breadcrumb-item"><a href="users.php">Users</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="add_user.php">Add</a></li>
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
                        <strong class="text-uppercase">ADD USER</strong>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <span id="user-error" class="badge badge-danger"></span>
                        </div>
                        <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                            <div class="form-row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" maxlength="20" class="form-control" id="username" value="<?= $username ?? "" ?>" name="username" placeholder="Username" />
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label for="name">Full Name</label>
                                        <input type="text" maxlength="100" class="form-control" value="<?= $name ?? "" ?>" name="name" placeholder="Full Name" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" maxlength="70" class="form-control" id="email" value="<?= $email ?? "" ?>" name="email" placeholder="Email" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="mobile">Mobile</label>
                                        <input type="tel" maxlength="13" class="form-control" id="mobile" value="<?= $mobile ?? "" ?>" name="mobile" placeholder="Mobile Number" />
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <button name="submit" class="btn btn-info btn-block btn-sm">Add</button>
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

<script>

</script>
<?php include_once __DIR__ . '/includes/footer.php'; ?>