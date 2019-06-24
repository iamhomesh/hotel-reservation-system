<?php
include_once __DIR__ . '../includes/header.php';

$id = $fullname = $email = $mobile = $id_card = $city = $state_id = $pin_code = $address = "";

//Fetch data from database and assign to the variables
$row = $guest->fetchData($guest_id); //Fetching data
$mobile = $row['mobile'];
$email = $row['email'];
$id_card = $row['id_card'];
$city = $row['city'];
$state_id = $row['state_id'];
$pin_code = $row['pin_code'];
$address = $row['address'];





if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $id_card = $_POST['id-card'];
    $city = $_POST['city'];   
    $state_id = $_POST['state'];
    $pin_code = $_POST['pin-code'];
    $address = $_POST['address'];


    $fields = array(
        'name' => $_POST['name'],
        'mobile' => $_POST['mobile'],
        'email' => $_POST['email'],
        'id_card' => $_POST['id-card'],
        'pin_code' => $_POST['pin-code'],
        'address' => $_POST['address'],
        'city' => $_POST['city'],
        'state_id' => $_POST['state']
    );


    $update = $guest->update($guest_id, $fields);
    if ($update) echo "<script>alert('Data updated successfully')</script>";
    else echo "<script>alert('Data not updated successfully')</script>";
}


?>


<div class="container">
    <div class="row m-auto" style="">
        <!--ROW START-->
        <div class="col-lg-12 overflow-auto" style="max-height: 590px">

            <div class="card mt-5 mt-lg-5">
                <div class="card-header"><strong>Profile</strong></div>
                <div class="">

                    <div class="card-body card-block ">
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
                                        <select name="state" class="form-control" required>

                                            <?php
                                            include_once __DIR__ . '../../classes/State.php';

                                            $state = new State();
                                            $rows = $state->fetchAllState(); ?>
                                            <option value="">Select state</option>

                                            <?php

                                            foreach ($rows as $row) : ?>

                                                <?php
                                                if ($row['state_id'] == $state_id) : ?>

                                                    <option value="<?= $row['state_id'] ?>" class="text-danger" selected><?= $row['state_name'] ?></option>
                                                <?php else : ?>
                                                    <option value="<?= $row['state_id'] ?>"><?= $row['state_name'] ?></option>

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
                                    <button name="submit" class="btn btn-danger btn-block btn-sm">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>


            </div>
        </div>
    </div>

</div>

<?php include_once __DIR__ . '../includes/footer.php' ?>