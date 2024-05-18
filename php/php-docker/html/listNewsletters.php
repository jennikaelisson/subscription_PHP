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
    $title = "My page";
    include('header.php');
?>

<main>
        <div>
        <?php echo("All newsletters"); ?>
    </div>
        <?php
        // Loopa genom varje nyhetsbrev och visa dem
        while ($row = $result->fetch_assoc()) {
            ?>
            <div style="border: 1px solid #000000">
                <h3><?php echo $row['title']; ?></h3>
                <p><?php echo $row['description']; ?></p>
                <p>Owner: <?php echo $row['owner']; ?></p>
            </div>
            <?php
        }
        ?>
</main>

<?php
    include('footer.php');
?>