<?php

include_once __DIR__ . '../includes/header.php';

$adults = $children = $check_in = $check_out = $room_type = "";


if(isset($_GET['type-id'])) {
    $room_type = $_GET['type-id'];
}

$errors = array();
if (isset($_POST['submit'])) {
    $adults = $_POST['adults'];
    $children = $_POST['children'];
    $room_type = $_POST['room-type'];
    $check_in = $_POST['check-in'];
    $check_out = $_POST['check-out'];

    if (empty($_POST['adults'])) $errors[] = "Enter number of adult guests";
    if (empty($room_type)) $errors[] = "Please select room type";
    if (empty($check_in)) $errors[] = "Please select check-in date";
    if (empty($check_out)) $errors[] = "Please select check-out date";

    if (empty($errors)) {
        $fields = array(
            'guest_id' => $guest_id,
            'adults' => $_POST['adults'],
            'children' => $_POST['children'],
            'room_type_id' => $_POST['room-type'],
            'check_in' => $_POST['check-in'],
            'check_out' => $_POST['check-out']
        );

        include_once __DIR__. '/../classes/BookingRequest.php';
        $bookingRequest = new BookingRequest();
        $booked = $bookingRequest->create($fields);
        if($booked): ?>
            <script>
            alert('Booking request sent successfuly');
            location = "bookings.php";
            </script>
        <?php endif;

    }
}

?>


    <div class="container">
        <div class="row m-auto" style="max-width:500px">
            <!--ROW START-->
            <div class="col-lg-12 overflow-auto" style="max-height: 580px">

                <div class="card mt-5 mt-lg-3">
                    <div class="card-header"><strong>Book Room</strong></div>
                    <div class="">

                        <div class="card-body card-block">
                            <form method="POST" action="">
                                <input type="hidden" name="id">
                                <div class="form-row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="adults">Adults</label>
                                            <input type="number" class="form-control" value="<?= $adults ?? "" ?>" name="adults" />

                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="children">Children</label>
                                            <input type="number" class="form-control" value="<?= $children ?? "" ?>" name="children" />

                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="room-type">Room Type</label>
                                            <select name="room-type" id="room-type" class="form-control" required>

                                                <?php
                                                include_once __DIR__ . '../../classes/RoomType.php';

                                                $obj_room_type = new RoomType();
                                                $rows = $obj_room_type->fetchAll(); ?>
                                                <option value="">Select Type</option>

                                                <?php




                                                foreach ($rows as $row) : ?>

                                                    <?php
                                                    if ($row['type_id'] == $room_type) : ?>

                                                        <option value="<?= $row['type_id'] ?>" class="text-danger" selected><?= $row['type_name'] ?></option>
                                                    <?php else : ?>
                                                        <option value="<?= $row['type_id'] ?>"><?= $row['type_name'] ?></option>

                                                    <?php
                                                endif;
                                            endforeach;
                                            ?>
                                            </select>

                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="check-in">Check-In</label>
                                            <input type="date" class="form-control" value="<?= $check_in ?? "" ?>" name="check-in" />

                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="check-out">Check-Out</label>
                                            <input type="date" class="form-control" value="<?= $check_out ?? "" ?>" name="check-out" />

                                        </div>
                                    </div>
                                </div>

                                <div class="row" id="room-desc">
                                </div>



                                <div class="col-lg-12">
                                    <button id="submit" name="submit" class="btn btn-danger btn-block btn-sm">Book</button>
                                </div>
                        </div>
                        </form>
                    </div>

                </div>


            </div>
        </div>
    </div>

    </div>
    
    <?php include_once __DIR__ .'../includes/footer.php' ?>