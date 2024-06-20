<?php
session_start();
include_once('functions.php');
$title = "Reset your password";



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mysqli = new mysqli("db", "root", "notSecureChangeMe", "assignment2");

    $email = $_POST['email'];
    
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        $random_code = uniqid();

        $sql_insert = "INSERT INTO passwordResets (user, code) VALUES ('$email', '$random_code')";
        if ($mysqli->query($sql_insert) === TRUE) {
            header('Location: resetPassword.php'); 
            exit();
        } else {
            echo "Fel: " . $sql_insert . "<br>" . $mysqli->error;
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v3/sandbox194c82deb79342eca6f4bd265f08d58a.mailgun.org/messages');
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, 'api:ad234a9b32fbb7782e427e212be18525-ed54d65c-6ad02178');
        curl_setopt($ch, CURLOPT_POST, 1);
        $formFields = [
            'from' => 'postmaster@sandbox194c82deb79342eca6f4bd265f08d58a.mailgun.org',
            'to' => $email,
            'subject' => 'Din slumpmässiga kod',
            'text' => 'Din slumpmässiga kod är: ' . $random_code
        ];
        curl_setopt($ch, CURLOPT_POSTFIELDS, $formFields);
        $response = curl_exec($ch);
        if(curl_errno($ch)) {
            echo 'Curl error: ' . curl_error($ch);
        }
        curl_close($ch);
    } else {
        echo "Felaktig e-postadress. Försök igen.";
    }
}
include('header.php');

?>

<main>
 <div class="form-container">
 <h2>Reset your password   </h2>   

    <form method="POST">
        <input type="email" name="email" placeholder="Your email address">
        <input type="submit" class="form-button"value="Reset password">
    </form> 
</div>
</main>
<?php
include('footer.php');
?>