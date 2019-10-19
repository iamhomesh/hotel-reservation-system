<?php
require_once __DIR__ . '../../classes/Bill.php';
$billObj = new Bill();
require_once __DIR__ . '../../classes/Booking.php';
$bookingObj = new Booking();
require_once __DIR__ . '../../classes/Guest.php';
$guestObj = new Guest();
require_once __DIR__ . '../../classes/State.php';
$stateObj = new State();
require_once __DIR__ . '../../classes/Room.php';
$roomObj = new Room();
require_once __DIR__ . '../../classes/RoomType.php';
$roomTypeObj = new RoomType();
require_once __DIR__ . '../../classes/Paymentmode.php';
$paymentModeObj = new PaymentMode();

$bill = $booking = $guest = $room = $roomType = $state = $paymentMode = "";
if (isset($_GET['bill'])) {
    $bill_id = $_GET['bill'];
    $bill = $billObj->getBill($bill_id);
    $booking = $bookingObj->getBooking($bill['booking_id']);
    $guest = $guestObj->getGuest($booking['guest_id']);
    $room = $roomObj->getRoom($booking['room_id']);
    $roomType = $roomTypeObj->getRoomType($room['type_id']);
    $state = $stateObj->getStateName($guest['state_id']);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $bill['bill_no'] ?></title>
    <meta name="description" content="Hotel Reservation System">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
    <link rel="icon" href="../favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" integrity="sha256-+N4/V/SbAFiW1MPBCXnfnP9QSN3+Keu+NlB+0ev/YKQ=" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-6">
                <h3>INVOICE</h3>
                <div class="row">
                    <div class="col-4">
                        <?= $bill['bill_no'] ?>
                    </div>
                    <div class="col-4">
                        <?= $bill['created_at'] ?>
                    </div>
                    <div class="col-12">HOTEL NAME</div>
                </div>
            </div>
            <div class="col-6 text-right">
                <h3 class="">INVOICE TO</h3>
                <div class="row text-right">

                    <div class="col-12">
                        <h4><?= $guest['name'] ?></h4>
                    </div>
                    <div class="col-12">
                        <?= $guest['mobile'] ?>
                    </div>
                    <div class="col-12">
                        <?= $guest['address'] ?>
                    </div>
                    <div class="col-12">
                        <span>
                            <?= $guest['city'] ?>,
                            <?= $state ?>,
                            India</br>
                            <?= $guest['pin_code'] ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-lg-12">
                <table class="table table-borderless">
                    <thead class="thead-white border-bottom border-dark">
                        <tr>

                            <th>ROOM #</th>
                            <th>ROOM TYPE</th>
                            <th>RATE</th>
                            <th>CHECK-IN</th>
                            <th>CHECK-OUT</th>
                            <th>DAYS</th>
                            <th>AMOUNT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $checkIn = date('Y-m-d', strtotime($booking['check_in']));
                        $checkOut = date('Y-m-d', strtotime($booking['check_out']));
                        $days = abs(strtotime($checkIn) - strtotime($checkOut)) / (24 * 60 * 60);

                        if ($days < 1) {
                            $days = 1;
                        }
                        ?>

                        <tr>
                            <td><?= $room['room_no'] ?></td>
                            <td><?= $roomType['name'] ?></td>
                            <td><?= $roomType['rate'] ?></td>
                            <td><?= date('d M Y', strtotime($booking['check_in'])) ?></td>
                            <td><?= date('d M Y', strtotime($booking['check_out'])) ?></td>
                            <td><?= $days ?></td>
                            <td><?= $days * $roomType['rate'] ?></td>
                        </tr>
                    </tbody>

                </table>
                <hr class="bg-dark">
            </div>
        </div>



        <div class="row mb-5">
            <div class="col-6">

            </div>
            <div class="col-6">
                <div class="w-75 float-right">
                    
                    <div class="row rounded bg-dark text-light">
                        <div class="col-6"><span class="font-weight-bold">NET AMOUNT</span></div>
                        <div class="col-6 text-right"><span class=""><?= $days * $roomType['rate'] ?></span></div>
                    </div>
                    <div class="row">
                        <div class="col-6"><span class="font-weight-bold">PAID</span></div>
                        <div class="col-6 text-right"><span class=""><?= $bill['paid'] ?></span></div>
                    </div>
                    <div class="row">
                        <div class="col-6"><span class="font-weight-bold">DUE</span></div>
                        <div class="col-6 text-right"><span class=""><?= $bill['due'] ?></span></div>
                    </div>
                </div>

            </div>
        </div>
        <div class="clearfix"></div>
        <div class="text-center mt-5">
            <hr class="bg-dark">
            <h3 class="text-uppercase">Thank You for Staying, Visit Again.</h3>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>