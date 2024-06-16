<?php
session_start();

// Kontrollera om användaren är inloggad
if (!isset($_SESSION['auth']['id'])) {
    header("Location: login.php");
    exit();
}

// Hämta användarens ID från sessionen
$userId = $_SESSION['auth']['id'];

// Kontrollera om subscription_id är satt
if (!isset($_POST['subscription_id'])) {
    die("Subscription ID not provided.");
}

$subscription_id = intval($_POST['subscription_id']);

// Anslut till databasen
$mysqli = new mysqli("db", "root", "notSecureChangeMe", "assignment2");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Förbered och exekvera SQL-frågan för att ta bort prenumerationen
$sql = "DELETE FROM subscriptions WHERE id = ? AND user = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ii", $subscription_id, $userId);

if ($stmt->execute()) {
    // Om prenumerationen tas bort, omdirigera tillbaka till prenumerationssidan
    header("Location: MySubscriptions.php");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$mysqli->close();
?>
