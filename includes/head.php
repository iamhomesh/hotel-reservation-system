<?php
session_start(); 
//if session is not set, re-direct user to index/login page
if(!isset($_SESSION['guest_id'])) header("location: login.php");

require_once __DIR__. '../../classes/Guest.php';
require_once __DIR__. '../../classes/Room.php';
require_once __DIR__. '../../classes/RoomType.php';
require_once __DIR__. '../../classes/Reservation.php';
require_once __DIR__. '../../classes/Booking.php';
require_once __DIR__. '../../classes/Support.php';
require_once __DIR__. '../../classes/SupportType.php';

$guestObj = new Guest();
$roomObj = new Room();
$roomTypeObj = new RoomType();
$reservaionObj = new Reservation();
$bookingObj = new Booking();
$supportObj = new Support();
$supportTypeObj = new SupportType();

$loggedGuestId = $name = "";
$loggedGuest = "";
if (isset($_SESSION['guest_id'])) {
    $loggedGuestId = $_SESSION['guest_id']; //session id
    // //Fetch data from database and assign to the variables
    $loggedGuest = $guestObj->getGuest($loggedGuestId); //Fetching data
    $name = $loggedGuest['name'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Hotel Resevation System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" integrity="sha256-+N4/V/SbAFiW1MPBCXnfnP9QSN3+Keu+NlB+0ev/YKQ=" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" integrity="sha256-kIxwtDqhOVbQysWu0OpR9QfijdXCfqvXgAUJuv7Uxmg=" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    
    <style>
    *{
        font-family: 'Roboto', sans-serif;
    }
    </style>

</head>