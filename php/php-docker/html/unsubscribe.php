<?php
session_start();

include_once('functions.php');

if (!isset($_SESSION['auth']['id'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['auth']['id'];

if (!isset($_POST['subscription_id'])) {
    die("Subscription ID not provided.");
}

$subscription_id = intval($_POST['subscription_id']);

$mysqli = connect_to_database();

$sql = "DELETE FROM subscriptions WHERE id = ? AND user = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ii", $subscription_id, $userId);

if ($stmt->execute()) {
    header("Location: MySubscriptions.php");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$mysqli->close();
?>
