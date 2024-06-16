<?php
    session_start();
    include_once('functions.php');
?>    
<?php
    $title = "My page";
    include('header.php');
?>

<main>
    <div>
        <?php echo("Logged out"); ?>
    </div>

</main>

<?php
    include('footer.php');
?>