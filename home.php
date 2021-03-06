<?php include_once __DIR__ . '/includes/header.php'; ?>
<div class="container-fluid overflow-auto mb-3">
    <div class="row mt-2">
        <div class="col-md-12 col-sm-12 col-lg-6 mb-2">
            <div class="card">
                <div class="card-header text-center bg-white">
                    <span class="d-block font-weight-bold text-uppercase">Reservations</span>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <dl class="col-4">
                            <i class="fas fa-meh-rolling-eyes" style="font-size: 30px"></i>
                            <dt>Pending</dt>
                            <dd><span class="badge badge-warning"><?= $reservaionObj->countPending($loggedGuestId) ?></span></dd>
                        </dl>
                        <dl class="col-4">
                            <i class="fas fa-smile" style="font-size: 30px"></i>
                            <dt>Confirmed</dt>
                            <dd><span class="badge badge-success"><?= $reservaionObj->countConfirmed($loggedGuestId) ?></span></dd>
                        </dl>
                        <dl class="col-4">
                            <i class="fas fa-frown" style="font-size: 30px"></i>
                            <dt>Cancelled</dt>
                            <dd><span class="badge badge-danger"><?= $reservaionObj->countCancelled($loggedGuestId) ?></span></dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-sm-12 col-lg-6">
            <div class="card">
                <div class="card-header text-center bg-white">
                    <span class="d-block font-weight-bold text-uppercase">Times/Days You Stayed</span>
                </div>
                <div class="card-body overflow-auto">
                    <div class="row text-center">
                                <dl class="col-sm-12 col-md-6 col-lg-3">
                                    <dt><span class="badge badge-dark"></span></dt>
                                    <dd>
                                        <span class="badge badge-secondary"></span> times / <span class="badge badge-secondary">20</span> days
                                    </dd>
                                </dl>
                            <div class="m-auto">
                                <span class="font-italic">Your bookings will be shown here</span>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3 mb-5">
        <?php
        $roomTypes = $roomTypeObj->getAll();
        foreach ($roomTypes as $roomType) : ?>
            <div class="col-sm-12 col-md-3 col-lg-3">
                <div class="card text-center mb-3">
                    <div class="card-header badge badge-dark">
                        <span class="d-block font-weight-bold text-light text-uppercase"><?= $roomType['name'] ?></span>
                    </div>
                    <div class="card-body">
                        <p class="overflow-auto" style="height:50px"><em><strong>Desc:</strong> <?= $roomType['description'] ?></em></p>
                        <div style="height:30px">
                            <div class="d-inline float-left">
                                <span class="badge badge-warning">&#8377; <strong><?= $roomType['rate'] ?></strong></span>
                            </div>
                            <div class="d-inline float-right">
                                
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center font-weight-bold badge badge-danger text-uppercase">
                        
                            <a class="d-block text-decoration-none text-light" href="book.php?type-id=<?= $roomType['id'] ?>">Book</a>
                        
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php include_once __DIR__ . '/includes/footer.php' ?>