<?php
session_start();

if (!isset($_SESSION['auth']['id'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['auth']['id'];

if (!isset($_POST['newsletterId'])) {
    die("Newsletter ID not provided.");
}

$newsletterId = intval($_POST['newsletterId']);

$mysqli = new mysqli("db", "root", "notSecureChangeMe", "assignment2");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

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
