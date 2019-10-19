<?php
include_once __DIR__ . '/includes/head.php';
include_once __DIR__ . '/includes/left_panel.php';
include_once __DIR__ . '/includes/header.php';

$success = "";
if (isset($_POST['confirm']) && !empty($_POST['reservation_id'])) {
    $confirm = $reservaionObj->confirm($_POST['reservation_id']);
    if ($confirm) {
        $success = "Reservation confirmed.";
    }
}
if (isset($_POST['cancel']) && !empty($_POST['reservation_id'])) {
    $cancel = $reservaionObj->cancel($_POST['reservation_id']);
    if ($cancel) {
        $success = "Reservation cancelled.";
    }
}
?>



<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="page-header">
            <div class="page-title float-right">
                <ol class="breadcrumb text-right">
                    <li class="breadcrumb-item"><a href="reservations.php">Reservations</a></li>
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
        <?php endif; ?>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header text-center">
                        <strong>VEIW RESERVATIONS</strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 overflow-auto">
                                <table class="table table-sm data-table">
                                    <thead class="">
                                        <tr>
                                            <th>#</th>
                                            <th>GUEST NAME</th>
                                            <th>ROOM TYPE</th>
                                            <th>CHECK-IN</th>
                                            <th>CHECK-OUT</th>
                                            <th>ADULTS</th>
                                            <th>CHILDREN</th>
                                            <th>STATUS</th>
                                            <th class="text-right">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $reservations = $reservaionObj->getAll();
                                        $count = 0;
                                        foreach ($reservations as $reservation) :
                                            ?>
                                            <tr>
                                                <td><?= ++$count ?></td>
                                                <td><?= $guestObj->getName($reservation['guest_id']) ?></td>
                                                <td><?= $roomTypeObj->getRoomTypeName($reservation['room_type_id']) ?></td>
                                                <td><?= date('d-m-Y', strtotime($reservation['check_in'])) ?></td>
                                                <td><?= date('d-m-Y', strtotime($reservation['check_out'])) ?></td>
                                                <td><?= $reservation['adults'] ?></td>
                                                <td><?= $reservation['children'] ?></td>
                                                <td><?= $reservation['status'] ?></td>
                                                <td class="text-right">
                                                    <?php if ($reservation['status'] == 'Pending') : ?>
                                                        <form action="" method="post" class="d-inline">
                                                            <input type="hidden" name="reservation_id" value="<?= $reservation['id'] ?>">
                                                            <button name="confirm" class="badge badge-success border-0" data-tooltip="tooltip" data-placement="top" title="Confirm"><i class="fas fa-check"></i></button>
                                                        </form>
                                                        <form action="" method="post" class="d-inline">
                                                            <input type="hidden" name="reservation_id" value="<?= $reservation['id'] ?>">
                                                            <button name="cancel" class="badge badge-danger border-0" data-tooltip="tooltip" data-placement="top" title="Cancel"><i class="fas fa-ban"></i></button>
                                                        </form>
                                                    <?php endif; ?>
                                                    <?php if ($reservation['status'] == 'Confirmed') : ?>
                                                        <a href="book.php?reservation=<?= $reservation['id'] ?>" class="badge badge-warning" data-tooltip="tooltip" data-placement="top" title="Check-In"><i class="fas fa-bed"></i></a>
                                                    <?php endif; ?>
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