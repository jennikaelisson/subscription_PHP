<?php
include_once('functions.php');
session_start();

$title = "My page";
include('header.php');

$newsletterId = isset($_GET['id']) ? intval($_GET['id']) : 0;

if (!isset($_SESSION['auth']['id'])) {
    die("User ID not found in session. Please log in.");
}

$userId = $_SESSION['auth']['id'];

$mysqli = new mysqli("db", "root", "notSecureChangeMe", "assignment2");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$message = "";

$sql = "SELECT title, description FROM newsletters WHERE id = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $newsletterId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $newsletter = $result->fetch_assoc();
    $newsletterTitle = htmlspecialchars($newsletter['title']);
    $newsletterDescription = htmlspecialchars($newsletter['description']);
} else {
    $newsletterTitle = "The newsletter wasn't found.";
    $newsletterDescription = "There is no newsletter with this id.";
}

$stmt->close();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['edit'])) {
        $showEditForm = true;
    } elseif (isset($_POST['save'])) {
        $updatedTitle = $_POST['newsletter_title'];
        $updatedDescription = $_POST['newsletter_description'];
        
        $sql = "UPDATE newsletters SET title = ?, description = ? WHERE id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ssi", $updatedTitle, $updatedDescription, $newsletterId);
        if ($stmt->execute()) {
            $message = "You have updated your newsletter.";
            $newsletterTitle = htmlspecialchars($updatedTitle);
            $newsletterDescription = htmlspecialchars($updatedDescription);
        } else {
            $message = "There was a problem when you tried to update the newsletter: " . $stmt->error;
        }
        $stmt->close();
        $showEditForm = false;
    }
} 

$mysqli->close();
?>
<main>

<div>
    <h2><?php echo $newsletterTitle; ?></h2>
    <p><?php echo $newsletterDescription; ?></p>
    <?php if (!empty($message)) { echo "<p>$message</p>"; } ?>
</div>
<div>
    <?php if (isset($showEditForm) && $showEditForm): ?>
        <form method="post">
            <input type="hidden" name="newsletter_id" value="<?php echo htmlspecialchars($newsletterId); ?>">
            <div>
                <label for="newsletter_title">Title:</label>
                <input type="text" id="newsletter_title" name="newsletter_title" value="<?php echo $newsletterTitle; ?>" required>
            </div>
            <div>
                <label for="newsletter_description">Description:</label>
                <textarea id="newsletter_description" name="newsletter_description" class="large-textarea" required><?php echo $newsletterDescription; ?></textarea>
            </div>
            <button type="submit" name="save" class="form-button">Save</button>
        </form>
    <?php else: ?>
        <form method="post">
            <input type="hidden" name="newsletter_id" value="<?php echo htmlspecialchars($newsletterId); ?>">
            <button type="submit" name="edit" class="form-button">Edit</button>
        </form>
    <?php endif; ?>
</div>
</main>

<?php
include('footer.php');
?>
