<?php

session_start();
include_once __DIR__.'/../../classes/Guest.php';
$guest = new Guest();

    $id = $name = $email = $mobile = $id_card = $city = $state_id = $pin_code = $address = "";

    if (isset($_SESSION['user'])) {


        $id = $_SESSION['user']; //session id

        //Fetch data from database and assign to the variables
        $row = $guest->fetchData($id); //Fetching data
        $id = $row['guest_id'];
        $name = $row['name'];
        $mobile = $row['mobile'];
        $email = $row['email'];
        $id_card = $row['id_card'];
        $city = $row['city'];
        $state_id = $row['state_id'];
        $pin_code = $row['pin_code'];
        $address = $row['address'];
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
</head>


<body>