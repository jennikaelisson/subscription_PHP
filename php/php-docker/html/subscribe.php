<?php
session_start();

// Kontrollera om användaren är inloggad
if (!isset($_SESSION['auth']['id'])) {
    header("Location: login.php");
    exit();
}

// Hämta användarens ID från sessionen
$userId = $_SESSION['auth']['id'];

// Kontrollera om newsletterId är satt
if (!isset($_POST['newsletterId'])) {
    die("Newsletter ID not provided.");
}

$newsletterId = intval($_POST['newsletterId']);

// Anslut till databasen
$mysqli = new mysqli("db", "root", "notSecureChangeMe", "assignment2");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Förbered och exekvera SQL-frågan för att ta bort prenumerationen
$sql = "INSERT INTO subscriptions (newsletterId, user) VALUES (?, ?)";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ii", $newsletterId, $userId);

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
