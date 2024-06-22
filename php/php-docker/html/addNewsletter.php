<?php
session_start();
include_once('functions.php');


$title = "Add newsletter";
include('header.php');

if (!isset($_SESSION['auth']['id'])) {
    die("User ID not found in session. Please log in.");
}

$userId = $_SESSION['auth']['id'];

$mysqli = connect_to_database();

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['save'])) {
        $newTitle = $_POST['newsletter_title'];
        $newDescription = $_POST['newsletter_description'];
        
        $sql = "INSERT INTO newsletters (title, description, owner) VALUES (?, ?, ?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ssi", $newTitle, $newDescription, $userId);
        
        if ($stmt->execute()) {
            $message = "You have created a new newsletter.";
            $newsletterTitle = htmlspecialchars($newTitle);
            $newsletterDescription = htmlspecialchars($newDescription);
        } else {
            $message = "There was a problem when you tried to create the newsletter: " . $stmt->error;
        }
        
        $stmt->close();
    }
}

$mysqli->close();
?>
<main>
    <div>
        <form method="post">
            <div>
                <label for="newsletter_title">Title:</label>
                <input type="text" id="newsletter_title" name="newsletter_title" required>
            </div>
            <div>
                <label for="newsletter_description">Description:</label>
                <textarea id="newsletter_description" name="newsletter_description" class="large-textarea" required></textarea>
            </div>
            <button type="submit" name="save" class="form-button">Save</button>
        </form>
        <?php if (!empty($message)) { echo "<p>$message</p>"; } ?>
    </div>
</main>

<?php
include('footer.php');
?>
