<?php include_once __DIR__ . '../includes/header.php'; 

include_once __DIR__. '../../classes/BookingRequest.php';
$request = new BookingRequest();
include_once __DIR__ . '../../classes/Room.php';
        $rooms = new Room();
        include_once __DIR__ . '../../classes/RoomType.php';
        $roomType = new RoomType();
        $arrRoomTypes = $roomType->fetchAll();
        $room = new Room();
        ?>


<div class="container-fluid overflow-auto mb-3">
    <div class="row mt-2">
        <div class="col-md-12 col-sm-12 col-lg-6 mb-2">
            <div class="card">
                <div class="card-header text-center bg-white">
                    <span class="d-block font-weight-bold text-uppercase">Request/Booking Status</span>
                </div>
                <div class="card-body" >
                    <div class="row text-center">
                        <dl class="col-4">
                            <i class="fas fa-meh-rolling-eyes" style="font-size: 30px"></i>
                            <dt>Pending</dt>
                            <dd><span class="badge badge-warning"><?= $request->countPending($guest_id) ?></span></dd>
                        </dl>
                        <dl class="col-4">
                            <i class="fas fa-smile" style="font-size: 30px"></i>
                            <dt>Confirmed</dt>
                            <dd><span class="badge badge-success"><?= $request->countConfirmed($guest_id) ?></span></dd>
                        </dl>
                        <dl class="col-4">
                            <i class="fas fa-frown" style="font-size: 30px"></i>
                            <dt>Cancelled</dt>
                            <dd><span class="badge badge-danger"><?= $request->countCancelled($guest_id) ?></span></dd>
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
                        <?php foreach($arrRoomTypes as $arrRoomType): ?>
                        <dl class="col-sm-12 col-md-6 col-lg-3">
                            
                            <dt><span class="badge badge-dark"><?= $arrRoomType['type_name'] ?></span></dt>
                            <dd>
                                <span class="badge badge-secondary">2</span> times - <span class="badge badge-secondary">20</span> day(s)
                            </dd>
                        </dl>
                        <?php endforeach ?>
                       

                    </div>
                </div>
            </div>
        </div>
        
        
    </div>


    <div class="row mt-3 mb-5">
        <?php
        


        foreach ($arrRoomTypes as $arrRoomType) : ?>


            <div class="col-sm-12 col-md-3 col-lg-3">

                <div class="card text-center mb-3">
                    <div class="card-header badge badge-dark">
                        <span class="d-block font-weight-bold text-light text-uppercase"><?= $arrRoomType['type_name'] ?></span>
                    </div>

                    <div class="card-body">



                        <p class="overflow-auto" style="height:50px"><em><strong>Desc:</strong> <?= $arrRoomType['description'] ?></em></p>

                        <div style="height:30px">
                            <div class="d-inline float-left">
                                <span class="badge badge-warning">&#8377; <strong><?= $arrRoomType['rate'] ?></strong></span>
                            </div>
                            <div class="d-inline float-right">
                                <?php
                                $available = $room->countAvaiable($arrRoomType['type_id']);

                                if ($available > 0) : ?>
                                    <span class="badge badge-success"> Avl: <strong><?= $available ?></strong> </span>
                                <?php else : ?>
                                    <span class="badge badge-danger"> Avl: <strong><?= $available ?></strong> </span>

                                <?php endif; ?>
                            </div>
                        </div>


                    </div>
                    <div class="card-footer text-center font-weight-bold badge badge-danger text-uppercase">
                        <?php if ($available > 0) : ?>
                            <a class="d-block text-decoration-none text-light" href="book.php?type-id=<?= $arrRoomType['type_id'] ?>">Book</a>

                        <?php else : ?>
                            <a class="d-block text-dark">No Room Available</a>

                        <?php endif; ?>
                    </div>




                </div>
            </div>
        <?php endforeach; ?>
    </div>


    <!-- Widgets  -->

    




</div>

<?php include_once __DIR__ . '../includes/footer.php' ?>