<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


function get_window_title($title) {
    return $title.' - Groovy Times Collective';
}

function no_access_subscriber() {
    if (!isset($_SESSION['auth']['role']) || $_SESSION['auth']['role'] !== 'subscriber') {
        echo "You do not have access to this page";
        exit();
    }
}

function no_access_customer() {
    if (!isset($_SESSION['auth']['role']) || $_SESSION['auth']['role'] !== 'customer') {
        echo "You do not have access to this page";
        exit();
    }
}

function connect_to_database() {
    $mysqli = new mysqli("db", "root", "notSecureChangeMe", "assignment2");

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }
    return $mysqli;
}
?>