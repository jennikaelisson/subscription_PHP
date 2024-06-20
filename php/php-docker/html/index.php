<?php
session_start();
include_once('functions.php');
?>  

<?php
    $title = "Home";
    include('header.php');
?>

<main>
<?php 
    if (isset($_GET['message'])) {
        if ($_GET['message'] === 'loggedout') {
            echo "You have been logged out";
        } 
    }
    ?>
<div class="home-content">
        <?php if (!isset($_SESSION['auth'])): ?>
            <h1>Welcome to Groovy Times Collective</h1>
            <p>Step into the groove with Groovy Times Collective, where you can explore a collection of far-out newsletters. Discover new passions, stay informed, and subscribe to the coolest newsletters around. Ready to dive in? Sign up or log in to get started!</p>
        <?php elseif ($_SESSION['auth']['role'] == 'subscriber'): ?>
            <h1>Welcome Back, Cool Cat!</h1>
            <p>Hey there, subscriber! You’re just in time to catch up on the latest and greatest from your favorite newsletters. Browse, read, and enjoy the groovy content curated just for you. Keep exploring, and stay groovy!</p>
        <?php elseif ($_SESSION['auth']['role'] == 'customer'): ?>
            <h1>Welcome Back, Newsletter Maestro!</h1>
            <p>Hey there, you creative genius! Ready to share some more of your stellar content with the world? Manage your newsletters, see who's subscribing, and keep the good times rolling. Let's make some magic happen!</p>
        <?php endif; ?>
    </div>
</main>




<?php
    include('footer.php');
?>