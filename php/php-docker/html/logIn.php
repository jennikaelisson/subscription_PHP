<?php
include_once('functions.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['role'])) {
        $_SESSION['role'] = $_POST['role'];
    }

    if (isset($_POST['auth'])) {
        $_SESSION['auth'] = $_POST['auth'];
    }
    var_dump($_SESSION);
    header('Location: ' . $_SERVER['REQUEST_URI']);
}
?>
<?php
$title = "My page";
include('header.php');
?>


<div>
    <?php echo ("Log in"); ?>

    <form method="POST">
        <input type="hidden" name="role" value="customer">
        <input type="hidden" name="auth" value="true">
        <input type="password" name="password" value="123456">
        <input type="submit">
    </form>
</div>



<?php
include('footer.php');
?>