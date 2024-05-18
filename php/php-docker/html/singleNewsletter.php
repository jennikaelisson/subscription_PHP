<?php
include_once('functions.php');
session_start();

$title = "My page";
include('header.php');

$newsletterId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Kontrollera om användar-ID är satt i sessionen
if (!isset($_SESSION['user_id'])) {
    die("User ID not found in session. Please log in.");
}

$userId = $_SESSION['user_id'];

$mysqli = new mysqli("db", "root", "notSecureChangeMe", "assignment2");

// Kontrollera om prenumerationsknapparna har tryckts
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['subscribe'])) {
        // Kontrollera om prenumerationen redan finns
        $checkSql = "SELECT * FROM subscriptions WHERE user = ? AND newsletterId = ?";
        $checkStmt = $mysqli->prepare($checkSql);
        $checkStmt->bind_param("ii", $userId, $newsletterId);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();

        if ($checkResult->num_rows > 0) {
            $message = "Du prenumererar redan på detta nyhetsbrev.";
        } else {
            // Lägg till prenumeration
            $sql = "INSERT INTO subscriptions (user, newsletterId) VALUES (?, ?)";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("ii", $userId, $newsletterId);
            if ($stmt->execute()) {
                $message = "Du har börjat prenumerera på nyhetsbrevet.";
            } else {
                $message = "Det gick inte att börja prenumerera: " . $stmt->error;
            }
            $stmt->close();
        }
        $checkStmt->close();
    } elseif (isset($_POST['unsubscribe'])) {
        // Ta bort prenumeration
        $sql = "DELETE FROM subscriptions WHERE user = ? AND newsletterId = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ii", $userId, $newsletterId);
        if ($stmt->execute()) {
            $message = "Du har avslutat prenumerationen på nyhetsbrevet.";
        } else {
            $message = "Det gick inte att avsluta prenumerationen: " . $stmt->error;
        }
        $stmt->close();
    }
}

// Hämta detaljer om nyhetsbrevet
$sql = "SELECT title, description FROM newsletters WHERE id = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $newsletterId);
$stmt->execute();
$result = $stmt->get_result();

// Kontrollera om nyhetsbrevet finns
if ($result->num_rows > 0) {
    $newsletter = $result->fetch_assoc();
    $newsletterTitle = htmlspecialchars($newsletter['title']);
    $newsletterDescription = htmlspecialchars($newsletter['description']);
} else {
    $newsletterTitle = "Nyhetsbrevet hittades inte";
    $newsletterDescription = "Det finns inget nyhetsbrev med det angivna id:t.";
}

$stmt->close();
$mysqli->close();
?>

<div>
    <?php echo("Single newsletter"); ?>
</div>
<div>
    <h2><?php echo $newsletterTitle; ?></h2>
    <p><?php echo $newsletterDescription; ?></p>
    <?php if (isset($message)) { echo "<p>$message</p>"; } ?>
</div>

<!-- Prenumerationsknappar -->
<div>
    <form method="post">
        <input type="hidden" name="newsletter_id" value="<?php echo htmlspecialchars($newsletterId); ?>">
        <button type="submit" name="subscribe">Prenumerera</button>
        <button type="submit" name="unsubscribe">Avsluta prenumeration</button>
    </form>
</div>

<?php
include('footer.php');
?>
