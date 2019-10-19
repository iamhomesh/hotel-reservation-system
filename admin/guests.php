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
                    <li class="breadcrumb-item"><a href="guests.php">Guests</a></li>
                    <li class="breadcrumb-item active" aria-current="page">View</li>
                </ol>
            </div>
        </div>
    </div>
</div>




<!-- Content -->
<div class="content mb-5">
    <!-- Animated -->
    <div class="animated fadeIn">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header text-center">
                        <strong class="text-uppercase">VIEW GUESTS</strong>

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 overflow-auto">
                                <table class="table table-sm data-table">
                                    <thead class="">
                                        <tr>
                                            <th>#</th>
                                            <th>NAME</th>
                                            <th>EMAIL</th>
                                            <th>MOBILE</th>
                                            <th>CITY</th>
                                            <th>STATE</th>
                                            <th class="text-right">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include __DIR__ . '../../classes/State.php';
                                        $stateObj = new State();
                                        $guests = $guestObj->getAllGuests();
                                        $count = 0;
                                        foreach ($guests as $guest) :
                                            ?>
                                            <tr>
                                                <td><?= ++$count ?></td>
                                                <td><?= $guest['name'] ?></td>
                                                <td><?= $guest['email'] ?></td>
                                                <td><?= $guest['mobile'] ?></td>
                                                <td><?= $guest['city'] ?></td>
                                                <td><?= $stateObj->getStateName($guest['state_id']) ?></td>
                                                <td class="text-right"><a href="edit_guest.php?guest=<?= $guest['id'] ?>" class="badge badge-warning">EDIT</a></td>
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
include_once __DIR__ . '/includes/footer.php'
?>