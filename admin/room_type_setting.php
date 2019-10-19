<?php
include_once __DIR__ . '/includes/head.php';
include_once __DIR__ . '/includes/left_panel.php';
include_once __DIR__ . '/includes/header.php';

$type_id = $type_name = $rate = $description = "";
$errors = [];
$success = "";
$add_name = $add_rate = $add_desc = "";
if (isset($_POST['add-button'])) {
    $add_name = $_POST['add-type'];
    $add_rate = $_POST['add-rate'];
    $add_desc = $_POST['add-desc'];
    if (empty($add_name)) $errors[] = "Please enter room type";
    if (empty($add_rate)) $errors[] = "Please enter rate.";
    if (strlen($add_desc) > 300) $errors[] = "Description length must not exceed 300 characters";
    
    if (empty($errors)) {
        if (!$_FILES['add-photo']['name']) {
            $fields = [
                'name' => $add_name,
                'rate' => $add_rate,
                'description' => $add_desc
            ];
            $added = $roomTypeObj->add($fields);
            if ($added) {
                $success = "Room type added successfully";
                $add_name = $add_rate = $add_desc = "";
            }
        } else {
            $temp_name = $_FILES['add-photo']['tmp_name'];
            $extension = $roomTypeObj->getExtension($_FILES, 'add-photo');
            if (!$extension) {
                $errors[] = "Only PNG, JPEG image allowed.";
            } else {
                $add_photo = 'images/rooms/' . str_replace(' ', '_', strtolower($_POST['add-type'])) . '.' . $extension;
                move_uploaded_file($temp_name, __DIR__ . "/../$add_photo");
                $fields = [
                    'name' => $add_name,
                    'rate' => $add_rate,
                    'description' => $add_desc,
                    'photo' => $add_photo
                ];
                $added = $roomTypeObj->add($fields);
                if ($added) {
                    $success = "Room type added successfully";
                    $add_name = $add_rate = $add_desc = "";
                }
            }
        }
    }
}
if (isset($_POST['update-button'])) {
    $type_name = $_POST['update-type'];
    $rate = $_POST['update-rate'];
    $description = $_POST['update-desc'];
    $type_id = $_POST['type-id'];
    if (empty($type_name)) $errors[] = "Please enter room type";
    if (empty($rate)) $errors[] = "Please enter rate.";
    if (strlen($description) > 300) $errors[] = "Description length must not exceed 300 characters";
    
    if (empty($errors)) {
        if (!$_FILES['update-photo']['name']) {
            $fields = [
                'name' => $type_name,
                'rate' => $rate,
                'description' => $description
            ];
            $updated = $roomTypeObj->update($type_id, $fields);
            if ($updated) {
                $success = "Room type updated successfully";
            }
        } else {
            $temp_name = $_FILES['update-photo']['tmp_name'];
            $extension = $roomTypeObj->getExtension($_FILES, 'update-photo');
            if (!$extension) {
                $errors[] = "Only PNG, JPEG image allowed.";
            } else {
                $update_photo = 'images/rooms/' . str_replace(' ', '_', strtolower($_POST['update-type'])) . '.' . $extension;
                move_uploaded_file($temp_name, __DIR__ . "/../$update_photo");
                $fields = [
                    'name' => $type_name,
                    'rate' => $rate,
                    'description' => $description,
                    'photo' => $update_photo
                ];
                $updated = $roomTypeObj->update($type_id, $fields);
                if ($updated) {
                    $success = "Room type updated successfully";
                }
            }
        }
    }
}
if (isset($_GET['type-id'])) {
    $roomType = $roomTypeObj->getRoomType($_GET['type-id']);
    $type_name = $roomType['name'];
    $rate = $roomType['rate'];
    $description = $roomType['description'];
    $type_id = $roomType['id'];
}
?>
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="page-header">
            <div class="page-title float-right">
                <ol class="breadcrumb text-right">
                    <li class="breadcrumb-item">Settings</li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="room_type_setting.php">Room Type</a></li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Content -->
<div class="content mb-5">
    <!-- Animated -->
    <div class="animated fadeIn">
        <?php if (!empty($success)) : ?>
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

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header"><strong>Add Room Type</strong></div>
                    <div class="card-body card-block">
                        <form method="POST" action="" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-lg-12">
                                        <label for="add-type">Room Type* <span class="text-danger text-uppercase" id="add-exists"></span></label>
                                        <input type="text" maxlength="100" class="form-control" name="add-type" id="add-type" value="<?= $add_name ?>" placeholder="Room Type">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-lg-12">
                                        <label for="room-rate">Rate*</label>
                                        <input type="number" class="form-control" name="add-rate" placeholder="Room Rate" value="<?= $add_rate ?>" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-lg-12">
                                        <label for="photo">Photo</label>
                                        <div class="input-group mb-3">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" value="<?= $add_photo ?>" name="add-photo">
                                                <label class="custom-file-label" for="add-photo">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-lg-12">
                                        <label for="room-desc" class="">Description</label>
                                        <textarea class="form-control" maxlength="300" name="add-desc" id="room-desc" placeholder="Room Description"><?= $add_desc ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button id="add-button" type="submit" name="add-button" class="btn btn-success btn-block"><strong>Add</strong></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header"><strong>Edit Room Type</strong></div>
                    <div class="card-body card-block">
                        <form method="POST" action="" enctype="multipart/form-data">
                            <input type="hidden" name="type-id" id="update-type-id" value="<?= $type_id ?>">
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-lg-12">
                                        <label for="edit-type">Room Type* <span class="text-danger text-uppercase" id="update-exists"></span></label>
                                        <input type="text" maxlength="100" class="form-control" name="update-type" id="update-type" placeholder="Room Type" value="<?= $type_name ?>" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-lg-12">
                                        <label for="room-rate" class="">Rate*</label>
                                        <input type="number" class="form-control" name="update-rate" id="room-rate" placeholder="Room Rate" value="<?= $rate ?>" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-lg-12">
                                        <label for="photo">Photo</label>
                                        <div class="input-group mb-3">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="update-photo">
                                                <label class="custom-file-label" for="update-photo">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-lg-12">
                                        <label for="update-desc" class="">Description</label>
                                        <textarea class="form-control" maxlength="300" name="update-desc" placeholder="Room Description"><?= $description ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button id="update-button" type="submit" name="update-button" class="btn btn-danger btn-block"><strong>Update</strong></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>Room Types</strong>
                    </div>
                    <div class="card-body card-block">
                        <table class="table data-table table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Type</th>
                                    <th>Rate</th>
                                    <th>Desc</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $roomTypes = $roomTypeObj->getAll();
                                $count = 0;
                                foreach ($roomTypes as $roomType) : ?>
                                    <tr>
                                        <td><?= ++$count ?></td>
                                        <td><?= $roomType['name'] ?></td>
                                        <td><?= $roomType['rate'] ?></td>
                                        <td><?= $roomType['description'] ?></td>
                                        <td><a href="?type-id=<?= $roomType['id'] ?>" class="badge badge-dark">EDIT</a></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .animated -->
</div>
<!-- /.content -->

<?php include_once __DIR__ . '/includes/footer.php'; ?>