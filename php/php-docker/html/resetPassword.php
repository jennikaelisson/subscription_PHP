<?php
session_start();
include_once('functions.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $code = $_POST['code'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $conn = new mysqli("db", "root", "notSecureChangeMe", "assignment2");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT code FROM passwordResets WHERE user = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($stored_code);
    $stmt->fetch();
    $stmt->close();

    if ($code === $stored_code) {
        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
        $stmt->bind_param("ss", $password_hash, $email);
        if ($stmt->execute()) {
            $delete_stmt = $conn->prepare("DELETE FROM passwordResets WHERE user = ?");
            $delete_stmt->bind_param("s", $email);
            $delete_stmt->execute();
            $delete_stmt->close();

            header('Location: logIn.php?message=updated'); 
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Invalid code. Please try again.";
    }
    $conn->close();
}

include('header.php');
?>
<main>
    <div class="form-container">
        <h2>Enter new password</h2>
        <form method="POST">
            <input type="email" name="email" placeholder="Your email address" required>
            <input type="password" name="password" placeholder="Your new password" required>
            <input type="text" name="code" placeholder="Your unique code" required>
            <input type="submit" class="form-button" value="Update password">
        </form>
    </div>
</main>
<?php
include('footer.php');
?>
