<?php
session_start();

$userId = $_SESSION['auth']['id'];

include_once('functions.php');

$mysqli = connect_to_database();


$sql = "SELECT users.email, users.firstName, users.lastName 
        FROM subscriptions 
        JOIN users ON subscriptions.user = users.id 
        JOIN newsletters ON subscriptions.newsletterId = newsletters.id 
        WHERE newsletters.owner = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();


$title = "My subscribers";
include('header.php');
?>
<main>
    <?php no_access_customer(); ?>
    <div>
        <h2>My Subscribers</h2>
        <?php if ($result->num_rows == 0): ?>
            <p>You have no subscribers yet.</p>
        <?php else: ?>
            <ul>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <li>Name: <?php echo htmlspecialchars($row['firstName']); ?> <?php echo htmlspecialchars($row['lastName']); ?>. Email: <?php echo htmlspecialchars($row['email']); ?></li>
                <?php endwhile; ?>
            </ul>
        <?php endif; ?>
    </div>
</main>
<?php
include('footer.php');
$mysqli->close();
?>
