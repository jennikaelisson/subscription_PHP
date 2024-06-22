<?php
session_start();

include_once('functions.php');

if (!isset($_SESSION['auth']['id'])) {
    header("Location: login.php?message=unathorized");
    exit();
}

$userId = $_SESSION['auth']['id'];

if (!isset($_POST['newsletterId'])) {
    die("Newsletter ID not provided.");
}

$newsletterId = intval($_POST['newsletterId']);

$mysqli = connect_to_database();

$checkSql = "SELECT * FROM subscriptions WHERE newsletterId = ? AND user = ?";
$checkStmt = $mysqli->prepare($checkSql);
$checkStmt->bind_param("ii", $newsletterId, $userId);
$checkStmt->execute();
$result = $checkStmt->get_result();

if ($result->num_rows > 0) {
    header("Location: MySubscriptions.php?message=already_subscribed");
    exit();
}

$checkStmt->close();

$sql = "INSERT INTO subscriptions (newsletterId, user) VALUES (?, ?)";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ii", $newsletterId, $userId);

if ($stmt->execute()) {
    header("Location: MySubscriptions.php");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$mysqli->close();
?>
