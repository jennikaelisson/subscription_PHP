<?php include('auth.php'); ?>
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
            <nav><?php
            var_dump($isLoggedIn);  // See if the user is logged in
                var_dump($userRole);    // See the user's role
?>
            <?php if ($isLoggedIn): ?>
                <?php if ($userRole === 'customer'): ?>
                    <a href="mySubscribers.php">My subscribers</a>
                    <a href="myNewsletter.php">My newsletters</a>
                    <a href="logOut.php">Log out</a>
                <?php elseif ($userRole === 'subscriber'): ?>
                    <a href="listNewsletters.php">All newsletters</a>
                    <a href="mySubscriptions.php">My subscriptions</a>
                    <a href="logOut.php">Log out</a>
                <?php endif; ?>
            <?php else: ?>
                <a href="index.php">Home</a>
                <a href="listNewsletters.php">All newsletters</a>
                <a href="logIn.php">Log in</a>
                <a href="createAccount.php">Create account</a>
            <?php endif; ?>
        </nav>
        </header>