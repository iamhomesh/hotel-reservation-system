<?php
include_once __DIR__ . '/includes/head.php';
include_once __DIR__ . '/includes/left_panel.php';
include_once __DIR__ . '/includes/header.php';

require_once __DIR__ . '../../classes/Room.php';
$roomObj = new Room();
require_once __DIR__ . '../../classes/Booking.php';
$bookingObj = new Booking();
$errors = [];
$success = "";
$rooms = $room_id = $guest_id = $adults = $children = $check_out = $reservation_id = "";
if (isset($_POST['submit'])) {
    $guest_id = $_POST['guest'];
    $check_out = $_POST['check-out'];
    $adults = $_POST['adults'];
    $children = $_POST['children'];
    $room_id = $_POST['room'];

    if (empty($guest_id)) $errors[] = 'Please select guest.';
    if (empty($room_id)) $errors[] = 'Please select room.';
    if (empty($check_out)) $errors[] = 'Please select check-out date.';
    if (empty($adults)) $errors[] = 'Please enter number of adults.';
    
    if (empty($errors)) {
        $fields = [
            'guest_id' => $guest_id,
            'room_id' => $room_id,
            'check_out' => $check_out,
            'adults' => $adults,
            'children' => $children
        ];
        $reservation_id = $_POST['reservation_id'];
        if (!empty($reservation_id)) {
            $checkIn = $bookingObj->checkIn($fields, $reservation_id);
            if ($checkIn) {
                $success = "Check-In successfull.";
            }
        } else {
            $chcekIn = $bookingObj->checkIn($fields);
            if ($chcekIn) {
                $success = "Check-In successfull.";
            }
        }
    }
}

if (isset($_GET['reservation'])) {
    $reservation_id = $_GET['reservation'];
    $reservation = $reservaionObj->getReservation($reservation_id);
    $guest_id = $reservation['guest_id'];
    $type_id = $reservation['room_type_id'];
    $check_out = $reservation['check_out'];
    $adults = $reservation['adults'];
    $children = $reservation['children'];
    $rooms = $roomObj->getAvailableByType($type_id);
} else if (isset($_GET['type'])) {
    $type_id = $_GET['type'];
    $rooms = $roomObj->getAvailableByType($type_id);
} else {
    $rooms = $roomObj->getAvailable();
}
?>
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="page-header">
            <div class="page-title float-right">
                <ol class="breadcrumb text-right">
                    <li class="breadcrumb-item"><a href="bookings.php">Bookings</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="book.php">Book</a></li>
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
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>Book Room</strong></div>
                    <div class="card-body card-block">
                        <div class="row">
                            <div class="col-lg-6">
                                <form action="" method="POST">
                                    <input type="hidden" name="reservation_id" value="<?= $reservation_id ?>">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="guest">Guest</label>
                                        </div>
                                        <?php
                                        if (!empty($guest_id)) : ?>
                                            <input type="hidden" name="guest" value="<?= $guest_id ?>">
                                            <select class="custom-select" disabled>
                                            <?php else : ?>
                                                <select class="custom-select" name="guest" id="guest">
                                                    <?php endif;
                                                    $guests = $guestObj->getAllGuests();
                                                    foreach ($guests as $guest) :
                                                        if ($guest_id == $guest['id']) : ?>
                                                        <option value="<?= $guest['id'] ?>" selected><?= $guest['name'] ?></option>
                                                    <?php else : ?>
                                                        <option value="<?= $guest['id'] ?>"><?= $guest['name'] ?></option>
                                                <?php endif;
                                                endforeach; ?>
                                                </select>
                                                <?php if (empty($reservation_id)) : ?>
                                                    <div class="input-group-append">
                                                        <a class="btn btn-dark" href="add_guest.php" data-tooltip="tooltip" data-placement="top" title="add new guest"><i class="fas fa-plus"></i></a>
                                                    </div>
                                                <?php endif; ?>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" class="form-control" value="<?= $room_id ?>" id="room" name="room" hidden>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-lg-4">
                                                <label for="check-out">Check-Out</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="check-out" value="<?= $check_out; ?>" name="check-out" placeholder="YYYY-MM-DD" readonly />

                                                    <div class="input-group-append">
                                                        <span class="input-group-text bg-light check-out-btn"><i class="far fa-calendar-alt"></i></span>
                                                    </div>

                                                </div>


                                            </div>
                                            <div class="col-lg-4">
                                                <label for="adults">Adults</label>
                                                <input type="number" class="form-control" value="<?= $adults; ?>" id="adults" name="adults">

                                            </div>
                                            <div class="col-lg-4">
                                                <label for="adults">Children</label>
                                                <input type="number" class="form-control" value="<?= $children; ?>" name="children">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-info btn-block" id="submit" name="submit">Book</button>
                                    </div>
                                </form>
                            </div>

                            <div class="col-lg-6">
                                <table class="table table-select">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Room#</th>
                                            <th>Book</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $count = 0;
                                        foreach ($rooms as $room) :
                                            ?>
                                            <tr>
                                                <td hidden><?= $room['id'] ?></td>
                                                <td><?= ++$count ?></td>
                                                <td class="room-no"><?= $room['room_no'] ?></td>
                                                <?php if ($room_id == $room['id']) : ?>
                                                    <td><a href='#' class='badge badge-dark select'>SELECTED</a></td>
                                                <?php else : ?>
                                                    <td><a href='#' class='badge badge-light select'>SELECT</a></td>
                                                <?php endif; ?>
                                            </tr>
                                        <?php endforeach; ?>
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
<?php include_once __DIR__ . '/includes/footer.php'; ?>