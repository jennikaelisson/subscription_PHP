<?php
    session_start();

    $mysqli = new mysqli("db", "root", "notSecureChangeMe", "assignment2");

    $sql = "SELECT * FROM newsletters";
$result = $mysqli->query($sql);
?>
<?php
    include_once('functions.php');
?>    
<?php
    $title = "Newsletters";
    include('header.php');
?>

<main>
        <div>
        <h2>All newsletters</h2>
    </div>
    <div>
        <?php
        while ($row = $result->fetch_assoc()) {
            ?>
            <div style="border: 1px solid #000000; padding: 10px; margin: 10px;">
            <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                <p><?php echo htmlspecialchars($row['description']); ?></p>
                <form method="POST" action="subscribe.php">
                        <input type="hidden" name="newsletterId" value="<?php echo $row['id']; ?>">
                        <button type="submit" class="sub-button">Subscribe</button>
                    </form>
            </div>
            <?php
        }
        ?>
        </div>
</main>

<?php
    include('footer.php');
?>