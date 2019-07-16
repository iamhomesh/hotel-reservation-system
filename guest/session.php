<?php 

session_start();
if(isset($_SESSION['guest_id'])) {
    header('location: home.php');
}else {
    header('localtion: index.php');
}