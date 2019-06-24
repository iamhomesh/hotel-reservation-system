<?php include_once __DIR__ . '../includes/header.php';




include_once __DIR__ . '/../classes/BookingRequest.php';
include_once __DIR__ . '/../classes/BookingHistory.php';
$bookingRequest = new BookingRequest();
$bookingHistory = new BookingHistory();
?>

<div class="container">
    <div class="row m-auto" style="">
        <!--ROW START-->

        <div class="col-lg-12 overflow-auto">

            <div class="card mt-5 mt-lg-5">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" id="request-tab" data-toggle="tab" href="#request" role="tab" aria-controls="request" aria-selected="true"><strong>Requests</strong></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="history-tab" data-toggle="tab" href="#history" role="tab" aria-controls="history" aria-selected="false"><strong>History</strong></a>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    <div class="tab-content">
                        <!--OPEN (UNREAD SUPPORT MESSAGE TAB)-->
                        <div class="tab-pane fade show active" id="request" role="tabpanel" aria-labelledby="request-tab">

                            <div class="container overflow-auto" style="max-height:350px">


                                <table class="table table-hover data-table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>REQ. ID</th>
                                            <th>ROOM TYPE</th>
                                            <th>CHECK-IN</th>
                                            <th>CHECK-OUT</th>
                                            <th>ADULTS</th>
                                            <th>CHILDREN</th>
                                            <th>STATUS</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-left">

                                        <?php
                                        include_once __DIR__ . '/../classes/RoomType.php';
                                        $roomType = new RoomType();

                                        $requestTable = $bookingRequest->getAllByGuestId($guest_id);

                                        $total = count($requestTable);
                                        $count = 0;

                                        foreach ($requestTable as $key => $value) :
                                            $count++;
                                            ?>
                                            <tr>
                                                <td><?= $count ?></td>
                                                <td><?= $value['request_id'] ?></td>
                                                <td><?= $roomType->getRoomTypeName($value['room_type_id']) ?></td>
                                                <td><?= $bookingRequest->fixDate($value['check_in']) ?></td>
                                                <td><?= $bookingRequest->fixDate($value['check_out']) ?></td>
                                                <td><?= $value['adults'] ?></td>
                                                <td><?= $value['children'] ?></td>
                                                <td><?= $value['status'] ?></td>


                                            <?php endforeach; ?>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--CLOSE (UNREAD SUPPORT MESSAGE TAB)-->

                        <!--OPEN (READ SUPPORT MESSAGE TAB)-->
                        <div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="history-tab">
                            <div class="container overflow-auto" style="max-height: 350px">
                                <?php
                                include_once __DIR__ . '/../classes/Room.php';
                                $room =  new Room();
                                $historyTable = $bookingHistory->getAllByGuestId($guest_id);
                                if (empty($historyTable)) : ?>
                                    <div class="text-center">
                                        <span class="font-italic">No record found</span>
                                    </div>
                                <?php else : ?>
                                    <table class="table table-hover data-table">

                                        <thead class="thead-light">
                                            <tr>
                                                <th>#</th>
                                                <th>BKNG ID</th>
                                                <th>ROOM #</th>
                                                <th>ROOM TYPE</th>
                                                <th>CHECK-IN</th>
                                                <th>CHECK-OUT</th>
                                                <th>STATUS</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-left">

                                            <?php




                                            $total = count($historyTable);
                                            $count = 0;

                                            foreach ($historyTable as $key => $value) :
                                                $count++;
                                                ?>
                                                <tr>
                                                    <td><?= $count ?></td>
                                                    <td><?= $value['booking_id'] ?></td>
                                                    <td><?= $room->getRoomNo($value['room_id'])  ?></td>
                                                    <td><?= $roomType->getRoomTypeName($value['room_id']) ?></td>
                                                    <td><?= $value['check_in'] ?></td>
                                                    <td><?= $value['check_out'] ?></td>
                                                    <td><?= $value['is_stay'] === 'yes' ? 'STAYING' : 'NOT STAYING'; ?></td>


                                                <?php endforeach; ?>
                                            </tr>

                                        </tbody>
                                    </table>
                                <?php endif ?>
                            </div>
                        </div>
                        <!--CLOSE (READ SUPPORT MESSAGE TAB)-->

                    </div>

                </div>





            </div>
        </div>
    </div>

</div>

<?php include_once __DIR__ . '../includes/footer.php' ?>