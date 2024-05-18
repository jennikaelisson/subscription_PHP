<?php
session_start();


// Kontrollera om användaren är inloggad
if(isset($_SESSION['user_id'])) {
    // Om användaren är inloggad, skriv ut användar-ID
    var_dump($_SESSION['user_id']);
} else {
    // Om användaren inte är inloggad, visa ett meddelande
    echo "Ingen användare är för närvarande inloggad.";
}

if (!isset($_SESSION['auth']) || $_SESSION['auth'] !== 'true') {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email']; // Hämta e-postadressen från sessionen
$password = $_SESSION['password']; // Hämta lösenordet från sessionen

$mysqli = new mysqli("db", "root", "notSecureChangeMe", "assignment2");

$userId = $_SESSION['user_id']; // Använd rätt nyckel för att hämta användar-ID

$sql = "SELECT newsletters.* 
FROM newsletters 
INNER JOIN subscriptions ON newsletters.id = subscriptions.newsletterId 
WHERE subscriptions.user = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $userId); // Använd bind_param för att undvika SQL-injektioner
$stmt->execute();
$result = $stmt->get_result();
?>
<?php
include_once('functions.php');
?>    
<?php
$title = "My page";
include('header.php');
?>


<div>
    <?php echo("My newsletter"); ?>
</div>
<?php
while ($row = $result->fetch_assoc()) {
?>
<div style="border: 1px solid #000000">
    <!-- Skapa en länk som pekar på singleNewsletter.php med nyhetsbrevets ID i querystring -->
    <h3><a href="singleNewsletter.php?id=<?php echo htmlspecialchars($row['id']); ?>"><?php echo htmlspecialchars($row['title']); ?></a></h3>
    <p><?php echo htmlspecialchars($row['description']); ?></p>
    <p>Owner: <?php echo htmlspecialchars($row['owner']); ?></p>
</div>
<?php
}
?>


<?php
include('footer.php');
?>
