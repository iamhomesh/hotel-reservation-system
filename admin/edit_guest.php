<?php
include_once __DIR__ . '/includes/head.php';
include_once __DIR__ . '/includes/left_panel.php';
include_once __DIR__ . '/includes/header.php';

$errors = [];
$success = "";
$guest_id = $name = $email = $mobile = $id_card = $city = $state_id = $pincode = $address = "";
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $state_id = $_POST['state'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $city = $_POST['city'];
    $id_card = $_POST['id_card'];
    $pincode = $_POST['pincode'];
    $address = $_POST['address'];
    $guest_id = $_POST['guest_id'];

    if (empty($name)) $errors[] = 'Please enter full name.';
    if (empty($email)) $errors[] = 'Please enter email address.';
    if (empty($mobile)) $errors[] = 'Please enter mobile number.';
    if (empty($id_card)) $errors[] = 'Please enter id card number.';
    if (empty($city)) $errors[] = 'Please enter city.';
    if (empty($state_id)) $errors[] = 'Please select state.';
    if (empty($address)) $errors[] = 'Please enter address.';
    if (empty($pincode)) $errors[] = 'Please enter pin code.';
    
    $checkEmail = $guestObj->checkEmail($email, $guest_id);
    $checkMobile = $guestObj->checkMobile($mobile, $guest_id);
    if ($checkEmail) $errors[] = 'Email address already exists';
    if ($checkMobile) $errors[] = 'Mobile already exists';
    if (empty($errors)) {
        $fields = [
            'name' => ucwords(strtolower($name)),
            'email' => $email,
            'mobile' => $mobile,
            'id_card' => $id_card,
            'city' => $city,
            'state_id' => $state_id,
            'pin_code' => $pincode,
            'address' => $pincode,
        ];
        $updated = $guestObj->update($guest_id, $fields);
        if ($updated) {
            $success = "Guest data updated successfully";
        }
    }
}
if (isset($_GET['guest'])) {
    $guest_id = $_GET['guest'];
    $guest = $guestObj->getGuest($_GET['guest']);
    $name = $guest['name'];
    $email = $guest['email'];
    $mobile = $guest['mobile'];
    $id_card = $guest['id_card'];
    $city = $guest['city'];
    $state_id = $guest['state_id'];
    $pincode = $guest['pin_code'];
    $address = $guest['address'];
}
?>
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="page-header">
            <div class="page-title float-right">
                <ol class="breadcrumb text-right">
                    <li class="breadcrumb-item"><a href="guests.php">Guests</a></li>
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
                        <strong class="text-uppercase">EDIT GUEST DETAILS</strong>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="">
                            <div class="form-row">
                                <div class="col-lg-4">
                                    <input type="hidden" name="guest_id" value="<?= $guest_id ?>">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" maxlength="100" class="form-control" value="<?= $name ?? "" ?>" name="name" placeholder="Guest's Full Name" />

                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" maxlength="70" class="form-control" value="<?= $email ?? "" ?>" name="email" placeholder="Email" />

                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="mobile">Mobile</label>
                                        <input type="text" maxlength="13" class="form-control" value="<?= $mobile ?? "" ?>" name="mobile" placeholder="Mobile" />

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="id_card">ID Card</label>
                                        <input type="text" maxlength="15" class="form-control" value="<?= $id_card ?? "" ?>" name="id_card" placeholder="ID Card Number" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <input type="text" maxlength="100" class="form-control" value="<?= $city ?? "" ?>" name="city" placeholder="City" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="state">State</label>
                                        <select name="state" class="custom-select">
                                            <?php
                                            include __DIR__ . '../../classes/State.php';
                                            $stateObj = new State();
                                            $states = $stateObj->getAllStates();
                                            foreach ($states as $state) :
                                                if ($state_id == $state['id']) :
                                                    ?>
                                                    <option value="<?= $state['id'] ?>" selected><?= $state['name'] ?></option>
                                                <?php else : ?>
                                                    <option value="<?= $state['id'] ?>"><?= $state['name'] ?></option>
                                            <?php endif;
                                            endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="pincode">Pin Code</label>
                                        <input type="text" maxlength="10" class="form-control" value="<?= $pincode ?? "" ?>" name="pincode" placeholder="Pincode" />
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <textarea name="address" maxlength="200" class="form-control" rows="2"><?= $address ?></textarea>
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