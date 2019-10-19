<?php
include_once __DIR__ . '/includes/head.php';
include_once __DIR__ . '/includes/left_panel.php';
include_once __DIR__ . '/includes/header.php';
?>



<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="page-header">
            <div class="page-title float-right">
                <ol class="breadcrumb text-right">
                    <li class="breadcrumb-item">Room</li>
                    <li class="breadcrumb-item"><a href="room_status.php">Status</a></li>
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
                        <strong>Room Status</strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 overflow-auto">
                                <table class="table table-sm data-table">
                                    <thead class="">
                                        <tr>
                                            <th>#</th>
                                            <th>ROOM #</th>
                                            <th>ROOM TYPE</th>
                                            <th>STATUS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include_once __DIR__ . '../../classes/Room.php';
                                        $roomObj = new Room();
                                        $rooms = $roomObj->getAll();
                                        $count = 0;
                                        foreach ($rooms as $room) :?>
                                            <tr>
                                                <td><?= ++$count ?></td>
                                                <td><?= $room['room_no'] ?></td>
                                                <td><?= $roomTypeObj->getRoomTypeName($room['type_id']) ?></td>
                                                <td>
                                                    <?php if ($room['available'] == 1) : ?>
                                                        <span class="badge badge-success">Available</span>
                                                    <?php else : ?>
                                                        <span class="badge badge-danger">Occupied</span>
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