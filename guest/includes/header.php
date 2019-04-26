<?php

session_start();


if(isset($_SESSION['user'])) {
    include_once __DIR__ . '/head.php';
    include_once __DIR__ . '/navbar.php';
} else {

}