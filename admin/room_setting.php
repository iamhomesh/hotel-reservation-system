<?php
include_once __DIR__ . '/includes/head.php';
include_once __DIR__ . '/includes/left_panel.php';
include_once __DIR__ . '/includes/header.php';

require_once __DIR__ . '../../classes/Room.php';
$roomObj = new Room();
$add_room_type_id = $add_room_no = "";
if (isset($_POST['add-button'])) {

    $add_room_type_id = $_POST['add-room-type'];
    $add_room_no = $_POST['add-room-number'];

    if (empty($add_room_type_id)) $errors[] = 'Please enter room number.';
    if (empty($add_room_no)) $errors[] = 'Please select room type.';
    
    if (empty($errors)) {
        $fields = [
            'room_no' => $add_room_no,
            'type_id' => $add_room_type_id
        ];
        $added = $roomObj->add($fields);
        if ($added) {
            $success = "Room added successfully";
            $add_room_type_id = $add_room_no = "";
        }
    }
}

if (isset($_POST['update-button'])) {

    $room_type = $_POST['update-room-type'];
    $room_no = $_POST['update-room-number'];
    $room_id = $_POST['room_id'];

    if (empty($room_no)) $errors[] = 'Please enter room number.';
    if (empty($room_type)) $errors[] = 'Please select room type.';
    
    if (empty($errors)) {
        $fields = [
            'room_no' => $room_no,
            'type_id' => $room_type
        ];
        $updated = $roomObj->update($room_id, $fields);
        if ($updated) {
            $success = "Room updated successfully";
        }
    }
}
$room_type = $room_no = $room_id = "";
if (isset($_GET['room_id'])) {
    $room = $roomObj->getRoom($_GET['room_id']);
    $room_type = $room['type_id'];
    $room_no = $room['room_no'];
    $room_id = $room['id'];
}

?>
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="page-header">
            <div class="page-title float-right">
                <ol class="breadcrumb text-right">
                    <li class="breadcrumb-item">Settings</li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="room_setting.php">Room</a></li>
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
            <div class="col-md-12 col-sm-12 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Add Room</strong>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="add-room-type">Room Type</label>
                                    <select name="add-room-type" class="custom-select">
                                        <option value="">Select Type</option>
                                        <?php
                                        $roomTypes = $roomTypeObj->getAll();
                                        foreach ($roomTypes as $roomType) : ?>
                                            <?php if ($add_room_type_id == $roomType['id']) : ?>
                                                <option value="<?= $roomType['id'] ?>" selected><?= $roomType['name'] ?></option>
                                            <?php else : ?>
                                                <option value="<?= $roomType['id'] ?>"><?= $roomType['name'] ?></option>
                                        <?php endif;
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-12">
                                    <label for="add-room-number">Room # <span id="add-room-exists" class="text-danger text-uppercase"></span></label>
                                    <input type="text" maxlength="4" name="add-room-number" id="add-room-no" class="form-control" value="<?= $add_room_no ?>" placeholder="Room Number">
                                </div>
                            </div>
                            <button type="submit" name="add-button" id="add-button" class="btn btn-success btn-block">Add</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Edit Room</strong>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="form-row">
                            <input type="hidden" name="room_id" id="room-id" value="<?= $room_id ?>">
                                <div class="form-group col-12">
                                    <label for="update-room-tpe">Room Type</label>
                                    <select name="update-room-type" class="custom-select">
                                        <option value="">Select Type</option>
                                        <?php
                                        $roomTypes = $roomTypeObj->getAll();
                                        foreach ($roomTypes as $roomType) :
                                            if ($room_type == $roomType['id']) : ?>
                                                <option value="<?= $roomType['id'] ?>" selected><?= $roomType['name'] ?></option>
                                            <?php else : ?>
                                                <option value="<?= $roomType['id'] ?>"><?= $roomType['name'] ?></option>
                                        <?php endif;
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-12">
                                    <label for="update-room-number">Room # <span id="update-room-exists" class="text-danger text-uppercase"></span></label>
                                    <input type="text" maxlength="4" name="update-room-number" id="update-room-no" value="<?= $room_no ?>" class="form-control" placeholder="Room Number">
                                </div>
                            </div>
                            <button type="submit" name="update-button" id="update-button" class="btn btn-danger btn-block">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <strong>Rooms</strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 overflow-auto">
                                <table class="table table-sm data-table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Room#</th>
                                            <th>Type</th>
                                            <th>Availability</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        foreach ($roomObj->getAll() as $room) : ?>
                                            <tr>
                                                <td><?= $count++ ?></td>
                                                <td><?= $room['room_no'] ?></td>
                                                <td><?= $roomTypeObj->getRoomTypeName($room['type_id']) ?></td>
                                                <td class="text-uppercase"><?= $room['available'] ?></td>
                                                <td><a class="badge badge-dark" href="?room_id=<?= $room['id'] ?>">EDIT</a></td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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