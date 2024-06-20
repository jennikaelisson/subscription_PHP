<?php
session_start();

$userId = $_SESSION['auth']['id'];

$mysqli = new mysqli("db", "root", "notSecureChangeMe", "assignment2");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

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
<div>
    <h2>My newsletters</h2><a href="addNewsletter.php">Create newsletter</a>
</div>
    <?php while ($row = $result->fetch_assoc()): ?>
        <div style="border: 1px solid #000000; padding: 10px; margin: 10px;">
        <h3><a href="singleNewsletter.php?id=<?php echo htmlspecialchars($row['id']); ?>"><?php echo htmlspecialchars($row['title']); ?></a></h3>
        <p><?php echo htmlspecialchars($row['description']); ?></p>
    </div>
    <?php endwhile; ?>
</main>
<?php
include('footer.php');
?>