<?php
include_once __DIR__ . '/includes/head.php';
include_once __DIR__ . '/includes/left_panel.php';
include_once __DIR__ . '/includes/header.php';
?>
<!-- Content -->
<div class="content">
    <!-- Animated -->
    <div class="animated fadeIn">
        <div class="row">
            <?php
            include __DIR__ . '../../classes/Room.php';
            $roomObj = new Room();
            $roomTypes = $roomTypeObj->getAll();
            foreach ($roomTypes as $roomType) :
                $type_id = $roomType['id'];
                $room_type = $roomType['name'];
                $rate = $roomType['rate'];
                $description = $roomType['description'] ?>
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="card text-white bg-flat-color-3">
                        <div class="card-header">
                            <span><?= $room_type ?></span>
                        </div>
                        <div class="card-body text-center">
                            <p class="text-white">Discription: <span class="bold"><?= $description; ?></span></p>
                            <?php

                                $available = $roomObj->countAvailableById($type_id);
                                ?>
                            <div class="d-inline float-left">
                                Rate: <strong><?= $rate ?></strong>
                            </div>
                            <div class="d-inline float-right">
                                Available: <strong class="count"><?= $available ?></strong>
                            </div>
                        </div>
                        <?php if ($available > 0) : ?>
                            <div class="card-footer text-center">
                                <a class="d-block" href="book.php?type=<?= $type_id ?>">Book</a>
                            </div>
                        <?php else : ?>
                            <div class="card-footer text-center">
                                <a class="d-block text-dark">No Room Available</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach;
            ?>
        </div>


        <!--WIdgets-->
        <!-- Widgets  -->

        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-3">
                                <i class="fas fa-project-diagram"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <?php
                                    $available = $roomObj->countAvailable();
                                    ?>
                                    <div class="stat-text text-success"><span class="count"><?= $available ?></span></div>
                                    <div class="stat-heading">Available</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-4">
                                <i class="fas fa-network-wired"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <?php
                                    $occupied = $roomObj->countOccupied();
                                    ?>
                                    <div class="stat-text text-danger"><span class="count"><?= $occupied ?></span></div>
                                    <div class="stat-heading">Occupied</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-1">
                                <i class="far fa-money-bill-alt"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text">&#x20B9; <span class="count">23569</span></div>
                                    <div class="stat-heading">Total Income</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-2">
                                <i class="fas fa-money-check-alt"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text">&#x20B9; <span class="count">3435</span></div>
                                    <div class="stat-heading">Withdrawal</div>
                                </div>
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