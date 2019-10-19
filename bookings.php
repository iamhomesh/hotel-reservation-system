<?php include_once __DIR__ . '../includes/header.php'; ?>
<div class="container">
    <div class="row m-auto">
        <div class="col-lg-12 overflow-auto">
            <div class="card mt-2 mt-lg-5">
                <div class="card-header text-center bg-white badge">
                    <script>
                        $().ready(function() {
                            $('.card-header li .active').addClass('bg-dark text-light');
                            $(".card-header li").click(function() {
                                $(this).siblings().children().removeClass('bg-dark text-light');
                                $(this).children().addClass('bg-dark text-light');
                            });
                        });
                    </script>
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link text-secondary active" id="reservation-tab" data-toggle="tab" href="#reservation" role="tab" aria-controls="reservation" aria-selected="true"><strong>RESERVATIONS</strong></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-secondary" id="booking-tab" data-toggle="tab" href="#booking" role="tab" aria-controls="booking" aria-selected="false"><strong>BOOKINGS</strong></a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="reservation" role="tabpanel" aria-labelledby="reservation-tab">
                            <div class="container overflow-auto" style="max-height:350px">
                                <?php
                                $reservations = $reservaionObj->getAllByGuestId($loggedGuestId);
                                if (empty($reservations)) : ?>
                                    <div class="text-center">
                                        <style></style>
                                        <span class="font-italic" id="test">Your reservations will be shown here.</span>
                                    </div>
                                <?php else : ?>
                                    <table class="table table-hover table-sm">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>#</th>
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
                                                $count = 1;
                                                foreach ($reservations as $reservation) : ?>
                                                <tr>
                                                    <td><?= $count++ ?></td>
                                                    <td><?= $roomTypeObj->getRoomTypeName($reservation['room_type_id']) ?></td>
                                                    <td><?= date('d-M-Y', strtotime($reservation['check_in'])) ?></td>
                                                    <td><?= date('d-M-Y', strtotime($reservation['check_out'])) ?></td>
                                                    <td><?= $reservation['adults'] ?></td>
                                                    <td><?= $reservation['children'] ?></td>
                                                    <td><?= $reservation['status'] ?></td>
                                                <?php endforeach; ?>
                                                </tr>
                                        </tbody>
                                    </table>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="booking" role="tabpanel" aria-labelledby="booking-tab">
                            <div class="container overflow-auto" style="max-height: 350px">
                                <?php
                                $bookings = $bookingObj->getAllByGuestId($loggedGuestId);
                                if (empty($bookings)) : ?>
                                    <div class="text-center">
                                        <span class="font-italic">Your booking history will be shown here.</span>
                                    </div>
                                <?php else : ?>
                                    <table class="table table-hover table-sm">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>ROOM #</th>
                                                <th>ROOM TYPE</th>
                                                <th>CHECK-IN</th>
                                                <th>CHECK-OUT</th>
                                                <th>STATUS</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-left">
                                            <?php
                                                $count = 1;
                                                foreach ($bookings as $booking) : ?>
                                                <tr>
                                                    <td><?= $count++ ?></td>
                                                    <td><?= $roomObj->getRoomNo($booking['room_id'])  ?></td>
                                                    <?php $room = $roomObj->getRoom($booking['room_id']) ?>
                                                    <td><?= $roomTypeObj->getRoomTypeName($room['type_id']) ?></td>
                                                    <td><?= date('d-M-Y', strtotime($booking['check_in'])) ?></td>
                                                    <td><?= date('d-M-Y', strtotime($booking['check_out'])) ?></td>
                                                    <td><?= $booking['staying'] == '1' ? 'STAYING' : 'CHECKED OUT'; ?></td>
                                                <?php endforeach; ?>
                                                </tr>
                                        </tbody>
                                    </table>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once __DIR__ . '../includes/footer.php' ?>