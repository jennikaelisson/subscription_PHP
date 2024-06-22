<?php
session_start();
$title = "My newsletters";

$userId = $_SESSION['auth']['id'];

include_once('functions.php');

$mysqli = connect_to_database();

$sql = "SELECT * 
        FROM newsletters 
        WHERE owner = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

include('header.php');
?>
<main>
    <?php no_access_customer(); ?>
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