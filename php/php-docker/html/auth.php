<?php



$isLoggedIn = isset($_SESSION['user_id']);
$userId = $isLoggedIn ? $_SESSION['user_id'] : null;
$userRole = $isLoggedIn ? $_SESSION['role'] : null;
?>
