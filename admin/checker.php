<?php

include_once __DIR__ . '../../classes/Booking.php';
include_once __DIR__ . '../../classes/Room.php';
include_once __DIR__ . '../../classes/RoomType.php';

$roomObj = new Room();
$roomTypeObj = new RoomType();
$bookingObj = new Booking();

//calculating rate
if (isset($_GET['booking_id'])) {
    if ($_GET['booking_id'] <= 0) {
        echo 0;
    } else {
        $booking = $bookingObj->getBooking($_GET['booking_id']);
        $check_in = date('Y-m-d', strtotime($booking['check_in']));
        $check_out = date('Y-m-d', strtotime($booking['check_out']));
        $room = $roomObj->getRoom($booking['room_id']);
        $roomType = $roomTypeObj->getRoomType($room['type_id']);
        $rate = $roomType['rate'];
        $days = abs(strtotime($check_in) - strtotime($check_out))  / (60 * 60 * 24);
        if ($days > 0) {
            echo $rate * $days;
        } else {
            echo $rate * 1;
        }
    }
}

//checking room number
if (isset($_GET['add_room_no'])) {
    $check = $roomObj->checkRoomNo($_GET['add_room_no']);
    if ($check) echo "Room number exists";
}
if (isset($_GET['update_room_no']) && isset($_GET['room_id'])) {
    $check = $roomObj->checkRoomNo($_GET['update_room_no'], $_GET['room_id']);
    if ($check) echo "Room number exists";
}

//checking room type
if (isset($_GET['add-room-type'])) {
    $check = $roomTypeObj->checkRoomType($_GET['add-room-type']);
    if ($check) echo "Room type exists";
}
if (isset($_GET['update-room-type']) && isset($_GET['type-id'])) {
    $check = $roomTypeObj->checkRoomType($_GET['update-room-type'], $_GET['type-id']);
    if ($check) echo "Room type exists";
}
