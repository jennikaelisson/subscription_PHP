<?php
    session_start();

    $mysqli = new mysqli("db", "root", "notSecureChangeMe", "assignment2");

    $sql = "SELECT * FROM subscriptions";
    $result = $mysqli->query($sql);
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
    include('footer.php');
?>