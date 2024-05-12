<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $mysqli = new mysqli("db", "root", "notSecureChangeMe", "assignment2");

    $email = $_POST['email'];
    
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $mysqli->query($sql);

    // Hämta e-postadress från formuläret
    $to = $_POST['email'];

    // Generera slumpmässig kod
    $random_code = uniqid();

    // Spara den slumpmässiga koden i databasen
$sql_insert = "INSERT INTO passwordResets (user, code) VALUES ('$email', '$random_code')";
if ($mysqli->query($sql_insert) === TRUE) {
    echo "Slumpmässig kod sparad i databasen.";
} else {
    echo "Fel: " . $sql_insert . "<br>" . $mysqli->error;
}

    // Skicka e-post
    $subject = 'Din slumpmässiga kod';
    $message = 'Din slumpmässiga kod är: ' . $random_code;
    $headers = 'From: your-email@example.com'; // Ersätt med din e-postadress
    mail($to, $subject, $message, $headers);
}
?>

<div>
    <?php echo ("Send email"); ?>

    <form method="POST" action="sendEmail.php">
        <input type="email" name="email" value="jennika.elisson@gmail.com">
        <input type="submit">
    </form>
</div>