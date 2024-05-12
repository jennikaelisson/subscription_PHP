<?php
session_start();

include_once('functions.php');
?>    
<?php
$title = "My page";
include('header.php');
?>


<?php
if(isset($_GET['add']) && $_GET['add']) {
    $_SESSION['auth'] = $_GET['add']; // Spara användar-ID eller annan identifierare
}

if(isset($_GET['remove']) && $_GET['remove']) {
    unset($_SESSION['auth']);
    header('Location: /loggedOut.php'); // Varför får jag felmeddelande här?? och omdirigeras ej
    exit; // Stoppa exekvering efter omdirigering
}

var_dump($_SESSION);
?>

<html>
    <body>
        <?php
            if(isset($_SESSION['auth'])) {
                ?><a href="?remove=1">Log out</a><?php // Om inloggad, visa länk för utloggning
            } else {
                ?><a href="?add=1">Log in</a><?php // Om inte inloggad, visa länk för inloggning
            }
        ?>
    </body>
</html>

<?php
include('footer.php');
?>
