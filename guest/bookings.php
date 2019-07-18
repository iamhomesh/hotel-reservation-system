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
                            <a class="nav-link text-secondary active" id="request-tab" data-toggle="tab" href="#request" role="tab" aria-controls="request" aria-selected="true"><strong>REQUEST HISTORY</strong></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-secondary" id="history-tab" data-toggle="tab" href="#history" role="tab" aria-controls="history" aria-selected="false"><strong>BOOKING HISTORY</strong></a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="request" role="tabpanel" aria-labelledby="request-tab">
                            <div class="container overflow-auto" style="max-height:350px">
                                <?php
                                $requestTable = $bookingRequest->getAllByGuestId($guest_id);
                                if (empty($requestTable)) : ?>
                                    <div class="text-center">
                                        <style></style>
                                        <span class="font-italic" id="test">Your booking requests will be shown here.</span>
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
                                            foreach ($requestTable as $key => $value) : ?>
                                                <tr>
                                                    <td><?= $count++ ?></td>
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
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="history-tab">
                            <div class="container overflow-auto" style="max-height: 350px">
                                <?php
                                $historyTable = $bookingHistory->getAllByGuestId($guest_id);
                                if (empty($historyTable)) : ?>
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
                                            foreach ($historyTable as $key => $value) : ?>
                                                <tr>
                                                    <td><?= $count++ ?></td>
                                                    <td><?= $room->getRoomNo($value['room_id'])  ?></td>
                                                    <td><?= $roomType->getRoomTypeName($value['room_id']) ?></td>
                                                    <td><?= $bookingHistory->fixDate($value['check_in']) ?></td>
                                                    <td><?= $bookingHistory->fixDate($value['check_out']) ?></td>
                                                    <td><?= $value['is_stay'] === 'yes' ? 'STAYING' : 'CHECKED OUT'; ?></td>
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