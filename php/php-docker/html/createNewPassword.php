<?php
    session_start();
    include_once('functions.php');
?>    
<?php
    $title = "My page";
    include('header.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Hämta data från formuläret
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $code = $_POST['code'];
        
        // Skapa en anslutning till databasen
        $mysqli = new mysqli("db", "root", "notSecureChangeMe", "assignment2");
    
        // Kontrollera om lösenorden matchar
        if ($password !== $confirm_password) {
            echo "Lösenorden matchar inte. Försök igen.";
            exit();
        }
    
        // Hämta koden från databasen baserat på e-postadressen
        $sql = "SELECT code FROM passwordResets WHERE user = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stored_code = $row['code'];
    
        // Jämför koden från formuläret med den som finns i databasen
        if ($code !== $stored_code) {
            echo "Felaktig kod. Försök igen.";
            exit();
        }
    }
?>

<div>
    <?php echo("Create new password"); ?>
</div>

<form method="post">
    <input type="email" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="New Password">
    <input type="password" name="confirm_password" placeholder="Confirm New Password">
    <input type="code" name="code" placeholder="Enter your unique code">
    <input type="submit" value="Submit">
</form>

<?php
    include('footer.php');
?>
