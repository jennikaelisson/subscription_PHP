<?php
session_start();

$userId = $_SESSION['auth']['id'];

include_once('functions.php');

$mysqli = connect_to_database();

$sql = "SELECT subscriptions.id as subscription_id, newsletters.title, newsletters.description
        FROM subscriptions 
        JOIN users ON subscriptions.user = users.id 
        JOIN newsletters ON subscriptions.newsletterId = newsletters.id 
        WHERE subscriptions.user = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

$title = "My Subscriptions";
include('header.php');
?>
<main>
<?php 
    if (isset($_GET['message'])) {
        if ($_GET['message'] === 'already_subscribed') {
            echo "You are aleready subscribing to this newsletter";
        }
    }
    ?>
    <?php no_access_subscriber(); ?>
    <div>
        <h2>My Subscriptions</h2>
        <?php if ($result->num_rows == 0): ?>
            <p>You have no subscriptions yet.</p>
        <?php else: ?>
            <div>
            <?php
            while ($row = $result->fetch_assoc()) {
            ?>
                <div style="border: 1px solid #000000; padding: 10px; margin: 10px;">
                    <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                    <p><?php echo htmlspecialchars($row['description']); ?></p>
                    <form method="POST" action="unsubscribe.php">
                        <input type="hidden" name="subscription_id" value="<?php echo $row['subscription_id']; ?>">
                        <button type="submit" class="unsub-button">Unsubscribe</button>
                    </form>
                </div>
            <?php
            }
            ?>
            </div>
        <?php endif; ?>
    </div>
</main>
<?php
include('footer.php');
?>
