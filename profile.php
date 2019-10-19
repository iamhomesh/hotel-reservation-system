<?php
include_once __DIR__ . '/includes/header.php';

$id = $email = $mobile = $id_card = $city = $state_id = $pin_code = $address = "";
//Fetch data from database and assign to the variables
// $guest = $guestObj->getGuest($loggedGuestId); //Fetching data
$mobile = $loggedGuest['mobile'];
$email = $loggedGuest['email'];
$id_card = $loggedGuest['id_card'];
$city = $loggedGuest['city'];
$state_id = $loggedGuest['state_id'];
$pin_code = $loggedGuest['pin_code'];
$address = $loggedGuest['address'];
$errors = [];
if (isset($_POST['submit'])) {
    $name = ucwords(strtolower($_POST['name']));
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $id_card = $_POST['id-card'];
    $city = $_POST['city'];
    $state_id = $_POST['state'];
    $pin_code = $_POST['pin-code'];
    $address = $_POST['address'];

    $fields = array(
        'name' => $name,
        'mobile' => $mobile,
        'email' => $email,
        'id_card' => $id_card,
        'pin_code' => $pin_code,
        'address' => $address,
        'city' => $city,
        'state_id' => $state_id
    );
    if ($guestObj->checkEmail($email, $loggedGuestId)) $errors[] = "Email already exists";
    if ($guestObj->checkMobile($mobile, $loggedGuestId)) $errors[] = "Mobile number already exists.";
    if (empty($errors)) {
        $update = $guestObj->update($loggedGuestId, $fields);
        if ($update) {
            toast('success', 'Profile updated successfully');
        } else {
            toast('fail', 'Something went wrong');
        }
    }
}
?>
<div class="container mb-5">
    <div class="row m-auto" style="">
        <!--ROW START-->
        <div class="col-lg-12 overflow-auto" style="max-height: 590px">
            <div class="card mt-3 mt-lg-5 mb-5">
                <div class="card-header text-center bg-white">
                    <span class="d-block font-weight-bold text-uppercase">Profile</span>
                </div>
                <div class="card-body card-block ">
                    <?php if (!empty($errors)) :
                        foreach ($errors as $error) : ?>
                            <p class="text-danger text-center bg-dark"><?= $error ?></p>
                    <?php endforeach;
                    endif; ?>
                    <form method="POST" action="">
                        <div class="form-row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" value="<?= $name ?? "" ?>" name="name" placeholder="Name" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" value="<?= $email ?? "" ?>" name="email" placeholder="Email" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="mobile">Mobile</label>
                                    <input type="tel" class="form-control" value="<?= $mobile ?? "" ?>" name="mobile" placeholder="Mobile Number" />
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="id-card">ID Card</label>
                                    <input type="text" class="form-control" value="<?= $id_card ?? "" ?>" name="id-card" placeholder="ID Card" />
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control" value="<?= $city ?? "" ?>" name="city" placeholder="City" />
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <select name="state" class="form-control">
                                        <?php
                                        include_once __DIR__ . '/classes/State.php';
                                        $stateObj = new State();
                                        $states = $stateObj->getAllStates(); ?>
                                        <option value="">Select state</option>
                                        <?php
                                        foreach ($states as $state) :
                                            if ($state['id'] == $state_id) : ?>
                                                <option value="<?= $state['id'] ?>" selected><?= $state['name'] ?></option>
                                            <?php else : ?>
                                                <option value="<?= $state['id'] ?>"><?= $state['name'] ?></option>
                                        <?php
                                            endif;
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="pin-code">Pin Code</label>
                                    <input type="text" class="form-control" value="<?= $pin_code ?? "" ?>" name="pin-code" placeholder="Pin Code" />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea name="address" id="" class="form-control"><?= $address ?? "" ?></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button name="submit" class="btn btn-dark btn-block btn-sm">SAVE</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once __DIR__ . '/includes/footer.php' ?>