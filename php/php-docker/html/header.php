<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="styles.css?v=<?php echo time(); ?>">
    <title>
        <?php echo(get_window_title($title)); ?>
    </title>
    <style>
        .list-item {
            border: 2px dotted plum;
        }
        a {
            color: purple;
        }
    </style>
</head>
<body>
<header>
    <h2>Groovy Times Collective</h2>
    <nav>
        <?php 
        // Kontrollera om användaren är inloggad och om roll är definierad
        if (isset($_SESSION['auth']) && isset($_SESSION['auth']['role'])): 
            $userRole = $_SESSION['auth']['role'];
    
        ?>
        
            <?php if ($userRole == 'customer'): ?>
                <a href="index.php">Home</a>
                <a href="mySubscribers.php">My subscribers</a>
                <a href="myNewsletter.php">My newsletters</a>
                <a href="logout.php">Log out</a>
            <?php elseif ($userRole == 'subscriber'): ?>
                <a href="index.php">Home</a>
                <a href="listNewsletters.php">All newsletters</a>
                <a href="mySubscriptions.php">My subscriptions</a>
                <a href="logout.php">Log out</a>
            <?php endif; ?>
        <?php else: ?>
            <a href="index.php">Home</a>
            <a href="listNewsletters.php">All newsletters</a>
            <a href="login.php">Log in</a>
            <a href="createAccount.php">Create account</a>
        <?php endif; ?>
    </nav>
</header>
