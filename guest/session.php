<?php 

session_start();
if(isset($_SESSION['guest_id'])) {
    header('location: home.php');
}