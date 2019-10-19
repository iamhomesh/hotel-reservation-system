<?php
include_once __DIR__ . '/includes/head.php';
include_once __DIR__ . '/includes/left_panel.php';
include_once __DIR__ . '/includes/header.php';


require_once __DIR__ . '../../classes/Booking.php';
$bookingObj = new Booking();
require_once __DIR__ . '../../classes/Bill.php';
$billObj = new Bill();
require_once __DIR__ . '../../classes/Room.php';
$roomObj = new Room();
$success = "";
if (isset($_POST['check_out']) && isset($_POST['booking_id'])) {

    $fields = [
        'id' => $_POST['booking_id'],
        'room_id' => $_POST['room_id']
    ];
    $checkOut = $bookingObj->checkOut($fields);
    if ($checkOut) {
        $success = "Checked-Out successfully";
    }
}
?>


<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="page-header">
            <div class="page-title float-right">
                <ol class="breadcrumb text-right">
                    <li class="breadcrumb-item"><a href="bookings.php">Bookings</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="bookings.php">View</a></li>
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
        ?>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header text-center">
                        <strong>VIEW BOOKINGS</strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 overflow-auto">
                                <table class="table table-sm data-table">
                                    <thead class="">
                                        <tr>
                                            <th>#</th>
                                            <th>GUEST NAME</th>
                                            <th>ROOM #</th>
                                            <th>CHECK-IN</th>
                                            <th>CHECK-OUT</th>
                                            <th>STAYING</th>
                                            <th class="text-right">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $bookings = $bookingObj->getAll();
                                        $count = 0;
                                        foreach ($bookings as $booking) :
                                            ?>
                                            <tr>
                                                <td><?= ++$count ?></td>
                                                <td><?= $guestObj->getName($booking['guest_id']) ?></td>
                                                <td><?= $roomObj->getRoomNo($booking['room_id']) ?></td>
                                                <td><?= $booking['check_in'] ?></td>
                                                <td><?= date('d-m-Y', strtotime($booking['check_out'])) ?></td>
                                                <td><?= $booking['staying'] ?></td>
                                                <td class="text-right">
                                                    <?php if (!$billObj->billBookingStatus($booking['id'])) : ?>
                                                        <a href="create_bill.php?booking=<?= $booking['id'] ?>" class="badge badge-success" data-tooltip="tooltip" data-placement="top" title="Create bill"><i class="fas fa-file-invoice"></i></a>
                                                    <?php endif; ?>
                                                    <?php if ($booking['staying'] == 1) : ?>
                                                        <form action="" method="post" class="d-inline">
                                                            <input type="hidden" name="booking_id" value="<?= $booking['id'] ?>">
                                                            <input type="hidden" name="room_id" value="<?= $booking['room_id'] ?>">
                                                            <button class="badge badge-danger border-0" name="check_out" type="submit" data-tooltip="tooltip" data-placement="top" title="Check-Out"><i class="fas fa-check"></i></button>
                                                        </form>
                                                    <?php endif ?>
                                                </td>
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
<?php include_once __DIR__ . '/includes/footer.php'; ?>