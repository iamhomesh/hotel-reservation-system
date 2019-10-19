<?php
session_start();
if(isset($_SESSION['guest_id'])){
    unset($_SESSION['guest_id']);
}
header('location: login.php');