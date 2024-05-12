<?php
include_once('functions.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $mysqli = new mysqli("db", "root", "notSecureChangeMe", "assignment2");

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
       // Användaren finns i databasen, så spara deras uppgifter i sessionen
       $_SESSION['email'] = $email;
       $_SESSION['password'] = $password;
       
       // Sätt roll och autentiseringsstatus i sessionen
       $_SESSION['role'] = 'customer';
       $_SESSION['auth'] = 'true';
        
        // Utför eventuella andra åtgärder, t.ex. omdirigering
        header('Location: ' . $_SERVER['REQUEST_URI']);
        exit();
    } else {
        // Användaren finns inte i databasen, hantera detta scenario (t.ex. visa felmeddelande)
        echo "Felaktiga användaruppgifter. Försök igen.";
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
        <input type="email" name="email" value="jennika.elisson@gmail.com">
        <input type="password" name="password" value="123456">
        <input type="submit">
    </form>
</div>



<?php
include('footer.php');
?>