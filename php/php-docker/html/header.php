<html>
    <head>
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
            <div>Header logo</div>
            <nav>
                <!-- Om man är utloggad ska man se: <a href="listNewsletters.php">All newsletters</a>, <a href="logIn.php">Log in</a>, <a href="createAccount.php">Create account</a>.
                Om man är inloggad som customer ska man se: <a href="mySubscribers.php">My subscribers</a>, <a href="myNewsletter.php">My newsletters</a>, <a href="emptySessionAuth.php">Empty session</a>.
                Om man är inloggad som subscriber ska man se: <a href="listNewsletters.php">All newsletters</a>, <a href="singleNewsletter.php">Single newsletter</a>, <a href="emptySessionAuth.php">Empty session</a>
 -->
                <a href="index.php">Home</a>
                <a href="createAccount.php">Create account</a>
                <a href="createNewPassword.php">Create new password</a>
                <a href="listNewsletters.php">All newsletters</a>
                <a href="loggedOut.php">Logged out</a>
                <a href="logIn.php">Log in</a>
                <a href="myNewsletter.php">My newsletters</a>
                <a href="myPages.php">Mina sidor</a>
                <a href="mySubscribers.php">My subscribers</a>
                <a href="mySubscriptions.php">My subscriptions</a>
                <a href="resetPassword.php">Reset password</a>
                <a href="singleNewsletter.php">Single newsletter</a>
                <a href="emptySessionAuth.php">Empty session</a>
            </nav>
        </header>