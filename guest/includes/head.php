<?php
session_start(); 
//if session is not set, re-direct user to index/login page
//if(!isset($_SESSION['guest_id'])) header("location: ./");



$guest_id = $name = "";
$id = $name = $email = $mobile = $id_card = $city = $state_id = $pin_code = $address = "";
$name = $guest->getName($guest_id);
if (isset($_SESSION['guest_id'])) {


    $guest_id = $_SESSION['guest_id']; //session id

    // //Fetch data from database and assign to the variables
    $name = $guest->getName($guest_id); //Fetching data
}

?>



<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Hotel Resevation System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <!--MDB Bootstrap Material Design-->
    <!-- <link rel="stylesheet" href="../assets/MDB-Free_4.7.7/css/mdb.min.css"> -->
    <!--Font Awesome-->
    <link rel="stylesheet" href="../assets/fontawesome-free-5.8.1-web/css/all.min.css">
    <!--Personal Style sheet -->
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/custom/style.css" />
    <script src="../assets/js/jquery-3.3.1.min.js"></script>
</head>