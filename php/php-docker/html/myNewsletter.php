<?php
session_start();

// Hämta användarens ID från sessionen
$userId = $_SESSION['auth']['id'];

// Anslut till databasen
$mysqli = new mysqli("db", "root", "notSecureChangeMe", "assignment2");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Förbered och exekvera SQL-frågan för att hämta nyhetsbrev som ägs av den inloggade kunden
$sql = "SELECT * 
        FROM newsletters 
        WHERE owner = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

include_once('functions.php');
$title = "My page";
include('header.php');
?>
<main>
<div><h2>My newsletters</h2></div>
    <?php while ($row = $result->fetch_assoc()): ?>
        <div style="border: 1px solid #000000; padding: 10px; margin: 10px;">
        <!-- Skapa en länk som pekar på singleNewsletter.php med nyhetsbrevets ID i querystring -->
        <h3><a href="singleNewsletter.php?id=<?php echo htmlspecialchars($row['id']); ?>"><?php echo htmlspecialchars($row['title']); ?></a></h3>
        <p><?php echo htmlspecialchars($row['description']); ?></p>
    </div>
    <?php endwhile; ?>
</main>
<?php
include('footer.php');
?>