<?php
require_once '../../config.php';

function sanitizeString($str) {
    global $conn;
    $str = strip_tags($str);
    $str = htmlentities($str);
    if(get_magic_quotes_gpc()) {
        $str = stripslashes($str);
    }
    return $conn->real_escape_string($str);
}

function fixName($name) {
    global $conn;
    $name = sanitizeString($name);
    $name = trim(strtolower($name));
    $name_arr = explode(" ", $name);
    $name = "";
    foreach($name_arr as $new_name) {
        $name .= ucfirst($new_name). " ";
    }
    return trim($name);
}

function exceuteQuery($query) {
    global $conn;
    $result = $conn->query($query);
    if (!$result) die("Fatal Error");
    return $result;
}

function destroySession() {
    $_SESSION = array();
    if (session_id() != "" || isset($_COOKIE[session_name()])) {
        setcookie(session_name(), "", time() - 2592000, "/");
    }
}